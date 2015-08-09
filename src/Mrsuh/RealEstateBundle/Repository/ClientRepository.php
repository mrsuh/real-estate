<?php

namespace Mrsuh\RealEstateBundle\Repository;

use Mrsuh\RealEstateBundle\Service\CommonFunction;
use Doctrine\ORM\EntityRepository;
use Mrsuh\RealEstateBundle\Entity\Client;


class ClientRepository extends EntityRepository
{
    public function create($params)
    {
        $this->_em->beginTransaction();
        try {

            $obj = new Client();

            $time = new \DateTime();
            $obj->setCreateTime($time);
            $obj->setUpdateTime($time);

            foreach ([
                         'name1',
                         'name2',
                         'name3',
                         'phone1',
                         'phone2',
                         'phone3',
                         'city',
                         'region_city',
                         'object_type',
                         'price_from',
                         'price_to',
                         'room_from',
                         'room_to',
                         'common_area_from',
                         'common_area_to',
                         'live_area_from',
                         'live_area_to',
                         'kitchen_area_from',
                         'kitchen_area_to',
                         'section_area_from',
                         'section_area_to',
                         'floor_from',
                         'floor_to',
                         'floors_from',
                         'floors_to',
                         'user',
                         'birth_day',
                         'status',
                         'process_time',
                         'show_time',
                         'comment',
                         'mortgage',
                         'hot',

                     ] as $v) {
                if (isset($params[$v]) && !is_null($p = $params[$v])) {
                    $s = 'set' . CommonFunction::dashesToCamelCase($v);
                    $obj->$s($p);
                }
            }

            $this->_em->persist($obj);

            $this->_em->flush();
            $this->_em->commit();
        } catch (\Exception $e) {
            $this->_em->rollback();
            throw $e;
        }

        return $obj;
    }

    public function update($obj, $params)
    {
        $this->_em->beginTransaction();
        try {
            $obj->setUpdateTime(new \DateTime());
            foreach ([
                         'name1',
                         'name2',
                         'name3',
                         'phone1',
                         'phone2',
                         'phone3',
                         'city',
                         'region_city',
                         'object_type',
                         'price_from',
                         'price_to',
                         'room_from',
                         'room_to',
                         'common_area_from',
                         'common_area_to',
                         'live_area_from',
                         'live_area_to',
                         'kitchen_area_from',
                         'kitchen_area_to',
                         'section_area_from',
                         'section_area_to',
                         'floor_from',
                         'floor_to',
                         'floors_from',
                         'floors_to',
                         'birth_day',
                         'status',
                         'comment',
                         'mortgage',
                         'hot',

                     ] as $v) {
                if (array_key_exists($v, $params)) {
                    $s = 'set' . CommonFunction::dashesToCamelCase($v);
                    $obj->$s($params[$v]);
                }
            }

            $this->_em->persist($obj);

            $this->_em->commit();
        } catch (\Exception $e) {
            $this->_em->rollback();
            throw $e;
        }

        return $obj;
    }
}
