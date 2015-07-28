<?php namespace Mrsuh\RealEstateBundle\Model;

use Mrsuh\RealEstateBundle\C;

class AdvertModel
{
    private $balconyRepo;
    private $heatingRepo;
    private $stateRepo;
    private $typeRepo;
    private $wallRepo;
    private $waterSupplyRepo;
    private $wcRepo;


    private $cityRepo;
    private $regionRepo;
    private $regionCityRepo;
    private $streetRepo;

    public function __construct($em)
    {
        $this->balconyRepo = $em->getRepository(C::REPO_OBJECT_BALCONY);
        $this->heatingRepo = $em->getRepository(C::REPO_OBJECT_HEATING);
        $this->stateRepo = $em->getRepository(C::REPO_OBJECT_STATE);
        $this->typeRepo = $em->getRepository(C::REPO_OBJECT_TYPE);
        $this->wallRepo = $em->getRepository(C::REPO_OBJECT_WALL);
        $this->waterSupplyRepo = $em->getRepository(C::REPO_OBJECT_WATER_SUPPLY);
        $this->wcRepo = $em->getRepository(C::REPO_OBJECT_WC);

        $this->cityRepo = $em->getRepository(C::REPO_ADDRESS_CITY);
        $this->regionRepo = $em->getRepository(C::REPO_ADDRESS_REGION);
        $this->regionCityRepo = $em->getRepository(C::REPO_ADDRESS_REGION_CITY);
        $this->streetRepo = $em->getRepository(C::REPO_ADDRESS_STREET);
    }

    public function getAdvertParams()
    {
        $params = [];

        $repo = [
            'balcony' => $this->balconyRepo->findAll(),
            'heating' => $this->heatingRepo->findAll(),
            'state' => $this->stateRepo->findAll(),
            'type' => $this->typeRepo->findAll(),
            'wall' => $this->wallRepo->findAll(),
            'water_supply' => $this->waterSupplyRepo->findAll(),
            'wc' => $this->wcRepo->findAll(),
            'city' => $this->cityRepo->findAll(),
            'region' => $this->regionRepo->findAll(),
            'region_city' => $this->regionCityRepo->findAll(),
            'street' => $this->streetRepo->findAll(),
        ];

        foreach($repo as $k => $r) {
            foreach($r as $obj) {
                if(!array_key_exists($k, $params)) {
                    $params[$k] = [];
                }
                $params[$k][$obj->getId()] = $obj->getName();
            }
        }

        return $params;
    }
}