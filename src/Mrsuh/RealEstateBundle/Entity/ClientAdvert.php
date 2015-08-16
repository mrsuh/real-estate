<?php

namespace Mrsuh\RealEstateBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ClientAdvert
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Mrsuh\RealEstateBundle\Repository\ClientAdvertRepository")
 */
class ClientAdvert
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\ManyToOne(targetEntity="Mrsuh\RealEstateBundle\Entity\Client")
     * @ORM\JoinColumn(name="client", referencedColumnName="id")
     */
    private $client;

    /**
     * @var integer
     *
     * @ORM\ManyToOne(targetEntity="Mrsuh\RealEstateBundle\Entity\Advert\Advert")
     * @ORM\JoinColumn(name="advert", referencedColumnName="id")
     */
    private $advert;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    public function setClient($client)
    {
        $this->client = $client;

        return $this;
    }


    public function getClient()
    {
        return $this->client;
    }

    /**
     * @return int
     */
    public function getAdvert()
    {
        return $this->advert;
    }

    /**
     * @param int $advert
     */
    public function setAdvert($advert)
    {
        $this->advert = $advert;

        return $this;
    }
}
