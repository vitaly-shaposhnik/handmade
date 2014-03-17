<?php

namespace Acme\HandmadeBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\File\File;

use Acme\HandmadeBundle\Entity\Image;

class LoadImageData implements FixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
//        copy(__DIR__.'/ImagesVault/1.jpg', __DIR__.'/Images/1.jpg');
//        copy(__DIR__.'/ImagesVault/2.jpg', __DIR__.'/Images/2.jpg');
//        copy(__DIR__.'/ImagesVault/3.jpg', __DIR__.'/Images/3.jpg');
//
//        $img1 = new File(__DIR__.'/Images/1.jpg');
//        $image1 = new Image();
//        $image1->setName('Name1');
//        $image1->imageFile = $img1;
//        $image1->evaluateUpload();
//        $manager->persist($image1);
//
//        $img2 = new File(__DIR__.'/Images/2.jpg');
//        $image2 = new Image();
//        $image2->setName('Name2');
//        $image2->imageFile = $img2;
//        $image2->evaluateUpload();
//        $manager->persist($image2);
//
//
//        $img3 = new File(__DIR__.'/Images/3.jpg');
//        $image3 = new Image();
//        $image3->setName('Name3');
//        $image3->imageFile = $img3;
//        $image3->evaluateUpload();
//        $manager->persist($image3);
//
//        $manager->flush();
    }
}
