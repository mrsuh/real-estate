<?php

namespace Mrsuh\RealEstateBundle\Repository\Address;

use Doctrine\ORM\EntityRepository;
use Mrsuh\RealEstateBundle\Entity\Address\AddressRegionCity;


class AddressRegionCityRepository extends EntityRepository
{
    public function create($city, $name)
    {
        $this->_em->beginTransaction();
        try {
            $obj = new AddressRegionCity();
            $obj->setName($name)
                ->setCity($city);

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
