<?php namespace Mrsuh\RealEstateBundle\DataFixtures\ORM;

use Symfony\Component\Yaml\Parser;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Mrsuh\RealEstateBundle\C;

class LoadAddressParams extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    private $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function load(ObjectManager $manager)
    {
        $yaml = new Parser();

        foreach ($yaml->parse(file_get_contents($this->container->getParameter('fixtures_address_region'))) as $p) {
            $manager->getRepository(C::REPO_ADDRESS_REGION)->create($p);
        }

        foreach ($yaml->parse(file_get_contents($this->container->getParameter('fixtures_address_city'))) as $p) {
            $manager->getRepository(C::REPO_ADDRESS_CITY)->create($p);
        }

        foreach ($yaml->parse(file_get_contents($this->container->getParameter('fixtures_address_region_city'))) as $p) {
            $manager->getRepository(C::REPO_ADDRESS_REGION_CITY)->create($p);
        }

        foreach ($yaml->parse(file_get_contents($this->container->getParameter('fixtures_address_street'))) as $p) {
            $manager->getRepository(C::REPO_ADDRESS_STREET)->create($p);
        }

    }

    public function getOrder()
    {
        return 3;
    }
}