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
                         'object_type',
                         'object_state',
                         'object_wall',
                         'object_room_number',
                         'object_common_area',
                         'object_live_area',
                         'object_kitchen_area',
                         'object_section_area',
                         'object_floor',
                         'object_floors',
                         'object_build_year',
                         'object_water_supply',
                         'object_heating',
                         'object_new_house',
                         'object_wc',
                         'object_balcony',
                         'object_mortgage',
                         'object_region',
                         'object_city',
                         'object_region_city',
                         'object_street',
                         'object_house',
                         'object_flat',
                         'object_landmark'
                     ] as $v) {
                if (isset($params[$v]) && !is_null($p = $params[$v])) {
                    $s = 'set' . CommonFunction::dashesToCamelCase(str_replace('object_', '', $v));
                    $object->$s($p);
                }
            }

            $this->_em->persist($object);

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
                         'object_type',
                         'object_state',
                         'object_status',
                         'object_wall',
                         'object_room_number',
                         'object_common_area',
                         'object_live_area',
                         'object_kitchen_area',
                         'object_section_area',
                         'object_floor',
                         'object_floors',
                         'object_build_year',
                         'object_watter_supply',
                         'object_heating',
                         'object_new_house',
                         'object_wc',
                         'object_balcony',
                         'object_mortgage',
                         'object_region',
                         'object_city',
                         'object_region_city',
                         'object_street',
                         'object_house',
                         'object_flat',
                         'object_landmark'
                     ] as $v) {
                if (isset($params[$v]) && !is_null($p = $params[$v])) {
                    $s = 'set' . CommonFunction::dashesToCamelCase(str_replace('object_', '', $v));
                    $object->$s($p);
                }
            }

            $this->_em->persist($object);

            $this->_em->commit();
        } catch (\Exception $e) {
            $this->_em->rollback();
            throw $e;
        }

        return $object;
    }
}
