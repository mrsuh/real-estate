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
                         'advert_expire_time',
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
}
