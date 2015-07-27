<?php namespace Mrsuh\RealEstateBundle\DataFixtures\ORM;

use Symfony\Component\Yaml\Parser;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Mrsuh\RealEstateBundle\C;

class LoadObjectParams extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    private $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function load(ObjectManager $manager)
    {
        $yaml = new Parser();

        foreach ($yaml->parse(file_get_contents($this->container->getParameter('fixtures_object_balcony'))) as $p) {
            $manager->getRepository(C::REPO_OBJECT_BALCONY)->create($p);
        }

        foreach ($yaml->parse(file_get_contents($this->container->getParameter('fixtures_object_heating'))) as $p) {
            $manager->getRepository(C::REPO_OBJECT_HEATING)->create($p);
        }

        foreach ($yaml->parse(file_get_contents($this->container->getParameter('fixtures_object_state'))) as $p) {
            $manager->getRepository(C::REPO_OBJECT_STATE)->create($p);
        }

        foreach ($yaml->parse(file_get_contents($this->container->getParameter('fixtures_object_type'))) as $p) {
            $manager->getRepository(C::REPO_OBJECT_TYPE)->create($p);
        }

        foreach ($yaml->parse(file_get_contents($this->container->getParameter('fixtures_object_wall'))) as $p) {
            $manager->getRepository(C::REPO_OBJECT_WALL)->create($p);
        }

        foreach ($yaml->parse(file_get_contents($this->container->getParameter('fixtures_object_water_supply'))) as $p) {
            $manager->getRepository(C::REPO_OBJECT_WATER_SUPPLY)->create($p);
        }

        foreach ($yaml->parse(file_get_contents($this->container->getParameter('fixtures_object_wc'))) as $p) {
            $manager->getRepository(C::REPO_OBJECT_WC)->create($p);
        }
    }

    public function getOrder()
    {
        return 2;
    }
}