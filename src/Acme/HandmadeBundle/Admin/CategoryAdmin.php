<?php

namespace Acme\HandmadeBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Acme\HandmadeBundle\Entity\Category;
use Acme\HandmadeBundle\Entity\Image;
use Doctrine\ORM\EntityManager;

class CategoryAdmin extends Admin
{
    private $entityManager;

    // Fields to be shown on create/edit forms
    protected function configureFormFields(FormMapper $formMapper)
    {
        // get the current Image instance
        /** @var $category Category */
        $category = $this->getSubject();
        $image = $category->getImage();

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
            ->add('imageBuffer', 'file', $fileFieldOptions)
            ->add('weight', 'integer', array('label' => 'Вес'))
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
            ->add('weight')
            ->add('active')
        ;
    }

    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('name')
            ->add('image', 'string', array('template' => 'AcmeHandmadeBundle:Image:admin_image_template.html.twig'))
            ->add('weight')
            ->add('active')
        ;
    }

    /**
     * @param $category Category
     */
    public function preUpdate($category)
    {
        $needPersist = false;
        if (!$category->getImage()) {
            $image = new Image();
            $needPersist = true;
        } else {
            $image = $category->getImage();
        }

        $image->setName($category->getName());
        $image->setActive(true);
        $image->setImageFile($category->getImageBuffer());
        $image->evaluateUpload();

        if ($needPersist) {
            $em = $this->getEntityManager();
            $em->persist($image);
        }

        $category->setImage($image);
    }

    /**
     * @param $category Category
     */
    public function prePersist($category)
    {
        $image = new Image();
        $image->setName($category->getName());
        $image->setActive(true);
        $image->setImageFile($category->getImageBuffer());
        $image->evaluateUpload();

        $em = $this->getEntityManager();
        $em->persist($image);

        $category->setImage($image);
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