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
        copy(__DIR__.'/ImagesVault/empty.png', __DIR__.'/Images/empty.png');

        $img1 = new File(__DIR__.'/Images/empty.png');
        $image1 = new Image();
        $image1->setName('Empty image');
        $image1->imageFile = $img1;
        $image1->evaluateUpload('empty');
        $manager->persist($image1);

        $manager->flush();
    }
}
