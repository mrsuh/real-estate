<?php

namespace Mrsuh\RealEstateBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Mrsuh\RealEstateBundle\C;
use Mrsuh\RealEstateBundle\Entity\Advert;


class AdvertRepository extends EntityRepository
{
    public function create($params)
    {
        $this->_em->beginTransaction();
        try {
            $time = new \DateTime();
            $advert = new Advert();
            $advert->setUser($params['user']);
            $advert->setDescription($params['description']);
            $advert->setComment($params['comment']);
            $advert->setType($params['type']);
            $advert->setStatus(C::STATUS_ADVERT_ACTIVE);
            $advert->setCreateTime($time);
            $advert->setUpdateTime($time);
            $advert->setExpireTime($params['expire_time']);

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
            $time = new \DateTime();

            $advert->setUser($params['user']);
            $advert->setDescription($params['description']);
            $advert->setComment($params['comment']);
            $advert->setType($params['type']);
            $advert->setStatus($params['status']);
            $advert->setUpdateTime($time);
            $advert->setExpireTime($params['expire_time']);

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
