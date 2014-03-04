<?php

namespace Acme\HandmadeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

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
     * @var integer
     *
     * @ORM\Column(name="active", type="integer")
     */
    private $active = 1;

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
     * @param integer $active
     * @return Image
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get active
     *
     * @return integer 
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

        return $path . 'uploads/cards';
    }

    public function evaluateUpload()
    {
        if (($oldImage = $this->getImage()) && $this->removeImage) {
            unlink($oldImage);
            $this->setImage($oldImage = null);
        }

        if (null === $this->imageFile) {
            return;
        }

        // remove old image
        if ($oldImage) {
            unlink($oldImage);
        }

        $imagesPath = $this->getImagesPath(true);
        if (!is_dir($imagesPath)) {
            mkdir($imagesPath, 0777, true);
        }

        $imageName = md5(uniqid().$this->getName()).'.'.$this->imageFile->guessExtension();

        $this->imageFile->move($imagesPath, $imageName);
        $this->setImage($imageName);
    }
}
