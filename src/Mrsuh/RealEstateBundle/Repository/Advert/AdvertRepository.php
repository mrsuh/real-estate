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
                         'advert_description',
                         'advert_type',
                         'advert_status',
                         'advert_expire_time',
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

    public function findByString($params)
    {
        $qb = $this->createQueryBuilder('a');

        if(!is_null($params['search_string_type']) && !is_null($params['search_string_string'])) {
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
        } else {
            return [];
        }

        return $qb->getQuery()->getResult();

    }

    public function findByExtensionParams($params)
    {
        $qb = $this->createQueryBuilder('a')
                ->join('a.object', 'object');


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

        if(!is_null($params['object_type'])) {
            $qb->join('object.type', 'object_type');
            $query = '';
            foreach($params['object_type'] as $k => $v) {
                if(!is_null($v)) {
                    $query .= 'object_type.id = :object_type' . $k . ' OR ';
                        $qb->setParameter('object_type' . $k, $v);
                }
                $qb->andWhere($query);
            }
        }

        if(!is_null($params['object_state'])) {
            $qb->join('object.state', 'object_state');
            foreach($params['object_state'] as $k => $v) {
                if(!is_null($v)) {
                    $qb->orWhere('object_state.id = :object_state' . $k)
                        ->setParameter('object_state' . $k, $v);
                }
            }
        }

        if(!is_null($params['object_wall'])) {
            $qb->join('object.wall', 'object_wall');
            foreach($params['object_wall'] as $k => $v) {
                if(!is_null($v)) {
                    $qb->orWhere('object_wall.id = :object_wall' . $k)
                        ->setParameter('object_wall' . $k, $v);
                }
            }
        }

        return $qb->getQuery()->getResult();
    }
}
