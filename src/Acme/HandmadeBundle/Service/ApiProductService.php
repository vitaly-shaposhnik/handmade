<?php

namespace Acme\HandmadeBundle\Service;

use Acme\HandmadeBundle\Service\ApiService;
use Doctrine\Common\Persistence\ObjectManager;


class ApiProductService extends ApiService
{
    public function __construct(ObjectManager $om, $entityClass, $dtoClass)
    {
        $this->om = $om;
        $this->entityClass = $entityClass;
        $this->repository = $this->om->getRepository($this->entityClass);
        $this->dtoClass = $dtoClass;
    }
}