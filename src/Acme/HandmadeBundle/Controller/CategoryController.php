<?php

namespace Acme\HandmadeBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Acme\HandmadeBundle\Entity\Category;
use Acme\HandmadeBundle\Form\CategoryType;

/**
 * Category controller.
 *
 */
class CategoryController extends Controller
{
//    /** Lists all Category entities.
//     * @Template("AcmeHandmadeBundle:Category:index.html.twig")
//     */
//    public function indexAction()
//    {
//        $em = $this->getDoctrine()->getManager();
//        $entities = $em->getRepository('AcmeHandmadeBundle:Category')->findAll();
//
//        return array('entities' => $entities);
//    }

    /**
     * Finds and displays a Category entity.
     * @Template("AcmeHandmadeBundle:Category:show.html.twig")
     */
    public function showAction($slug)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('AcmeHandmadeBundle:Category')->findOneBy(array('slug' => $slug));

        $products = $em->getRepository('AcmeHandmadeBundle:Product')->findBy(array('category' => $entity), null, 12);
        $blocks = array_chunk($products, 4);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Category entity.');
        }

        return array(
            'entity' => $entity,
            'blocks' => $blocks,
        );
    }
}
