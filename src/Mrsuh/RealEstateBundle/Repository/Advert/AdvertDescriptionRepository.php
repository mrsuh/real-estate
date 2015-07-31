<?php

namespace Mrsuh\RealEstateBundle\Repository\Advert;

use Mrsuh\RealEstateBundle\Service\CommonFunction;
use Doctrine\ORM\EntityRepository;
use Mrsuh\RealEstateBundle\C;
use Mrsuh\RealEstateBundle\Entity\Advert\AdvertDescription;


class AdvertDescriptionRepository extends EntityRepository
{
    public function create($params)
    {
        $this->_em->beginTransaction();
        try {

            $obj = new AdvertDescription();

            $obj->setDescription($params['description'])
                ->setComment($params['comment']);

            $this->_em->persist($obj);

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

            $obj->setDescription($params['description'])
                ->setComment($params['comment']);

            $this->_em->persist($obj);

            $this->_em->flush();
            $this->_em->commit();
        } catch (\Exception $e) {
            $this->_em->rollback();
            throw $e;
        }

        return $obj;
    }
}
