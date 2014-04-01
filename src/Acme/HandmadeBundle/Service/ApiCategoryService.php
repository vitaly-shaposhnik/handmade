<?php

namespace Acme\HandmadeBundle\Service;

use Doctrine\Common\Persistence\ObjectManager;
use Acme\HandmadeBundle\Service\ApiService;

class ApiCategoryService extends ApiService
{
    public function __construct(ObjectManager $om, $entityClass, $dtoClass)
    {
        $this->om = $om;
        $this->entityClass = $entityClass;
        $this->repository = $this->om->getRepository($this->entityClass);
        $this->dtoClass = $dtoClass;
    }
}