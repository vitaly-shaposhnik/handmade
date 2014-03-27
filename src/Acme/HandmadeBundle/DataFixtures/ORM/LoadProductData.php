<?php

namespace Acme\HandmadeBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\File\File;
use Acme\HandmadeBundle\Entity\Product;
use Acme\HandmadeBundle\Entity\Image;

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

        copy(__DIR__.'/ImagesVault/bon03.jpg', __DIR__.'/Images/bon03.jpg');
        $img1 = new File(__DIR__.'/Images/bon03.jpg');
        $image1 = new Image();
        $image1->setName('Name1');
        $image1->imageFile = $img1;
        $image1->evaluateUpload();
        $manager->persist($image1);
        $manager->flush($image1);


        $product = new Product();
        $product->setName('Открытка 1');
        $product->setCategory($category);
        $product->setDescription("описание");
        $product->setImage($image1);
        $product->setPrice(1000);
        $product->setSku('12321323424');
        $product->setAnnotation('аннотация');
        $product->setQuantity(20);

        $manager->persist($product);

        $manager->flush();
    }
}
