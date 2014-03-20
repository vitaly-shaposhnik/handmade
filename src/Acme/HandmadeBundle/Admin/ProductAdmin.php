<?php

namespace Acme\HandmadeBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class ProductAdmin extends Admin
{
    // Fields to be shown on create/edit forms
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('name', 'text', array('label' => 'Название'))
            ->add('annotation', 'textarea', array('label' => 'Аннотация'))
            ->add('description', 'textarea', array('label' => 'Описание'))
            ->add('price', 'money', array(
                'label' => 'Цена',
                'currency' => 'UAH'
            ))
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
} 