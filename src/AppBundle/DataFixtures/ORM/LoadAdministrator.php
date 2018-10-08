<?php

namespace AppBundle\DataFixtures\ORM;

use AdminBundle\Entity\Administrator;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class LoadAdministrator implements FixtureInterface, ContainerAwareInterface  {

    /** @var ContainerInterface */
    private $container;

    public function load(ObjectManager $manager)
    {
        $this->loadUsers($manager);
    }

    private function loadUsers(ObjectManager $manager)
    {
        $admin = new Administrator();
        $admin->setUsername('superadmin');
        $admin->setEmail('admin@gmail.com');
        $admin->setName('Admin');
        $admin->setPlainPassword('adminpass');
        $admin->setIsActive(true);
        $admin->addRole('ROLE_SUPER_ADMIN');

        $factory = $this->container->get('security.encoder_factory');
        $encoder = $factory->getEncoder($admin);
        $admin->encodePassword($encoder);

        $manager->persist($admin);
        $manager->flush();
    }

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

}