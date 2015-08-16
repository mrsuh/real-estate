<?php

namespace Mrsuh\RealEstateBundle\Entity\Client;

use Doctrine\ORM\Mapping as ORM;

/**
 * ClientRegionCity
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Mrsuh\RealEstateBundle\Repository\Client\ClientRegionCityRepository")
 */
class ClientRegionCity
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
     * @ORM\ManyToOne(targetEntity="\Mrsuh\RealEstateBundle\Entity\Client\Client")
     * @ORM\JoinColumn(name="client", referencedColumnName="id")
     */
    private $client;

    /**
     * @var integer
     *
     * @ORM\ManyToOne(targetEntity="\Mrsuh\RealEstateBundle\Entity\Address\AddressRegionCity")
     * @ORM\JoinColumn(name="region_city", referencedColumnName="id")
     */
    private $regionCity;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set client
     *
     * @param integer $client
     * @return ClientRegionCity
     */
    public function setClient($client)
    {
        $this->client = $client;

        return $this;
    }

    /**
     * Get client
     *
     * @return integer
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * Set regionCity
     *
     * @param integer $regionCity
     * @return ClientRegionCity
     */
    public function setRegionCity($regionCity)
    {
        $this->regionCity = $regionCity;

        return $this;
    }

    /**
     * Get regionCity
     *
     * @return integer
     */
    public function getRegionCity()
    {
        return $this->regionCity;
    }
}
