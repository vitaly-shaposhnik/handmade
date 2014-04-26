<?php

namespace Acme\HandmadeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use \Acme\HandmadeBundle\Service\Cart;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use \Acme\HandmadeBundle\Entity\CartItem;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use \Acme\HandmadeBundle\Entity\Product;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

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

        return array('products' => $cart->getCartProducts());
    }

    public function clearAction(Request $request)
    {
        /** @var  $cart Cart */
        $cart = $this->get('acme.handmade.cart');
        $cart->clear();

        if ($request->isXmlHttpRequest()) {
            return new JsonResponse([
                'success' => true,
            ]);
        }

        return $this->redirect($this->generateUrl('acme_handmade_homepage'));
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

        return new JsonResponse([
            'success' => true,
        ]);
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

        $data = array_merge($cart->getData(), [
            'totalSum' => $cart->getSum(),
            'totalQuantity' => $cart->count(),
        ]);

        return new JsonResponse([
            'success' => true,
            'data' => $data,
        ]);
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