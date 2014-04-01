<?php

namespace Acme\HandmadeBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

class ApiProductController extends FOSRestController
{
    /**
     * Get list of Product
     *
     * @ApiDoc(
     *      resource = true,
     *      description = "Get a product list",
     *      statusCodes = {
     *          200 = "Returned when successful",
     *          404 = "Returned when the page is not found"
     *      }
     * )
     *
     * @Annotations\View(templateVar="product")
     *
     * @param Request $request the request object
     *
     * @return array
     *
     * @throw NotFoundHttpException when page not exist
     */
    public function getProductsAction() {
        $page = $this->container
            ->get('acme.handmade.api.product')
            ->getList();

        return $page;
    }

    /**
     * Get single product
     *
     * @ApiDoc(
     *      resource = true,
     *      description = "Get a v for a given id",
     *      output = "Acme\HandmadeBundle\Entity\Product",
     *      statusCodes = {
     *          200 = "Returned when successful",
     *          404 = "Returned when the page is not found"
     *      }
     * )
     *
     * @Annotations\View(templateVar="product")
     *
     * @param Request $request the request object
     * @param int     $id      the product id
     *
     * @return object
     *
     * @throw NotFoundHttpException when page not exist
     */
//    public function getProductAction($id) {
//        $page = $this->container
//            ->get('acme.handmade.api.product')
//            ->get($id);
//
//        return $page;
//    }

    /**
     * Get single product by slug
     *
     * @ApiDoc(
     *      resource = true,
     *      description = "Get a product for a given slug",
     *      output = "Acme\HandmadeBundle\Entity\Product",
     *      statusCodes = {
     *          200 = "Returned when successful",
     *          404 = "Returned when the page is not found"
     *      }
     * )
     *
     * @Annotations\View(templateVar="product")
     *
     * @param Request $request the request object
     * @param string  $slug      the product slug
     *
     * @return object
     *
     * @throw NotFoundHttpException when page not exist
     */
    public function getProductAction($slug) {
        $page = $this->container
            ->get('acme.handmade.api.product')
            ->getBySlug($slug);

        return $page;
    }
}