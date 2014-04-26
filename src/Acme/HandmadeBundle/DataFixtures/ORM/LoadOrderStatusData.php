<?php

namespace Acme\HandmadeBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

use Acme\HandmadeBundle\Entity\OrderStatus;

class LoadOrderStatusData implements FixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $status = new OrderStatus();
        $status->setName('not_confirmed');
        $status->setActive(true);
        $manager->persist($status);

        $status = new OrderStatus();
        $status->setName('confirmed');
        $status->setActive(true);
        $manager->persist($status);

        $status = new OrderStatus();
        $status->setName('canceled');
        $status->setActive(true);
        $manager->persist($status);

        $manager->flush();
    }
}
