<?php

namespace Mrsuh\RealEstateBundle\Repository\Client;

use Doctrine\ORM\EntityRepository;
use Mrsuh\RealEstateBundle\Entity\Client\ClientAdvert;

class ClientAdvertRepository extends EntityRepository
{
    public function create($client, $advert)
    {
        $this->_em->beginTransaction();
        try {
            $obj = new ClientAdvert();
            $obj->setClient($client)
                ->setAdvert($advert);

            $this->_em->persist($obj);

            $this->_em->commit();
        } catch (\Exception $e) {
            $this->_em->rollback();
            throw $e;
        }

        return $obj;
    }

    public function delete($obj)
    {
        $this->_em->remove($obj);
    }

}
