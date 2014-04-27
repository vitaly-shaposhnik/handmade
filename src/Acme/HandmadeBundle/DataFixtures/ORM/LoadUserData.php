<?php

namespace Acme\HandmadeBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

use Acme\HandmadeBundle\Entity\User;

class LoadUserData implements FixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setEmail('test.admin@gmail.com');
        $user->setUsername('admin');
        $user->setPlainPassword('111111');
        $user->setSuperAdmin(true);
        $user->setEnabled(true);
        $manager->persist($user);

        $user = new User();
        $user->setEmail('guest@guest');
        $user->setUsername('guest');
        $user->setPlainPassword(uniqid(rand(111111, 999999), true));
        $user->setEnabled(true);
        $manager->persist($user);

        $manager->flush();
    }
}
