<?php

namespace Acme\HandmadeBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Acme\HandmadeBundle\Entity\Product;
use Acme\HandmadeBundle\Form\ProductType;

/**
 * Product controller.
 *
 */
class ProductController extends Controller
{
//    /** Lists all Product entities.
//     * @Template("AcmeHandmadeBundle:Product:index.html.twig")
//     */
//    public function indexAction()
//    {
//        $em = $this->getDoctrine()->getManager();
//        $entities = $em->getRepository('AcmeHandmadeBundle:Product')->findAll();
//
//        return array('entities' => $entities);
//    }

    /**
     * Finds and displays a Product entity.
     * @Template("AcmeHandmadeBundle:Product:show.html.twig")
     */
    public function showAction($slug)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('AcmeHandmadeBundle:Product')->findOneBy(array('slug' => $slug));

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Product entity.');
        }

        return array('entity' => $entity);
    }

    public function topAction()
    {
        $em = $this->getDoctrine()->getManager();
        $products = $em->getRepository('AcmeHandmadeBundle:Product')->findBy(array('show_on_homepage' => true), null, 6);
        $blocks = array_chunk($products, 3);

        $response =  $this->render('AcmeHandmadeBundle:Product:top.html.twig', array(
            'blocks' => $blocks,
        ));
        $response->setSharedMaxAge(600);

        return $response;
    }
}
