<?php namespace Mrsuh\RealEstateBundle\DataFixtures\ORM;

use Symfony\Component\Yaml\Parser;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Mrsuh\RealEstateBundle\C;

class LoadAdvertParams extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    private $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function load(ObjectManager $manager)
    {
        $yaml = new Parser();

        foreach ($yaml->parse(file_get_contents($this->container->getParameter('fixtures_advert_type'))) as $p) {
            $manager->getRepository(C::REPO_ADVERT_TYPE)->create($p);
        }

        foreach ($yaml->parse(file_get_contents($this->container->getParameter('fixtures_advert_category'))) as $p) {
            $manager->getRepository(C::REPO_ADVERT_CATEGORY)->create($p);
        }
    }

    public function getOrder()
    {
        return 4;
    }
}