<?php

namespace Acme\HandmadeBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

use Acme\HandmadeBundle\Entity\Product;

class LoadProductData implements FixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $category = $manager
            ->getRepository('AcmeHandmadeBundle:Category')
            ->findOneBy(array('id'=>1))
        ;

        $product = new Product();
        $product->setName('Открытка 1');
        $product->setCategory($category);
        $product->setDescription("описание");
//        $product->setImage(1);
        $product->setPrice(1000);
        $product->setSku('12321323424');
        $product->setAnnotation('аннотация');
        $product->setQuantity(20);

        $manager->persist($product);

        $manager->flush();
    }
}
