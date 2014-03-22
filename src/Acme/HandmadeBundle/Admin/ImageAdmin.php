<?php

namespace Acme\HandmadeBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Acme\HandmadeBundle\Entity\Image;

class ImageAdmin extends Admin
{
    // Fields to be shown on create/edit forms
    protected function configureFormFields(FormMapper $formMapper)
    {
        // get the current Image instance
        /** @var $image Image */
        $image = $this->getSubject();

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
            ->add('imageFile', 'file', $fileFieldOptions)
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
            ->add('active')
        ;
    }

    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('name')
            ->add('active')
        ;
    }

    /**
     * @param $image Image
     */
    public function preUpdate($image)
    {
        $image->evaluateUpload();
    }

    /**
     * @param $image Image
     */
    public function prePersist($image)
    {
        $image->evaluateUpload();
    }
} 