<?php

namespace Acme\HandmadeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Constraints;

/**
 * OrderEntity
 *
 * @ORM\Table("order_entity")
 * @ORM\Entity
 */
class OrderEntity
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
     * @var integer
     *
     * @ORM\Column(name="uid", type="integer")
     */
    private $uid;

    /**
     * @ORM\OneToMany(targetEntity="OrderProduct", mappedBy="order")
     */
    private $products;

//    /**
//     * @ORM\OneToOne(targetEntity="OrderStatus")
//     * @ORM\JoinColumn(name="order_status_id", referencedColumnName="id")
//     */
//    private $order_status;

    /**
     * @ORM\ManyToOne(targetEntity="OrderStatus", inversedBy="orders")
     * @ORM\JoinColumn(name="order_status_id", referencedColumnName="id")
     */
    private $order_status;

    /**
     * @var float
     *
     * @ORM\Column(name="total_price", type="float")
     */
    private $totalPrice;

    /**
     * @var string
     *
     * @ORM\Column(name="first_name", type="string", length=255)
     */
    protected $firstName;

    /**
     * @var string
     *
     * @ORM\Column(name="last_name", type="string", length=255)
     */
    protected $lastName;

    /**
     * @var string
     *
     * @ORM\Column(name="middle_name", type="string", length=255)
     */
    protected $middleName;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255)
     */
    protected $email;

    /**
     * @var string
     *
     * @ORM\Column(name="phone_number", type="string", length=255)
     */
    protected $phoneNumber;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="text")
     */
    protected $address;

    /**
     * @var boolean
     *
     * @ORM\Column(name="terms_agree", type="boolean")
     */
    protected $termsAgree;

    /**
     * @var datetime $created
     *
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime")
     */
    private $created;

    /**
     * @var datetime $update
     *
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(type="datetime")
     */
    private $updated;

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
     * Set uid
     *
     * @param integer $uid
     * @return OrderEntity
     */
    public function setUid($uid)
    {
        $this->uid = $uid;

        return $this;
    }

    /**
     * Get uid
     *
     * @return integer 
     */
    public function getUid()
    {
        return $this->uid;
    }

    /**
     * @param mixed $order_status
     */
    public function setOrderStatus($order_status)
    {
        $this->order_status = $order_status;
    }

    /**
     * @return mixed
     */
    public function getOrderStatus()
    {
        return $this->order_status;
    }

    /**
     * @return \Acme\HandmadeBundle\Entity\datetime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * @return \Acme\HandmadeBundle\Entity\datetime
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * @param string $address
     */
    public function setAddress($address)
    {
        $this->address = $address;
    }

    /**
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param string $firstName
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param string $lastName
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    /**
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param string $middleName
     */
    public function setMiddleName($middleName)
    {
        $this->middleName = $middleName;
    }

    /**
     * @return string
     */
    public function getMiddleName()
    {
        return $this->middleName;
    }

    /**
     * @param string $phoneNumber
     */
    public function setPhoneNumber($phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;
    }

    /**
     * @return string
     */
    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }

    /**
     * @param mixed $products
     */
    public function setProducts($products)
    {
        $this->products = $products;
    }

    /**
     * @return mixed
     */
    public function getProducts()
    {
        return $this->products;
    }

    /**
     * @param float $totalPrice
     */
    public function setTotalPrice($totalPrice)
    {
        $this->totalPrice = $totalPrice;
    }

    /**
     * @return float
     */
    public function getTotalPrice()
    {
        return $this->totalPrice;
    }

    /**
     * @param boolean $termsAgree
     */
    public function setTermsAgree($termsAgree)
    {
        $this->termsAgree = $termsAgree;
    }

    /**
     * @return boolean
     */
    public function getTermsAgree()
    {
        return $this->termsAgree;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }
}
