<?php

namespace Acme\HandmadeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Image
 *
 * @ORM\Table("image")
 * @ORM\Entity
 */
class Image
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
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     * @Assert\NotBlank()
     */
    private $name;

    /**
     * @var boolean
     *
     * @ORM\Column(name="active", type="boolean")
     */
    private $active = true;

    /**
     * @Assert\File(maxSize=6000000)
     */
    public $imageFile;

    public $removeImage = false;

    /**
     * @var string
     *
     * @ORM\Column(name="image", nullable=true, type="string", length=255)
     */
    private $image;

    /**
     * @ORM\OneToMany(targetEntity="Product", mappedBy="image")
     */
    private $products;

    /**
     * @ORM\OneToMany(targetEntity="Category", mappedBy="image")
     */
    private $categories;

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

    public function __construct(){
        $this->products = new ArrayCollection();
        $this->categories = new ArrayCollection();
    }

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
     * Set name
     *
     * @param string $name
     * @return Image
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set active
     *
     * @param boolean $active
     * @return Image
     */
    public function setActive($active)
    {
        $this->active = (bool)$active;

        return $this;
    }

    /**
     * Get active
     *
     * @return boolean
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * @param string $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }

    /**
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    static public function getImagesPath($absolute = false)
    {
        $path = '';
        if ($absolute) {
            $path = realpath(__DIR__.'/../../../../web').'/';
        }

        return $path . 'uploads/images';
    }

    public function getWebPath()
    {
        return $this->getImagesPath() . '/' . $this->getImage();
    }

    public function evaluateUpload()
    {
//        if (($oldImage = $this->getImage()) && $this->removeImage) {
//            unlink($oldImage);
//            $this->setImage($oldImage = null);
//        }
//
//        if (null === $this->imageFile) {
//            return;
//        }
//
//        // remove old image
//        if ($oldImage) {
//            unlink($oldImage);
//        }

        $imagesPath = $this->getImagesPath(true);
        if (!is_dir($imagesPath)) {
            mkdir($imagesPath, 0777, true);
        }

        $imageName = md5(uniqid().$this->getName()).'.'.$this->imageFile->guessExtension();

        $this->imageFile->move($imagesPath, $imageName);
        $this->setImage($imageName);
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
     * @return mixed
     */
    public function getProducts()
    {
        return $this->products;
    }

    /**
     * @return mixed
     */
    public function getCategories()
    {
        return $this->categories;
    }

    /**
     * @param mixed $imageFile
     */
    public function setImageFile($imageFile)
    {
        $this->imageFile = $imageFile;
    }

    /**
     * @return mixed
     */
    public function getImageFile()
    {
        return $this->imageFile;
    }

    public function __toString()
    {
        return $this->image;
    }
}
