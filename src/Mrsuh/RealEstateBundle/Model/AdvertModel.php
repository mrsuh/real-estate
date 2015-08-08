<?php namespace Mrsuh\RealEstateBundle\Model;

use Mrsuh\RealEstateBundle\C;
use Mrsuh\RealEstateBundle\Service\CommonFunction;

class AdvertModel
{
    private $paramRepo;
    private $advertRepo;
    private $objectRepo;
    private $advertDescriptRepo;
    private $advertImageRepo;
    private $em;
    private $paginator;

    public function __construct($em, $paginator)
    {
        $this->em = $em;
        $this->paginator = $paginator;

        $this->advertRepo = $em->getRepository(C::REPO_ADVERT);
        $this->objectRepo = $em->getRepository(C::REPO_OBJECT);
        $this->advertDescriptRepo = $em->getRepository(C::REPO_ADVERT_DESCRIPTION);
        $this->advertImageRepo = $em->getRepository(C::REPO_ADVERT_IMAGE);
        $this->paramRepo = [
            'object_balcony' => $em->getRepository(C::REPO_OBJECT_BALCONY),
            'object_heating' => $em->getRepository(C::REPO_OBJECT_HEATING),
            'object_state' => $em->getRepository(C::REPO_OBJECT_STATE),
            'object_type' => $em->getRepository(C::REPO_OBJECT_TYPE),
            'object_wall' =>$em->getRepository(C::REPO_OBJECT_WALL),
            'object_water_supply' => $em->getRepository(C::REPO_OBJECT_WATER_SUPPLY),
            'object_wc' => $em->getRepository(C::REPO_OBJECT_WC),
            'object_city' => $em->getRepository(C::REPO_ADDRESS_CITY),
            'object_region' => $em->getRepository(C::REPO_ADDRESS_REGION),
            'object_region_city' => $em->getRepository(C::REPO_ADDRESS_REGION_CITY),
            'object_street' => $em->getRepository(C::REPO_ADDRESS_STREET),

            'advert_type' => $em->getRepository(C::REPO_ADVERT_TYPE),
            'advert_category' => $em->getRepository(C::REPO_ADVERT_CATEGORY),
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
        foreach($params as $k => $v) {
            if(array_key_exists($k, $this->paramRepo)) {
                $repo = $this->paramRepo[$k];
                $params[$k] = $repo->findOneById($v);
            }
        }

        return $params;
    }

    public function create($params, $user)
    {
        $this->em->beginTransaction();
        try{

            $params['advert_object'] = $this->objectRepo->create($params);
            $params['advert_user'] = $user;
            $params['advert_description'] = $this->advertDescriptRepo->create(['description' => $params['description_description'], 'comment' => $params['description_comment']]);
            $advert = $this->advertRepo->create($params);

            foreach($params['advert_image'] as $i) {
                if(is_null($i->getType())) {
                    continue;
                }
                $i->setAdvert($advert);
                $this->em->persist($i);
            }

            $this->em->flush();
            $this->em->commit();
        } catch(\Exception $e){
            $this->em->rollback();
            throw $e;
        }
    }

    public function update($advert, $params)
    {
        $this->em->beginTransaction();
        try{
            $params['advert_description'] = $this->advertDescriptRepo->update($advert->getDescription(), ['description' => $params['description_description'], 'comment' => $params['description_comment']]);

            if(C::STATUS_ADVERT_DELETED === $params['advert_status']) {
                $params['advert_expire_time'] = new \DateTime();
            }

            $this->objectRepo->update($advert->getObject(), $params);
            $this->advertRepo->update($advert, $params);

//            foreach($params['advert_image'] as $i) {
//                if(is_null($i->getType())) {
//                    continue;
//                }
//                $i->setAdvert($advert);
//                $this->em->persist($i);
//            }

            $this->em->flush();
            $this->em->commit();
        } catch(\Exception $e){
            $this->em->rollback();
            throw $e;
        }
    }

    public function getOneById($id)
    {
        return $this->advertRepo->findOneById($id);
    }

    public function findByParam()
    {
        return $this->advertRepo->findAll();
    }

    public function findByString($params)
    {
        return $this->paginator->paginate($this->advertRepo->findByString($params), $params['pagination_page'], $params['pagination_items_on_page']);
    }

    public function findByExtensionParams($params)
    {
        return $this->paginator->paginate($this->advertRepo->findByExtensionParams($params), $params['pagination_page'], $params['pagination_items_on_page']);
    }

    public function findToArchive()
    {
        return $this->advertRepo->findByStatus(C::STATUS_ADVERT_REQUEST_DELETE);
    }



}