<?php

namespace Acme\HandmadeBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class OrderType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('lastName', 'text', array(
                'label' => 'Фамилия получателя:',
                'attr' => array('placeholder' => 'Фамилия'),
                'required'  => true,
            ))
            ->add('firstName', 'text', array(
                'label' => 'Имя получателя:',
                'attr' => array('placeholder' => 'Имя'),
                'required'  => true,
            ))
            ->add('middleName', 'text', array(
                'label' => 'Отчество получателя:',
                'attr' => array('placeholder' => 'Отчество'),
                'required'  => true,
            ))
            ->add('email', 'email', array(
                'label' => 'E-mail:',
                'attr' => array('placeholder' => 'E-mail'),
                'required'  => true,
            ))
            ->add('phoneNumber', 'text', array(
                'label' => 'Телефон для связи:',
                'attr' => array('placeholder' => 'Телефон'),
                'required'  => true,
            ))
            ->add('address', 'text', array(
                'label' => 'Адрес доставки:',
                'attr' => array('placeholder' => 'Адрес'),
                'required'  => true,
            ))
            ->add('termsAgree', 'checkbox', array(
                'label' => 'Я ознакомлен и согласен с «Условиями продажи»',
                'required'  => true,
            ))
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Acme\HandmadeBundle\Entity\OrderEntity'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'handmade_order';
    }
} 