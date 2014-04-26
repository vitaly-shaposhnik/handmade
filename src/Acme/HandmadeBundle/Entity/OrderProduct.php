<?php

namespace Acme\HandmadeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * OrderProduct
 *
 * @ORM\Table("order_product")
 * @ORM\Entity
 */
class OrderProduct
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="OrderEntity", inversedBy="products")
     * @ORM\JoinColumn(name="order_id", referencedColumnName="id")
     */
    private $order;

//    /**
//     * @var integer
//     *
//     * @ORM\Column(name="order_id", type="integer")
//     * @Assert\NotBlank()
//     */
//    private $order_id;

    /**
     * @var integer
     *
     * @ORM\Column(name="product_id", type="integer")
     * @Assert\NotBlank()
     */
    private $product_id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     * @Assert\NotBlank()
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="sku", type="string", length=255)
     * @Assert\NotBlank()
     */
    private $sku;

    /**
     * @var string
     *
     * @ORM\Column(name="category", type="string", length=255)
     * @Assert\NotBlank()
     */
    private $category;

    /**
     * @var integer
     *
     * @ORM\Column(name="quantity", type="integer")
     * @Assert\NotBlank()
     */
    private $quantity;

    /**
     * @var float
     *
     * @ORM\Column(name="price_for_one", type="float")
     */
    private $priceForOne;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set quantity
     *
     * @param integer $quantity
     * @return OrderProduct
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * Get quantity
     *
     * @return integer 
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

//    /**
//     * @param int $order_id
//     */
//    public function setOrderId($order_id)
//    {
//        $this->order_id = $order_id;
//    }
//
//    /**
//     * @return int
//     */
//    public function getOrderId()
//    {
//        return $this->order_id;
//    }

    /**
     * @param int $product_id
     */
    public function setProductId($product_id)
    {
        $this->product_id = $product_id;
    }

    /**
     * @return int
     */
    public function getProductId()
    {
        return $this->product_id;
    }

    /**
     * @param mixed $order
     */
    public function setOrder($order)
    {
        $this->order = $order;
    }

    /**
     * @return mixed
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * @param float $priceForOne
     */
    public function setPriceForOne($priceForOne)
    {
        $this->priceForOne = $priceForOne;
    }

    /**
     * @return float
     */
    public function getPriceForOne()
    {
        return $this->priceForOne;
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
     * @param string $category
     */
    public function setCategory($category)
    {
        $this->category = $category;
    }

    /**
     * @return string
     */
    public function getCategory()
    {
        return $this->category;
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

    public function __toString()
    {
        $price = $this->getQuantity() * $this->getPriceForOne();

        return "({$this->getName()}*{$this->getQuantity()}={$price})";
    }
}
