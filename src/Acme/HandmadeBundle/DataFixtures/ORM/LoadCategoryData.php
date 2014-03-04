<?php

namespace Acme\HandmadeBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

use Acme\HandmadeBundle\Entity\Category;

class LoadCategoryData implements FixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $category = new Category();
        $category->setName("Открытки");
        $category->setWeight(1);
        $manager->persist($category);

        $category = new Category();
        $category->setName("Бонбоньерки");
        $category->setWeight(2);
        $manager->persist($category);

        $manager->flush();
    }
}
