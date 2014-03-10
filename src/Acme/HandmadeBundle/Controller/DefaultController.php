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
}
