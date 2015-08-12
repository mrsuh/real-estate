<?php

namespace Mrsuh\RealEstateBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Mrsuh\RealEstateBundle\Entity\ClientRegionCity;

class ClientRegionCityRepository extends EntityRepository
{
    public function create($client, $regionCity)
    {
        $this->_em->beginTransaction();
        try {
            $obj = new ClientRegionCity();
            $obj->setClient($client)
                ->setRegionCity($regionCity);

            $this->_em->persist($obj);

            $this->_em->commit();
        } catch (\Exception $e) {
            $this->_em->rollback();
            throw $e;
        }

        return $obj;
    }

    public function delete($user)
    {
        $this->_em->remove($user);
    }
}
