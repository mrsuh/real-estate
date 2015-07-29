<?php

namespace Mrsuh\RealEstateBundle\Repository\Object;

use Mrsuh\RealEstateBundle\C;
use Mrsuh\RealEstateBundle\Service\CommonFunction;
use Doctrine\ORM\EntityRepository;
use Mrsuh\RealEstateBundle\Entity\Object\Object;


class ObjectRepository extends EntityRepository
{
    public function create($params)
    {
        $this->_em->beginTransaction();
        try {

            $object = new Object();
            $object->setStatus(C::STATUS_OBJECT_ACTIVE);

            foreach ([
                         'type',
                         'state',
                         'status',
                         'wall',
                         'room_number',
                         'common_area',
                         'live_area',
                         'kitchen_area',
                         'section_area',
                         'floor',
                         'floors',
                         'build_year',
                         'watter_supply',
                         'heating',
                         'new_house',
                         'wc',
                         'balcony',
                         'mortgage',
                         'region',
                         'city',
                         'region_city',
                         'street',
                         'house',
                         'flat',
                         'landmark'
                     ] as $v) {
                if (isset($params[$v]) && !is_null($p = $params[$v])) {
                    $s = 'set' . CommonFunction::dashesToCamelCase($v);
                    $object->$s($p);
                }
            }

            $this->_em->persist($object);

            $this->_em->flush();
            $this->_em->commit();
        } catch (\Exception $e) {
            $this->_em->rollback();
            throw $e;
        }

        return $object;
    }

    public function update($object, $params)
    {
        $this->_em->beginTransaction();
        try {

            foreach ([
                         'type',
                         'state',
                         'status',
                         'wall',
                         'room_number',
                         'common_area',
                         'live_area',
                         'kitchen_area',
                         'section_area',
                         'floor',
                         'floors',
                         'build_year',
                         'watter_supply',
                         'heating',
                         'new_house',
                         'wc',
                         'balcony',
                         'mortgage',
                         'region',
                         'city',
                         'region_city',
                         'street',
                         'house',
                         'flat',
                         'landmark'
                     ] as $v) {
                if (isset($params[$v]) && !is_null($p = $params[$v])) {
                    $s = 'set' . CommonFunction::dashesToCamelCase($v);
                    $object->$s($p);
                }
            }

            $this->_em->persist($object);

            $this->_em->flush();
            $this->_em->commit();
        } catch (\Exception $e) {
            $this->_em->rollback();
            throw $e;
        }

        return $object;
    }
}
