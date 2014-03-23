<?php

namespace Acme\HandmadeBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Acme\HandmadeBundle\Entity\Product;
use Acme\HandmadeBundle\Entity\Image;
use Doctrine\ORM\EntityManager;

class ProductAdmin extends Admin
{
    private $entityManager;

    // Fields to be shown on create/edit forms
    protected function configureFormFields(FormMapper $formMapper)
    {
        // get the current Image instance
        /** @var $product Product */
        $product = $this->getSubject();
        $image = $product->getImage();

        // use $fileFieldOptions so we can add other options to the field
        $fileFieldOptions = array('required' => false);
        if ($image && $image->getImage() && ($webPath = $image->getWebPath())) {
            // get the container so the full path to the image can be set
            $container = $this->getConfigurationPool()->getContainer();
            $fullPath = $container->get('request')->getBasePath().'/'.$webPath;

            // add a 'help' option containing the preview's img tag
            $fileFieldOptions['help'] = '<img src="'.$fullPath.'" class="preview" />';
        }

        $formMapper
            ->add('name', 'text', array('label' => 'Название'))
            ->add('annotation', 'textarea', array(
                'label' => 'Аннотация',
//                'required' => false,
            ))
            ->add('description', 'textarea', array(
                'label' => 'Описание',
//                'required' => false,
            ))
            ->add('price', 'money', array(
                'label' => 'Цена',
                'currency' => 'UAH'
            ))
            ->add('category', 'entity', array(
                'label' => 'Категория',
                'class' => 'AcmeHandmadeBundle:Category',
                'property' => 'name',
            ))
            ->add('imageBuffer', 'file', $fileFieldOptions)
            ->add('sku', 'text', array('label' => 'SKU'))
            ->add('quantity', 'integer', array('label' => 'Количество'))
            ->add('active', 'checkbox', array(
                'label' => 'Active',
                'data'  => true,
                'required' => false,
            ))
        ;
    }

    // Fields to be shown on filter forms
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('name')
            ->add('price')
            ->add('sku')
            ->add('active')
        ;
    }

    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('name')
            ->add('image', 'string', array('template' => 'AcmeHandmadeBundle:Image:admin_image_template.html.twig'))
            ->add('price')
            ->add('sku')
            ->add('quantity')
            ->add('active')
            ->add('created')
            ->add('updated')
        ;
    }

    /**
     * @param $product Product
     */
    public function preUpdate($product)
    {
        $needPersist = false;
        if (!$product->getImage()) {
            $image = new Image();
            $needPersist = true;
        } else {
            $image = $product->getImage();
        }

        $image->setName($product->getName());
        $image->setActive(true);
        $image->setImageFile($product->getImageBuffer());
        $image->evaluateUpload();

        if ($needPersist) {
            $em = $this->getEntityManager();
            $em->persist($image);
        }

        $product->setImage($image);
    }

    /**
     * @param $product Product
     */
    public function prePersist($product)
    {
        $image = new Image();
        $image->setName($product->getName());
        $image->setActive(true);
        $image->setImageFile($product->getImageBuffer());
        $image->evaluateUpload();

        $em = $this->getEntityManager();
        $em->persist($image);

        $product->setImage($image);
    }

    public function setEntityManager(EntityManager $em)
    {
        $this->entityManager = $em;
    }

    /**
     * @return EntityManager
     */
    public function getEntityManager()
    {
        return $this->entityManager;
    }
} 