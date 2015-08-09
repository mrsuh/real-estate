<?php

namespace Mrsuh\RealEstateBundle\Repository\Advert;

use Mrsuh\RealEstateBundle\Service\CommonFunction;
use Doctrine\ORM\EntityRepository;
use Mrsuh\RealEstateBundle\C;
use Mrsuh\RealEstateBundle\Entity\Advert\Advert;


class AdvertRepository extends EntityRepository
{
    public function create($params)
    {
        $this->_em->beginTransaction();
        try {

            $advert = new Advert();
            $advert->setStatus(C::STATUS_ADVERT_ACTIVE);

            $time = new \DateTime();
            $advert->setCreateTime($time);
            $advert->setUpdateTime($time);

            foreach ([
                         'advert_user',
                         'advert_type',
                         'advert_description',
                         'advert_object',
                         'advert_exclusive',
                         'advert_seller_name1',
                         'advert_seller_name2',
                         'advert_seller_name3',
                         'advert_seller_phone1',
                         'advert_seller_phone2',
                         'advert_seller_phone3',
                         'advert_price',
                         'advert_meter_price',
                         'advert_category'

                     ] as $v) {
                if (isset($params[$v]) && !is_null($p = $params[$v])) {
                    $s = 'set' . CommonFunction::dashesToCamelCase(str_replace('advert_', '', $v));
                    $advert->$s($p);
                }
            }

            $this->_em->persist($advert);

            $this->_em->flush();
            $this->_em->commit();
        } catch (\Exception $e) {
            $this->_em->rollback();
            throw $e;
        }

        return $advert;
    }

    public function update($advert, $params)
    {
        $this->_em->beginTransaction();
        try {

            $advert->setUpdateTime(new \DateTime());

            foreach ([
                         'advert_user',
                         'advert_type',
                         'advert_description',
                         'advert_object',
                         'advert_exclusive',
                         'advert_seller_name1',
                         'advert_seller_name2',
                         'advert_seller_name3',
                         'advert_seller_phone1',
                         'advert_seller_phone2',
                         'advert_seller_phone3',
                         'advert_price',
                         'advert_meter_price',
                         'advert_category',
                         'advert_expire_time',
                         'advert_status',

                     ] as $v) {
                if (isset($params[$v]) && !is_null($p = $params[$v])) {
                    $s = 'set' . CommonFunction::dashesToCamelCase(str_replace('advert_', '', $v));
                    $advert->$s($p);
                }
            }

            $this->_em->commit();
        } catch (\Exception $e) {
            $this->_em->rollback();
            throw $e;
        }

        return $advert;
    }

    public function findByString($params)
    {
        $qb = $this->createQueryBuilder('a');

        if(!is_null($params['advert_type'])) {
            $qb->andWhere('a.type = :advert_type')
               ->setParameter('advert_type', $params['advert_type']);
        }

        if(!is_null($params['advert_user'])) {
            $qb->join('a.user', 'user')
                ->andWhere('user.id = :advert_user')
                ->setParameter('advert_user', $params['advert_user']);
        }

        if(!is_null($params['advert_status'])) {
            $qb->andWhere('a.status = :advert_status');
            $qb->setParameter('advert_status', $params['advert_status']);
        }

        if(!is_null($params['search_string_string'])) {
            $qb->join('a.object', 'object');
            switch($params['search_string_type']) {
                case C::OBJECT_NUMBER:
                    $qb->andWhere('object.id LIKE :string');
                    break;
                case C::PHONE_NUMBER:
                    $qb->andWhere('a.sellerPhone1 LIKE :string OR a.sellerPhone2 LIKE :string OR a.sellerPhone3 LIKE :string');
                    break;
                case C::STREET_NAME:
                    $qb->join('object.street', 'street');
                    $qb->andWhere('street.name LIKE :string');
                    break;
                case C::LANDMARK:
                    $qb->andWhere('object.landmark LIKE :string');
                    break;
                case C::DESCRIPTION:
                    $qb->join('a.description', 'description');
                    $qb->andWhere('description.description LIKE :string');
                    break;
            }

            $qb->setParameter('string', '%'.$params['search_string_string'].'%');
        }

        if(!is_null($params['order_field'])){
            if(is_null($params['search_string_string'])){
                $qb->join('a.object', 'object');
            }
            switch($params['order_field']){
                case 'id':
                    $qb->orderBy('a.id', $params['order_type']);
                    break;
                case 'city':
                    $qb->join('object.city', 'object_city');
                    $qb->orderBy('object_city.id', $params['order_type']);
                    break;
                case 'region':
                    $qb->join('object.region', 'object_region');
                    $qb->orderBy('object_region.id', $params['order_type']);
                    break;
                case 'price':
                    $qb->orderBy('a.price', $params['order_type']);
                    break;
                case 'status':
                    $qb->orderBy('a.status', $params['order_type']);
                    break;
                case 'create_time':
                    $qb->orderBy('a.createTime', $params['order_type']);
                    break;
                case 'update_time':
                    $qb->orderBy('a.updateTime', $params['order_type']);
                    break;
                case 'expire_time':
                    $qb->orderBy('a.expireTime', $params['order_type']);
                    break;
            }
        }

        return $qb->getQuery();

    }

    public function findByExtensionParams($params)
    {
        $qb = $this->createQueryBuilder('a')
                ->join('a.object', 'object');

        if(!is_null($params['advert_type'])) {
            $qb->andWhere('a.type = :advert_type')
                ->setParameter('advert_type', $params['advert_type']);
        }

        if(!is_null($params['advert_user'])) {
            $qb->join('a.user', 'user')
                ->andWhere('user.id = :advert_user')
                ->setParameter('advert_user', $params['advert_user']);
        }

        if(!is_null($params['advert_status'])) {
            $qb->andWhere('a.status = :advert_status');
            $qb->setParameter('advert_status', $params['advert_status']);
        }


        //price
        if(!is_null($params['price_from'])) {
            $qb->andWhere('a.price >= :price_from')
                ->setParameter('price_from', $params['price_from']);
        }

        if(!is_null($params['price_to'])) {
            $qb->andWhere('a.price <= :price_to')
                ->setParameter('price_to', $params['price_to']);
        }

        //meter price
        if(!is_null($params['meter_price_from'])) {
            $qb->andWhere('a.meterPrice >= :meter_price_from')
                ->setParameter('meter_price_from', $params['meter_price_from']);
        }

        if(!is_null($params['meter_price_to'])) {
            $qb->andWhere('a.meterPrice <= :meter_price_to')
                ->setParameter('meter_price_to', $params['meter_price_to']);
        }

        //room
        if(!is_null($params['room_from'])) {
            $qb->andWhere('object.roomNumber >= :room_from')
                ->setParameter('room_from', $params['room_from']);
        }

        if(!is_null($params['room_to'])) {
            $qb->andWhere('object.roomNumber <= :room_to')
                ->setParameter('room_to', $params['room_to']);
        }

        //common area
        if(!is_null($params['common_area_from'])) {
            $qb->andWhere('object.commonArea >= :common_area_from')
                ->setParameter('common_area_from', $params['common_area_from']);
        }

        if(!is_null($params['common_area_to'])) {
            $qb->andWhere('object.commonArea <= :common_area_to')
                ->setParameter('common_area_to', $params['common_area_to']);
        }

        //live area
        if(!is_null($params['live_area_from'])) {
            $qb->andWhere('object.liveArea >= :live_area_from')
                ->setParameter('live_area_from', $params['live_area_from']);
        }

        if(!is_null($params['live_area_to'])) {
            $qb->andWhere('object.liveArea <= :live_area_to')
                ->setParameter('live_area_to', $params['live_area_to']);
        }

        //kitchen area
        if(!is_null($params['kitchen_area_from'])) {
            $qb->andWhere('object.kitchenArea >= :kitchen_area_from')
                ->setParameter('kitchen_area_from', $params['kitchen_area_from']);
        }

        if(!is_null($params['kitchen_area_to'])) {
            $qb->andWhere('object.kitchenArea <= :kitchen_area_to')
                ->setParameter('kitchen_area_to', $params['kitchen_area_to']);
        }

        //section area
        if(!is_null($params['section_area_from'])) {
            $qb->andWhere('object.sectionArea >= :section_area_from')
                ->setParameter('section_area_from', $params['section_area_from']);
        }

        if(!is_null($params['section_area_to'])) {
            $qb->andWhere('object.sectionArea <= :section_area_to')
                ->setParameter('section_area_to', $params['section_area_to']);
        }

        //floor
        if(!is_null($params['floor_from'])) {
            $qb->andWhere('object.floor >= :floor_from')
                ->setParameter('floor_from', $params['floor_from']);
        }

        if(!is_null($params['floor_to'])) {
            $qb->andWhere('object.floor <= :floor_to')
                ->setParameter('floor_to', $params['floor_to']);
        }

        //floor
        if(!is_null($params['floors_from'])) {
            $qb->andWhere('object.floors >= :floors_from')
                ->setParameter('floors_from', $params['floors_from']);
        }

        if(!is_null($params['floors_to'])) {
            $qb->andWhere('object.floors <= :floors_to')
                ->setParameter('floors_to', $params['floors_to']);
        }

        //build year
        if(!is_null($params['build_year_from'])) {
            $qb->andWhere('object.buildYear >= :build_year_from')
                ->setParameter('build_year_from', $params['build_year_from']);
        }

        if(!is_null($params['build_year_to'])) {
            $qb->andWhere('object.buildYear <= :build_year_to')
                ->setParameter('build_year_to', $params['build_year_to']);
        }

        if(!is_null($params['object_region'])) {
            $qb->join('object.region', 'object_region');
            $qb->andWhere('object_region.id = :object_region')
                ->setParameter('object_region', $params['object_region']);
        }

        if(!is_null($params['object_city'])) {
            $qb->join('object.city', 'object_city');
            $qb->andWhere('object_city.id = :object_city')
                ->setParameter('object_city', $params['object_city']);
        }

        if(!is_null($params['object_region_city']) && !empty($params['object_region_city'])) {
            $qb->join('object.regionCity', 'object_region_city');
            $qb->andWhere('object_region_city.id IN (:object_region_city)')
                ->setParameter('object_region_city', array_values($params['object_region_city']));
        }


        if(!is_null($params['object_state']) && !empty($params['object_state'])) {
            $qb->join('object.state', 'object_state');
            $qb->andWhere('object_state.id IN (:object_state)')
                ->setParameter('object_state', array_values($params['object_state']));
        }
//
        if(!is_null($params['object_type']) && !empty($params['object_type'])) {
            $qb->join('object.type', 'object_type');
            $qb->andWhere('object_type.id IN (:object_type)')
                ->setParameter('object_type', array_values($params['object_type']));
        }

        if(!is_null($params['object_wall']) && !empty($params['object_wall'])) {
            $qb->join('object.wall', 'object_wall');
            $qb->andWhere('object_wall.id IN (:object_wall)')
                ->setParameter('object_wall', array_values($params['object_wall']));
        }

        if(!is_null($params['not_first_floor']) && $params['not_first_floor']) {
            $qb->andWhere('object.floor != :not_first_floor')
                ->setParameter('not_first_floor', 1);
        }

        if(!is_null($params['not_last_floor']) && $params['not_last_floor']) {
            $qb->andWhere('object.floor != object.floors');
        }


        if(!is_null($params['order_field'])){
            switch($params['order_field']){
                case 'id':
                    $qb->orderBy('a.id', $params['order_type']);
                    break;
                case 'city':
                    if(is_null($params['object_city'])) {
                        $qb->join('object.city', 'object_city');
                    }
                    $qb->orderBy('object_city.id', $params['order_type']);
                    break;
                case 'region':
                    if(is_null($params['object_region'])) {
                        $qb->join('object.region', 'object_region');
                    }
                    $qb->orderBy('object_region.id', $params['order_type']);
                    break;
                case 'price':
                    $qb->orderBy('a.price', $params['order_type']);
                    break;
                case 'status':
                    $qb->orderBy('a.status', $params['order_type']);
                    break;
                case 'create_time':
                    $qb->orderBy('a.createTime', $params['order_type']);
                    break;
                case 'update_time':
                    $qb->orderBy('a.updateTime', $params['order_type']);
                    break;
                case 'expire_time':
                    $qb->orderBy('a.expireTime', $params['order_type']);
                    break;
            }
        }

        return $qb->getQuery();
    }
}
