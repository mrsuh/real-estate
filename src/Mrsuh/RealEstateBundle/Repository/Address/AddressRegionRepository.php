<?php

namespace Mrsuh\RealEstateBundle\Repository\Address;

use Doctrine\ORM\EntityRepository;
use Mrsuh\RealEstateBundle\Entity\Address\AddressRegion;


class AddressRegionRepository extends EntityRepository
{
    public function create($name)
    {
        $this->_em->beginTransaction();
        try {
            $obj = new AddressRegion();
            $obj->setName($name);

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
