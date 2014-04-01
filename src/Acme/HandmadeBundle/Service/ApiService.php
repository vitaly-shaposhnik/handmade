<?php

namespace Acme\HandmadeBundle\Service;

use Acme\HandmadeBundle\Service\ApiCategoryServiceInterface;
use Doctrine\Common\Persistence\ObjectManager;

class ApiService implements ApiCategoryServiceInterface
{
    protected $om;
    protected $entityClass;
    protected $repository;
    protected $dtoClass;

    public function __construct(ObjectManager $om, $entityClass, $dtoClass)
    {
        $this->om = $om;
        $this->entityClass = $entityClass;
        $this->repository = $this->om->getRepository($this->entityClass);
        $this->dtoClass = $dtoClass;
    }

    public function get($id)
    {
        $category = $this->repository->findBy(array('id' => $id, 'active' => true));

        return $this->transfer($category);
    }

    public function getBySlug($slug)
    {
        $category = $this->repository->findBy(array('slug' => $slug, 'active' => true));

        return $this->transfer($category);
    }

    public function getList()
    {
        $categories = $this->repository->findBy(array('active' => true));

        return $this->transfer($categories);
    }

    /**
     * @param array|object $data
     * @return array|object
     */
    public function transfer($data)
    {
        $result = array();
        if (is_array($data)) {
            foreach ($data as $item) {
                if ($item instanceof $this->entityClass) {
                    $result[] = $item->transferObjectToDto($item, new $this->dtoClass());
                }
            }
        } elseif (is_object($data) && $data instanceof $this->entityClass) {
            if ($data instanceof $this->entityClass) {
                $result = $data->transferObjectToDto($data, new $this->dtoClass());
            }
        }

        return $result;
    }
}