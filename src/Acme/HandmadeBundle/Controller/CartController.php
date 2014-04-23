<?php

namespace Acme\HandmadeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use \Acme\HandmadeBundle\Service\Cart;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use \Acme\HandmadeBundle\Entity\CartItem;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use \Acme\HandmadeBundle\Entity\Product;
use Symfony\Component\HttpFoundation\Request;

class CartController extends Controller
{
    /**
     * @Template("AcmeHandmadeBundle:Cart:show.html.twig")
     * @return CartItem[]
     */
    public function showAction()
    {
        /** @var  $cart Cart */
        $cart = $this->get('acme.handmade.cart');

        return array('products' => $cart->getProducts());
    }

    public function clearAction(Request $request)
    {
        if (!$request->isXmlHttpRequest()) {
            throw new \Exception('Must be XmlHttpRequest');
        }

        /** @var  $cart Cart */
        $cart = $this->get('acme.handmade.cart');
        $cart->clear();
    }

    /**
     * @ParamConverter("product", class="AcmeHandmadeBundle:Product")
     */
    public function addAction(Request $request, Product $product)
    {
        if (!$request->isXmlHttpRequest()) {
            throw new \Exception('Must be XmlHttpRequest');
        }

        /** @var  $cart Cart */
        $cart = $this->get('acme.handmade.cart');
        $cart->setProduct($product);
    }

    /**
     * @ParamConverter("product", class="AcmeHandmadeBundle:Product")
     */
    public function deleteAction(Request $request, Product $product)
    {
        if (!$request->isXmlHttpRequest()) {
            throw new \Exception('Must be XmlHttpRequest');
        }

        /** @var  $cart Cart */
        $cart = $this->get('acme.handmade.cart');
        $cart->deleteProduct($product);
    }

    public function sumAction(Request $request)
    {
        if (!$request->isXmlHttpRequest()) {
            throw new \Exception('Must be XmlHttpRequest');
        }

        /** @var  $cart Cart */
        $cart = $this->get('acme.handmade.cart');

        return $cart->getSum();
    }
} 