<?php

namespace Acme\HandmadeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $response =  $this->render('AcmeHandmadeBundle:Default:index.html.twig');
        $response->setSharedMaxAge(600);

        return $response;
    }

    public function mainMenuAction()
    {
        $em = $this->getDoctrine()->getManager();
        $items = $em->getRepository('AcmeHandmadeBundle:Category')->findBy(array('show_in_main_menu' => true));

        $response =  $this->render('AcmeHandmadeBundle:Default:main_menu.html.twig', array(
            'items' => $items,
        ));
        $response->setSharedMaxAge(600);

        return $response;
    }

    public function footerAction()
    {
        $em = $this->getDoctrine()->getManager();
        $categories = $em->getRepository('AcmeHandmadeBundle:Category')->findAll();

        $response =  $this->render('AcmeHandmadeBundle:Default:footer.html.twig', array(
            'categories' => $categories,
        ));
        $response->setSharedMaxAge(600);

        return $response;
    }
}
