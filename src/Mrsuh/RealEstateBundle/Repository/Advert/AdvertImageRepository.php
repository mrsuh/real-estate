<?php

namespace Mrsuh\RealEstateBundle\Repository\Advert;

use Doctrine\ORM\EntityRepository;
use Mrsuh\RealEstateBundle\Entity\Advert\AdvertImage;

class AdvertImageRepository extends EntityRepository
{
    public function create($advert, $file)
    {
        $this->_em->beginTransaction();
        try {
            $obj = new AdvertImage();
            $obj
                ->setAdvert($advert)
                ->setFile($file);

            $this->_em->persist($obj);
            $this->_em->commit();
        } catch (\Exception $e) {
            $this->_em->rollback();
            throw $e;
        }

        return $obj;
    }
}
