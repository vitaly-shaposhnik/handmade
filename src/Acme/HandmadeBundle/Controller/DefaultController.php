<?php

namespace Acme\HandmadeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('AcmeHandmadeBundle:Default:index.html.twig');
    }
}
