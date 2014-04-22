<?php

namespace Acme\HandmadeBundle\Entity;

use Acme\HandmadeBundle\Entity\Product;

class CartItem
{
    /** @var integer */
    private $id;
    /** @var string */
    private $name;
    /** @var float */
    private $price;
    /** @var string */
    private $sku;
    /** @var integer */
    private $quantity;

//    public function __construct(Product $product, array $data = array())
//    {
//
//    }

    public function fromArray(array $data = array())
    {
        if (array_key_exists('id', $data)) $this->setId($data['id']);
        if (array_key_exists('name', $data)) $this->setName($data['name']);
        if (array_key_exists('price', $data)) $this->setPrice($data['price']);
        if (array_key_exists('sku', $data)) $this->setSku($data['sku']);
        if (array_key_exists('quantity', $data)) $this->setQuantity($data['quantity']);
    }

    public function fromObject(Product $product, $quantity = 1)
    {
        $this->setId($product->getId());
        $this->setName($product->getName());
        $this->setPrice($product->getPrice());
        $this->setSku($product->getSku());
        $this->setQuantity($quantity);
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param float $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param int $quantity
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }

    /**
     * @return int
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @param string $sku
     */
    public function setSku($sku)
    {
        $this->sku = $sku;
    }

    /**
     * @return string
     */
    public function getSku()
    {
        return $this->sku;
    }
}