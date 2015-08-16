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

        $manager->getRepository(C::REPO_USER)->create(['username' => 'user', 'password' => 'pass', 'role' => $roleUser, 'first_name' => 'Имя', 'last_name' => 'Фамилия', 'middle_name' => 'Отчество', 'email' => 'mail@mail.ru']);
        $manager->getRepository(C::REPO_USER)->create(['username' => 'admin', 'password' => 'pass', 'role' => $roleAdmin, 'first_name' => 'Имя1', 'last_name' => 'Фамилия1', 'middle_name' => 'Отчество1', 'email' => 'mail1@mail.ru']);
        $manager->getRepository(C::REPO_USER)->create(['username' => C::SYSTEM_USER, 'password' => 'pass', 'role' => $roleAdmin, 'first_name' => 'пользователь', 'last_name' => 'Системный', 'middle_name' => '', 'email' => '']);
    }

    public function getOrder()
    {
        return 1;
    }

}