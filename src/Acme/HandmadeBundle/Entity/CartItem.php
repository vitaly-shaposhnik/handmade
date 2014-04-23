<?php

namespace Acme\HandmadeBundle\Entity;

use Acme\HandmadeBundle\Entity\Product;

class CartItem
{
    /** @var integer */
    private $id;
    /** @var float */
    private $price;
    /** @var integer */
    private $quantity;

    public function fromArray(array $data = array())
    {
        if (array_key_exists('id', $data)) $this->setId($data['id']);
        if (array_key_exists('price', $data)) $this->setPrice($data['price']);
        if (array_key_exists('quantity', $data)) $this->setQuantity($data['quantity']);
    }

    public function fromObject(Product $product, $quantity = 1)
    {
        $this->setId($product->getId());
        $this->setPrice($product->getPrice());
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
}