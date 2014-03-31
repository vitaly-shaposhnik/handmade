<?php

namespace Acme\HandmadeBundle\Handler;

use Acme\HandmadeBundle\Model\CategoryHandlerInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Acme\HandmadeBundle\DTO\Category as DtoCategory;

class ApiCategoryHandler implements CategoryHandlerInterface
{
    protected $om;
    protected $entityClass;
    protected $repository;
    protected $dto;

    public function __construct(ObjectManager $om, $entityClass)
    {
        $this->om = $om;
        $this->entityClass = $entityClass;
        $this->repository = $this->om->getRepository($this->entityClass);
        $this->dto = new DtoCategory();
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

    public function transfer($data)
    {
        $result = [];

        if (is_array($data)) {
            foreach ($data as $item) {
                if ($item instanceof $this->entityClass) {
                    $result[] = $item->transferObjectToDto($item, $this->dto);
                }
            }
        } elseif (is_object($data) && $data instanceof $this->entityClass) {
            if ($data instanceof $this->entityClass) {
                $result[] = $data->transferObjectToDto($data, $this->dto);
            }
        }

        return $result;
    }
}