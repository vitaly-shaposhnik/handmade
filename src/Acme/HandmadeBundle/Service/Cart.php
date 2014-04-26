<?php

namespace Acme\HandmadeBundle\Service;

use Symfony\Component\HttpFoundation\Session\Session;
use Acme\HandmadeBundle\Entity\CartItem;
use Acme\HandmadeBundle\Entity\Product;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\Persistence\ObjectRepository;

class Cart
{
    /** @var Session */
    protected $storage;
    /** @var string */
    protected $sessionName;
    /** @var ObjectManager */
    protected $om;
    /** @var ObjectRepository */
    protected $repository;
    /** @var CartItem[] */
    protected $products = array();
    /** @var int */
    protected $sum = 0;
    /** @var int */
    protected $productLimit = 10;


    public function __construct(Session $session, ObjectManager $om, $entityClass, $sessionName = 'userCart')
    {
        $this->storage = $session;
        $this->sessionName = $sessionName;
        $this->om = $om;
        $this->repository = $om->getRepository($entityClass);

//        $session = $this->storage->all();
    }

    public function clear() {
        $this->storage->set($this->sessionName, null);
        $this->sum = 0;
        $this->products = array();
    }

    /**
     * @return bool
     */
    public function isEmpty()
    {
        return !(bool)$this->getProducts();
    }

    /**
     * @return array
     */
    public function getProducts()
    {
        $this->clearEmpty();
        $data = $this->storage->get($this->sessionName, array());

        $products = array();
        if (!empty($data['productList'])) {
            $products = $this->repository->findBy(array('id' => array_keys($data['productList'])));
        }

        return $products;
    }

    /**
     * @return CartItem[]
     */
    public function getCartProducts()
    {
        $this->clearEmpty();
        $data = $this->storage->get($this->sessionName, array());

        return isset($data['products']) ? $data['products'] : [];
    }

    /**
     * @param  $product     Product
     * @param  $quantity    int
     */
    public function setProduct(Product $product, $quantity = 1)
    {
        if ($quantity > 0) {
            $cartItem = new CartItem();
            $cartItem->fromObject($product, $quantity);

            if (!is_array($this->products)) {
                $this->products = array();
            }

            $this->products[] = $cartItem;

            $data = $this->storage->get($this->sessionName, array());
            $data['productList'][$product->getId()] = $quantity;
            $data['products'][$product->getId()] = $cartItem;

            $this->storage->set($this->sessionName, $data);
            $this->clearEmpty();
        }
    }

    /**
     * @param  $product     Product
     * @param  $quantity    int
     */
    public function deleteProduct(Product $product)
    {
        $data = $this->storage->get($this->sessionName);

        if (array_key_exists($product->getId(), $data['productList'])) {
            unset($data['productList'][$product->getId()]);
            unset($data['products'][$product->getId()]);

            $this->storage->set($this->sessionName, $data);
        }
    }

    /**
     * @return int
     */
    public function count() {
        $count = 0;
        $data = $this->getData();
        foreach ($data['productList'] as $quantity) {
            $count += $quantity;
        }

        return $count;
    }

    /**
     * Удаляет товары с нулевым количеством
     */
    private function clearEmpty()
    {
        $data = $this->storage->get($this->sessionName);

        // товары
        if (isset($data['productList']) && !empty($data['productList'])) {
            foreach ($data['productList'] as $productId => $quantity) {
                if (!$quantity) {
                    unset($data['productList'][$productId]);
                    unset($data['products'][$productId]);
                }
            }

            $this->storage->set($this->sessionName, $data);
        }
    }

    /**
     * @param $productId
     * @return bool
     */
    public function hasProduct($productId)
    {
        $data = $this->storage->get($this->sessionName);

        return array_key_exists($productId, $data['productList']);
    }

    /**
     * @param $productId int
     * @return int
     */
    public function getQuantityByProduct($productId)
    {
        $data = $this->getData();
        $productId = (int)$productId;

        if (array_key_exists($productId, $data['productList'])) {
            return $data['productList'][$productId];
        }

        return 0;
    }

    /**
     * @param $productId int
     * @return CartItem|null
     */
    public function getProductById($productId)
    {
        return isset($this->products[$productId]) ? $this->products[$productId] : null;
    }

    public function getData()
    {
        return $this->storage->get($this->sessionName);
    }

    /**
     * @return int
     */
    public function getSum()
    {
        $this->sum = 0;
        foreach ($this->getCartProducts() as $product) {
            if (!$product instanceof CartItem) continue;

            $this->sum += $product->getPrice();
        }

        return $this->sum;
    }
} 