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
        $formMapper
            ->add('name', 'text', array('label' => 'Название'))
            ->add('annotation', 'textarea', array(
                'label' => 'Аннотация',
                'required' => false,
            ))
            ->add('description', 'textarea', array(
                'label' => 'Описание',
                'required' => false,
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
//            ->add('image', 'entity', array(
//                'label' => 'Image',
//                'class' => 'AcmeHandmadeBundle:Image',
//                'property' => 'name',
//            ))
//            ->add('image', 'collection', array(
//                'type' => 'file',//new Image(),
//                'allow_add' => true,
//                'by_reference' => false,
//                'allow_delete' => true,
//                'prototype' => true
//            ))
            ->add('imageBuffer', 'file')
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
            ->add('price')
            ->add('sku')
            ->add('quantity')
            ->add('active')
            ->add('created')
            ->add('updated')
        ;
    }

    /**
     * @param $image Image
     */
    public function preUpdate($product)
    {
        //$image->evaluateUpload();
    }

    /**
     * @param $product Product
     */
    public function prePersist($product)
    {
        $image = new Image();
        $image
            ->setName($product->getName())
            ->setActive(true)
            ->setImageFile($product->getImageBuffer())
        ;
        $image->evaluateUpload();

        $em = $this->getEntityManager();
        $em->persist($image);
        $em->flush($image);

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