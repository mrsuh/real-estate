<?php namespace Mrsuh\RealEstateBundle\Model;

use Mrsuh\RealEstateBundle\C;

class AdvertModel
{
    private $paramRepo;
    private $advertRepo;
    private $objectRepo;

    public function __construct($em)
    {
        $this->advertRepo = $em->getRepository(C::REPO_ADVERT);
        $this->objectRepo = $em->getRepository(C::REPO_OBJECT);
        $this->paramRepo = [
            'balcony' => $em->getRepository(C::REPO_OBJECT_BALCONY),
            'heating' => $em->getRepository(C::REPO_OBJECT_HEATING),
            'state' => $em->getRepository(C::REPO_OBJECT_STATE),
            'type' => $em->getRepository(C::REPO_OBJECT_TYPE),
            'wall' =>$em->getRepository(C::REPO_OBJECT_WALL),
            'water_supply' => $em->getRepository(C::REPO_OBJECT_WATER_SUPPLY),
            'wc' => $em->getRepository(C::REPO_OBJECT_WC),
            'city' => $em->getRepository(C::REPO_ADDRESS_CITY),
            'region' => $em->getRepository(C::REPO_ADDRESS_REGION),
            'region_city' => $em->getRepository(C::REPO_ADDRESS_REGION_CITY),
            'street' => $em->getRepository(C::REPO_ADDRESS_STREET),
        ];
    }

    public function getAdvertParams()
    {
        $params = [];

        foreach($this->paramRepo as $k => $r) {
            foreach($r->findAll() as $obj) {
                if(!array_key_exists($k, $params)) {
                    $params[$k] = [];
                }
                $params[$k][$obj->getId()] = $obj->getName();
            }
        }

        return $params;
    }

    public function setAdvertParams($params){
        $array = ['object' => [], 'advert' => []];
        foreach($params as $k => $v) {
            if(stristr($k, 'object_')) {
                $key = str_replace('object_', '', $k);
                if(!array_key_exists($key, $this->paramRepo)) {
                    $key = str_replace('object_', '', $k);
                    $array['object'][$key] = $v;
                    continue;
                }
                $repo = $this->paramRepo[$key];
                $array['object'][$key] = $repo->findOneById($v);
            }

            if(stristr($k, 'advert_')) {
                $key = str_replace('advert_', '', $k);
                $array['advert'][$key] = $v;
            }
        }

        return $array;
    }

    public function create($params)
    {
        $params['advert']['object'] = $this->objectRepo->create($params['object']);

        $this->advertRepo->create($params['advert']);
    }

}