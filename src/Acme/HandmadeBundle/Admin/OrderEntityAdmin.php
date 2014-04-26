<?php

namespace Acme\HandmadeBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Acme\HandmadeBundle\Entity\OrderEntity;

class OrderEntityAdmin extends Admin
{
//    // Fields to be shown on filter forms
//    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
//    {
//        $datagridMapper
//            ->add('id')
//        ;
//    }

    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('id')
            ->add('uid')
            ->add('products', 'entity', array(
//                'associated_property' => 'id',
            ))
            ->add('order_status')
            ->add('totalPrice')
            ->add('firstName')
            ->add('lastName')
            ->add('middleName')
            ->add('email')
            ->add('phoneNumber')
            ->add('address')
            ->add('created')
        ;
    }
} 