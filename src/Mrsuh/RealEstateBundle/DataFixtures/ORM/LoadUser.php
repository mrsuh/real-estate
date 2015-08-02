<?php namespace Mrsuh\RealEstateBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Mrsuh\RealEstateBundle\C;

class LoadUser implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $roleUser = $manager->getRepository(C::REPO_ROLE)->create(C::ROLE_USER);
        $roleAdmin = $manager->getRepository(C::REPO_ROLE)->create(C::ROLE_ADMIN);

        $manager->getRepository(C::REPO_USER)->create(['username' => 'user', 'password' => 'pass', 'role' => $roleUser, 'firstName' => 'Имя', 'lastName' => 'Фамилия', 'middleName' => 'Отчество']);
        $manager->getRepository(C::REPO_USER)->create(['username' => 'admin', 'password' => 'pass', 'role' => $roleAdmin, 'firstName' => 'Имя', 'lastName' => 'Фамилия', 'middleName' => 'Отчество']);
    }

    public function getOrder()
    {
        return 1;
    }

}