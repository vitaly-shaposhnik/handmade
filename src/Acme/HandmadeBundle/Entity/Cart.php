<?php

namespace Acme\HandmadeBundle\Entity;

use Symfony\Component\HttpFoundation\Session\Session;
use Acme\HandmadeBundle\Entity\CartItem;
use Acme\HandmadeBundle\Entity\Product;

class Cart
{
    /** @var string */
    private $sessionName = 'userCart';
    /** @var CartItem[] */
    private $products = array();
    /** @var int */
    private $sum = 0;
    /** @var int */
    private $productLimit = 10;
    /** @var Session */
    private $storage;

    public function __construct()
    {
        $this->storage = new Session();
        $this->storage->start();

        $session = $this->storage->all();

        if (empty($session[$this->sessionName])) {
            $this->storage->set($this->sessionName, array(
                'products' => array(),
            ));
        }
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
     * @return CartItem[]
     */
    public function getProducts()
    {
        return $this->products;
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

            $this->storage->set($this->sessionName, $data);
            $this->clearEmpty();
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
        foreach ($data['productList'] as $productId => $quantity) {
            if (!$quantity) {
                unset($data['productList'][$productId]);
            }
        }

        $this->storage->set($this->sessionName, $data);
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
        foreach ($this->getProducts() as $product) {
            if (!$product instanceof CartItem) continue;

            $this->sum += $product->getPrice();
        }

        return $this->sum;
    }
}