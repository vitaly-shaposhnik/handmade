<?php

namespace Acme\HandmadeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Acme\HandmadeBundle\Service\Cart;
use Acme\HandmadeBundle\Entity\OrderEntity;
use Acme\HandmadeBundle\Entity\Product;
use Acme\HandmadeBundle\Entity\CartItem;
use Acme\HandmadeBundle\Entity\OrderProduct;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Doctrine\ORM\EntityManager;

class OrderController extends Controller
{
    /**
     * @Template("AcmeHandmadeBundle:Order:new.html.twig")
     */
    public function newAction() {
        /** @var  $cart Cart */
        $cart = $this->get('acme.handmade.cart');

        $entity = new OrderEntity();
        $form = $this->createCreateForm($entity);

        return array(
            'products' => $cart->getCartProducts(),
            'form'     => $form->createView(),
        );
    }

    /**
     * Creates a form to create a OrderEntity.
     *
     * @param OrderEntity $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(OrderEntity $entity)
    {
        $form = $this->createForm('handmade_order', $entity, array(
            'action' => $this->generateUrl('order_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array(
            'label' => 'Завершить оформление',
            'attr' => array('class' => 'ui blue submit button')
        ));

        return $form;
    }

    /**
     * @Template("AcmeHandmadeBundle:Order:new.html.twig")
     */
    public function createAction(Request $request)
    {
        /** @var EntityManager $em */
        $em = $this->getDoctrine()->getManager();

        // order status
        $orderStatus = $em->getRepository('AcmeHandmadeBundle:OrderStatus')->findOneBy(array('name' => 'not_confirmed'));

        /** @var  $cart Cart */
        $cart = $this->get('acme.handmade.cart');
        $cartProducts = $cart->getCartProducts();
        $cartFullProducts = $cart->getProducts();
        if (!$cartFullProducts || empty($cartFullProducts) || !$cartFullProducts) {
            return $this->redirect($this->generateUrl('order_fail'));
        }

        $entity = new OrderEntity();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        $user = $em->getRepository('AcmeHandmadeBundle:User')->findOneBy(array('username' => 'guest'));

        $entity->setTotalPrice($cart->getSum());
        $entity->setUid($user ? $user->getId() : 0);
        $entity->setOrderStatus($orderStatus);

        $products = array();
        foreach ($cartFullProducts as $product) {
            if (!$product instanceof Product) continue;

            /** @var CartItem $cartProduct */
            $cartProduct = $cartProducts[$product->getId()];

            $orderProduct = new OrderProduct();
            $orderProduct->setOrder($entity);
            $orderProduct->setPriceForOne($cartProduct->getPrice());
            $orderProduct->setQuantity($cartProduct->getQuantity());
            $orderProduct->setProductId($product->getId());
            $orderProduct->setName($product->getName());
            $orderProduct->setSku($product->getSku());
            $orderProduct->setCategory($product->getCategory()? $product->getCategory()->getName() : 'none');
            $em->persist($orderProduct);

            $products[] = $orderProduct;
        }
        $entity->setProducts($products);

        if ($form->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('order_complete'));
        }

        return array(
            'products' => $cart->getCartProducts(),
            'form'     => $form->createView(),
        );
    }

    /**
     * @Template("AcmeHandmadeBundle:Order:complete.html.twig")
     */
    public function completeAction() {
        /** @var  $cart Cart */
        $cart = $this->get('acme.handmade.cart');
        $cart->clear();

        return array();
    }

    /**
     * @Template("AcmeHandmadeBundle:Order:fail.html.twig")
     */
    public function failAction() {
        /** @var  $cart Cart */
        $cart = $this->get('acme.handmade.cart');
        $cart->clear();

        return array();
    }
}