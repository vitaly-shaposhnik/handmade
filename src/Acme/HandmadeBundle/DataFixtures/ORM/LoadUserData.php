<?php

namespace Acme\HandmadeBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Acme\HandmadeBundle\Entity\User;
use Psr\Log\LoggerInterface;

class LoadUserData implements FixtureInterface, ContainerAwareInterface
{
    private $container;

    /**
     * {@inheritDoc}
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        /** @var $logger LoggerInterface */
        $logger = $this->container->get('logger');

        $user = new User();
        $user->setEmail('test.admin@gmail.com');
        $user->setUsername('admin');
        $user->setPlainPassword('111111');
        $user->setSuperAdmin(true);
        $user->setEnabled(true);
        $manager->persist($user);
        $manager->flush();

        $logger->info('User data fixtures complete.');
        $logger->debug('User data fixtures complete.');
    }
}
