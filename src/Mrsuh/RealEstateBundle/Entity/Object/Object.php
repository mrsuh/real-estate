<?php

namespace Mrsuh\RealEstateBundle\Entity\Object;

use Doctrine\ORM\Mapping as ORM;

/**
 * Object
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Mrsuh\RealEstateBundle\Repository\Object\ObjectRepository")
 */
class Object
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
     * @ORM\Column(name="status", type="integer")
     */
    private $status;

    /**
     * @var integer
     *
     * @ORM\ManyToOne(targetEntity="Mrsuh\RealEstateBundle\Entity\Object\Type")
     * @ORM\JoinColumn(name="region", referencedColumnName="id")
     */
    private $type;

    /**
     * @var integer
     *
     * @ORM\ManyToOne(targetEntity="Mrsuh\RealEstateBundle\Entity\Object\State")
     * @ORM\JoinColumn(name="region", referencedColumnName="id")
     */
    private $state;

    /**
     * @var integer
     *
     * @ORM\ManyToOne(targetEntity="Mrsuh\RealEstateBundle\Entity\Object\Wall")
     * @ORM\JoinColumn(name="region", referencedColumnName="id")
     */
    private $wall;

    /**
     * @var string
     *
     * @ORM\Column(name="meterPrice", type="string", length=255, nullable=true)
     */
    private $meterPrice;

    /**
     * @var integer
     *
     * @ORM\Column(name="roomNumber", type="integer", nullable=true)
     */
    private $roomNumber;

    /**
     * @var string
     *
     * @ORM\Column(name="commonArea", type="string", length=255, nullable=true)
     */
    private $commonArea;

    /**
     * @var string
     *
     * @ORM\Column(name="liveArea", type="string", length=255, nullable=true)
     */
    private $liveArea;

    /**
     * @var string
     *
     * @ORM\Column(name="kitchenArea", type="string", length=255, nullable=true)
     */
    private $kitchenArea;

    /**
     * @var string
     *
     * @ORM\Column(name="sectionArea", type="string", length=255, nullable=true)
     */
    private $sectionArea;

    /**
     * @var integer
     *
     * @ORM\Column(name="floor", type="integer", nullable=true)
     */
    private $floor;

    /**
     * @var integer
     *
     * @ORM\Column(name="floors", type="integer", nullable=true)
     */
    private $floors;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="buildYear", type="datetime", nullable=true)
     */
    private $buildYear;

    /**
     * @var integer
     *
     * @ORM\ManyToOne(targetEntity="Mrsuh\RealEstateBundle\Entity\Object\WaterSupply")
     * @ORM\JoinColumn(name="region", referencedColumnName="id")
     */
    private $waterSupply;

    /**
     *
     * @ORM\ManyToOne(targetEntity="Mrsuh\RealEstateBundle\Entity\Object\Heating")
     * @ORM\JoinColumn(name="region", referencedColumnName="id")
     */
    private $heating;

    /**
     * @var boolean
     *
     * @ORM\Column(name="newHouse", type="boolean")
     */
    private $newHouse;

    /**
     * @var boolean
     *
     * @ORM\Column(name="mortgage", type="boolean")
     */
    private $mortgage;

    /**
     * @var boolean
     *
     * @ORM\ManyToOne(targetEntity="Mrsuh\RealEstateBundle\Entity\Object\Balcony")
     * @ORM\JoinColumn(name="region", referencedColumnName="id")
     */
    private $balcony;

    /**
     * @var integer
     *
     * @ORM\ManyToOne(targetEntity="Mrsuh\RealEstateBundle\Entity\Object\Wc")
     * @ORM\JoinColumn(name="region", referencedColumnName="id")
     */
    private $wc;

    /**
     * @ORM\ManyToOne(targetEntity="Mrsuh\RealEstateBundle\Entity\Address\Region")
     * @ORM\JoinColumn(name="region", referencedColumnName="id")
     */
    private $region;

    /**
     * @ORM\ManyToOne(targetEntity="Mrsuh\RealEstateBundle\Entity\Address\City")
     * @ORM\JoinColumn(name="city", referencedColumnName="id")
     */
    private $city;

    /**
     * @ORM\ManyToOne(targetEntity="Mrsuh\RealEstateBundle\Entity\Address\RegionCity")
     * @ORM\JoinColumn(name="region_city", referencedColumnName="id")
     */
    private $regionCity;

    /**
     * @ORM\ManyToOne(targetEntity="Mrsuh\RealEstateBundle\Entity\Address\Street")
     * @ORM\JoinColumn(name="street", referencedColumnName="id")
     */
    private $street;

    /**
     * @var integer
     *
     * @ORM\Column(name="house", type="integer", nullable=true)
     */
    private $house;

    /**
     * @var integer
     *
     * @ORM\Column(name="flat", type="integer", nullable=true)
     */
    private $flat;

    /**
     * @var string
     *
     * @ORM\Column(name="landmark", type="string", length=255, nullable=true)
     */
    private $landmark;


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
     * Set status
     *
     * @param integer $status
     * @return Object
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return integer 
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set type
     *
     * @param integer $type
     * @return Object
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return integer 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set state
     *
     * @param integer $state
     * @return Object
     */
    public function setState($state)
    {
        $this->state = $state;

        return $this;
    }

    /**
     * Get state
     *
     * @return integer 
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Set wall
     *
     * @param integer $wall
     * @return Object
     */
    public function setWall($wall)
    {
        $this->wall = $wall;

        return $this;
    }

    /**
     * Get wall
     *
     * @return integer 
     */
    public function getWall()
    {
        return $this->wall;
    }

    /**
     * Set meterPrice
     *
     * @param string $meterPrice
     * @return Object
     */
    public function setMeterPrice($meterPrice)
    {
        $this->meterPrice = $meterPrice;

        return $this;
    }

    /**
     * Get meterPrice
     *
     * @return string 
     */
    public function getMeterPrice()
    {
        return $this->meterPrice;
    }

    /**
     * Set roomNumber
     *
     * @param integer $roomNumber
     * @return Object
     */
    public function setRoomNumber($roomNumber)
    {
        $this->roomNumber = $roomNumber;

        return $this;
    }

    /**
     * Get roomNumber
     *
     * @return integer 
     */
    public function getRoomNumber()
    {
        return $this->roomNumber;
    }

    /**
     * Set commonArea
     *
     * @param string $commonArea
     * @return Object
     */
    public function setCommonArea($commonArea)
    {
        $this->commonArea = $commonArea;

        return $this;
    }

    /**
     * Get commonArea
     *
     * @return string 
     */
    public function getCommonArea()
    {
        return $this->commonArea;
    }

    /**
     * Set liveArea
     *
     * @param string $liveArea
     * @return Object
     */
    public function setLiveArea($liveArea)
    {
        $this->liveArea = $liveArea;

        return $this;
    }

    /**
     * Get liveArea
     *
     * @return string 
     */
    public function getLiveArea()
    {
        return $this->liveArea;
    }

    /**
     * Set citchenArea
     *
     * @param string $citchenArea
     * @return Object
     */
    public function setCitchenArea($citchenArea)
    {
        $this->citchenArea = $citchenArea;

        return $this;
    }

    /**
     * Get citchenArea
     *
     * @return string 
     */
    public function getCitchenArea()
    {
        return $this->citchenArea;
    }

    /**
     * Set sectionArea
     *
     * @param string $sectionArea
     * @return Object
     */
    public function setSectionArea($sectionArea)
    {
        $this->sectionArea = $sectionArea;

        return $this;
    }

    /**
     * Get sectionArea
     *
     * @return string 
     */
    public function getSectionArea()
    {
        return $this->sectionArea;
    }

    /**
     * Set floor
     *
     * @param integer $floor
     * @return Object
     */
    public function setFloor($floor)
    {
        $this->floor = $floor;

        return $this;
    }

    /**
     * Get floor
     *
     * @return integer 
     */
    public function getFloor()
    {
        return $this->floor;
    }

    /**
     * Set floors
     *
     * @param integer $floors
     * @return Object
     */
    public function setFloors($floors)
    {
        $this->floors = $floors;

        return $this;
    }

    /**
     * Get floors
     *
     * @return integer 
     */
    public function getFloors()
    {
        return $this->floors;
    }

    /**
     * Set buildYear
     *
     * @param \DateTime $buildYear
     * @return Object
     */
    public function setBuildYear($buildYear)
    {
        $this->buildYear = $buildYear;

        return $this;
    }

    /**
     * Get buildYear
     *
     * @return \DateTime 
     */
    public function getBuildYear()
    {
        return $this->buildYear;
    }

    /**
     * Set waterSupply
     *
     * @param integer $waterSupply
     * @return Object
     */
    public function setWaterSupply($waterSupply)
    {
        $this->waterSupply = $waterSupply;

        return $this;
    }

    /**
     * Get waterSupply
     *
     * @return integer 
     */
    public function getWaterSupply()
    {
        return $this->waterSupply;
    }

    /**
     * Set heating
     *
     * @param integer $heating
     * @return Object
     */
    public function setHeating($heating)
    {
        $this->heating = $heating;

        return $this;
    }

    /**
     * Get heating
     *
     * @return integer 
     */
    public function getHeating()
    {
        return $this->heating;
    }

    /**
     * Set newHouse
     *
     * @param boolean $newHouse
     * @return Object
     */
    public function setNewHouse($newHouse)
    {
        $this->newHouse = $newHouse;

        return $this;
    }

    /**
     * Get newHouse
     *
     * @return boolean 
     */
    public function getNewHouse()
    {
        return $this->newHouse;
    }

    /**
     * Set mortgage
     *
     * @param boolean $mortgage
     * @return Object
     */
    public function setMortgage($mortgage)
    {
        $this->mortgage = $mortgage;

        return $this;
    }

    /**
     * Get mortgage
     *
     * @return boolean 
     */
    public function getMortgage()
    {
        return $this->mortgage;
    }

    /**
     * Set balcony
     *
     * @param boolean $balcony
     * @return Object
     */
    public function setBalcony($balcony)
    {
        $this->balcony = $balcony;

        return $this;
    }

    /**
     * Get balcony
     *
     * @return boolean 
     */
    public function getBalcony()
    {
        return $this->balcony;
    }

    /**
     * Set wc
     *
     * @param integer $wc
     * @return Object
     */
    public function setWc($wc)
    {
        $this->wc = $wc;

        return $this;
    }

    /**
     * Get wc
     *
     * @return integer 
     */
    public function getWc()
    {
        return $this->wc;
    }

    /**
     * Set region
     *
     * @param integer $region
     * @return Object
     */
    public function setRegion($region)
    {
        $this->region = $region;

        return $this;
    }

    /**
     * Get region
     *
     * @return integer 
     */
    public function getRegion()
    {
        return $this->region;
    }

    /**
     * Set city
     *
     * @param integer $city
     * @return Object
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return integer 
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set regionCity
     *
     * @param integer $regionCity
     * @return Object
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

    /**
     * Set street
     *
     * @param integer $street
     * @return Object
     */
    public function setStreet($street)
    {
        $this->street = $street;

        return $this;
    }

    /**
     * Get street
     *
     * @return integer 
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * Set house
     *
     * @param integer $house
     * @return Object
     */
    public function setHouse($house)
    {
        $this->house = $house;

        return $this;
    }

    /**
     * Get house
     *
     * @return integer 
     */
    public function getHouse()
    {
        return $this->house;
    }

    /**
     * Set flat
     *
     * @param integer $flat
     * @return Object
     */
    public function setFlat($flat)
    {
        $this->flat = $flat;

        return $this;
    }

    /**
     * Get flat
     *
     * @return integer 
     */
    public function getFlat()
    {
        return $this->flat;
    }

    /**
     * Set landmark
     *
     * @param string $landmark
     * @return Object
     */
    public function setLandmark($landmark)
    {
        $this->landmark = $landmark;

        return $this;
    }

    /**
     * Get landmark
     *
     * @return string 
     */
    public function getLandmark()
    {
        return $this->landmark;
    }

    /**
     * @return string
     */
    public function getKitchenArea()
    {
        return $this->kitchenArea;
    }

    /**
     * @param string $kitchenArea
     */
    public function setKitchenArea($kitchenArea)
    {
        $this->kitchenArea = $kitchenArea;

        return $this;
    }
}
