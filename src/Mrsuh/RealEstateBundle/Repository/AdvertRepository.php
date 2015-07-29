<?php

namespace Mrsuh\RealEstateBundle\Repository;

use Mrsuh\RealEstateBundle\Service\CommonFunction;
use Doctrine\ORM\EntityRepository;
use Mrsuh\RealEstateBundle\C;
use Mrsuh\RealEstateBundle\Entity\Advert;


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
            $advert->setExpireTime($time);
            $advert->setType(C::TYPE_ADVERT_RENT);

            foreach (['user', 'description', 'object', 'exclusive'] as $v) {
                if (isset($params[$v]) && !is_null($p = $params[$v])) {
                    $s = 'set' . CommonFunction::dashesToCamelCase($v);
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
            foreach (['user', 'description', 'type', 'status', 'expire_time'] as $v) {
                if (isset($params[$v]) && !is_null($p = $params[$v])) {
                    $s = 'set' . CommonFunction::dashesToCamelCase($v);
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
