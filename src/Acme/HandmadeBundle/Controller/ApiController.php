<?php

namespace Acme\HandmadeBundle\Controller;

use FOS\RestBundle\Controller\Annotations;
use FOS\RestBundle\Controller\FOSRestController;
use Acme\HandmadeBundle\DTO\Category as DtoCategory;
use Acme\HandmadeBundle\Entity\Category;

class ApiController extends FOSRestController {

    /**
     * @Annotations\View
     */
    public function getCategoriesAction() {
        $em = $this->getDoctrine()->getManager();
        $categories = $em->getRepository('AcmeHandmadeBundle:Category')->findAll();

        $result = [];
        foreach ($categories as $category) {
            if (!$category instanceof \Acme\HandmadeBundle\Entity\Category) {
                continue;
            }

            $result[] = $category->transferObjectToDto($category, new DtoCategory());
        }

        return $result;
    }
}