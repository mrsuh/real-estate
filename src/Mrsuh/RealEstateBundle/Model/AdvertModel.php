<?php namespace Mrsuh\RealEstateBundle\Model;

use Mrsuh\RealEstateBundle\C;

class AdvertModel
{
    private $balconyRepo;
    private $heatingRepo;
    private $stateRepo;
    private $userRepo;
    private $typeRepo;
    private $wallRepo;
    private $waterSupplyRepo;
    private $wcRepo;

    public function __construct($em)
    {
       $this->balconyRepo = $em->getRepository(C::REPO_OBJECT_BALCONY);
       $this->heatingRepo = $em->getRepository(C::REPO_OBJECT_HEATING);
       $this->stateRepo = $em->getRepository(C::REPO_OBJECT_STATE);
       $this->typeRepo = $em->getRepository(C::REPO_OBJECT_TYPE);
       $this->wallRepo = $em->getRepository(C::REPO_OBJECT_WALL);
       $this->waterSupplyRepo = $em->getRepository(C::REPO_OBJECT_WATER_SUPPLY);
       $this->wcRepo = $em->getRepository(C::REPO_OBJECT_WC);
    }

    public function getAdvertParams()
    {
        $params = [
            'balcony' => [],
        'heating' => [],
        'state' => [],
        'type' => [],
        'wall' => [],
        'water_supply' => [],
        'wc' => []
        ];
        foreach($this->balconyRepo->findAll() as $p) {
            $params['balcony'][$p->getId()] = $p->getName();
        }
        foreach($this->heatingRepo->findAll() as $p) {
            $params['heating'][$p->getId()] = $p->getName();
        }
        foreach($this->stateRepo->findAll() as $p) {
            $params['state'][$p->getId()] = $p->getName();
        }
        foreach($this->typeRepo->findAll() as $p) {
            $params['type'][$p->getId()] = $p->getName();
        }
        foreach($this->wallRepo->findAll() as $p) {
            $params['wall'][$p->getId()] = $p->getName();
        }
        foreach($this->waterSupplyRepo->findAll() as $p) {
            $params['water_supply'][$p->getId()] = $p->getName();
        }
        foreach($this->wcRepo->findAll() as $p) {
            $params['wc'][$p->getId()] = $p->getName();
        }

        return $params;
    }
}