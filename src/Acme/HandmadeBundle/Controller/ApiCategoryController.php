<?php

namespace Acme\HandmadeBundle\Controller;

use FOS\RestBundle\Controller\Annotations;
use FOS\RestBundle\Controller\FOSRestController;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

class ApiCategoryController extends FOSRestController
{
    /**
     * Get list of Category
     *
     * @ApiDoc(
     *      resource = true,
     *      description = "Get a category list",
     *      statusCodes = {
     *          200 = "Returned when successful",
     *          404 = "Returned when the page is not found"
     *      }
     * )
     *
     * @Annotations\View(templateVar="category")
     *
     * @param Request $request the request object
     *
     * @return array
     *
     * @throw NotFoundHttpException when page not exist
     */
    public function getCategoriesAction() {
        $page = $this->container
            ->get('acme.handmade.api.category')
            ->getList();

        return $page;
    }

    /**
     * Get single Category
     *
     * @ApiDoc(
     *      resource = true,
     *      description = "Get a category for a given id",
     *      output = "Acme\HandmadeBundle\Entity\Category",
     *      statusCodes = {
     *          200 = "Returned when successful",
     *          404 = "Returned when the page is not found"
     *      }
     * )
     *
     * @Annotations\View(templateVar="category")
     *
     * @param Request $request the request object
     * @param int     $id      the category id
     *
     * @return object
     *
     * @throw NotFoundHttpException when page not exist
     */
//    public function getCategoryAction($id) {
//        $page = $this->container
//            ->get('acme.handmade.api.category')
//            ->get($id);
//
//        return $page;
//    }

    /**
     * Get single Category by slug
     *
     * @ApiDoc(
     *      resource = true,
     *      description = "Get a category for a given slug",
     *      output = "Acme\HandmadeBundle\Entity\Category",
     *      statusCodes = {
     *          200 = "Returned when successful",
     *          404 = "Returned when the page is not found"
     *      }
     * )
     *
     * @Annotations\View(templateVar="category")
     *
     * @param Request $request the request object
     * @param string  $slug      the category slug
     *
     * @return object
     *
     * @throw NotFoundHttpException when page not exist
     */
    public function getCategoryAction($slug) {
        $page = $this->container
            ->get('acme.handmade.api.category')
            ->getBySlug($slug);

        return $page;
    }

}