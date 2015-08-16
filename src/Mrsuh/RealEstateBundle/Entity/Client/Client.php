<?php

namespace Mrsuh\RealEstateBundle\Entity\Client;

use Doctrine\ORM\Mapping as ORM;

/**
 * Client
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Mrsuh\RealEstateBundle\Repository\Client\ClientRepository")
 */
class Client
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
     * @var string
     *
     * @ORM\Column(name="name1", type="string", length=255, nullable=true)
     */
    private $name1;

    /**
     * @var string
     *
     * @ORM\Column(name="name2", type="string", length=255, nullable=true)
     */
    private $name2;

    /**
     * @var string
     *
     * @ORM\Column(name="name3", type="string", length=255, nullable=true)
     */
    private $name3;

    /**
     * @var string
     *
     * @ORM\Column(name="phone1", type="string", length=255, nullable=true)
     */
    private $phone1;

    /**
     * @var string
     *
     * @ORM\Column(name="phone2", type="string", length=255, nullable=true)
     */
    private $phone2;

    /**
     * @var string
     *
     * @ORM\Column(name="phone3", type="string", length=255, nullable=true)
     */
    private $phone3;

    /**
     * @ORM\ManyToOne(targetEntity="Mrsuh\RealEstateBundle\Entity\Address\AddressCity")
     * @ORM\JoinColumn(name="city", referencedColumnName="id")
     */
    private $city;

    /**
     * @ORM\ManyToOne(targetEntity="Mrsuh\RealEstateBundle\Entity\Object\ObjectType")
     * @ORM\JoinColumn(name="type", referencedColumnName="id")
     */
    private $objectType;

    /**
     * @var integer
     *
     * @ORM\Column(name="priceFrom", type="integer", nullable=true)
     */
    private $priceFrom;

    /**
     * @var integer
     *
     * @ORM\Column(name="priceTo", type="integer", nullable=true)
     */
    private $priceTo;

    /**
     * @var integer
     *
     * @ORM\Column(name="roomFrom", type="integer", nullable=true)
     */
    private $roomFrom;

    /**
     * @var integer
     *
     * @ORM\Column(name="roomTo", type="integer", nullable=true)
     */
    private $roomTo;

    /**
     * @var integer
     *
     * @ORM\Column(name="commonAreaFrom", type="integer", nullable=true)
     */
    private $commonAreaFrom;

    /**
     * @var integer
     *
     * @ORM\Column(name="commonAreaTo", type="integer", nullable=true)
     */
    private $commonAreaTo;

    /**
     * @var integer
     *
     * @ORM\Column(name="liveAreaFrom", type="integer", nullable=true)
     */
    private $liveAreaFrom;

    /**
     * @var integer
     *
     * @ORM\Column(name="liveAreaTo", type="integer", nullable=true)
     */
    private $liveAreaTo;

    /**
     * @var integer
     *
     * @ORM\Column(name="kitchenAreaFrom", type="integer", nullable=true)
     */
    private $kitchenAreaFrom;

    /**
     * @var integer
     *
     * @ORM\Column(name="kitchenAreaTo", type="integer", nullable=true)
     */
    private $kitchenAreaTo;

    /**
     * @var integer
     *
     * @ORM\Column(name="sectionAreaFrom", type="integer", nullable=true)
     */
    private $sectionAreaFrom;

    /**
     * @var integer
     *
     * @ORM\Column(name="sectionAreaTo", type="integer", nullable=true)
     */
    private $sectionAreaTo;

    /**
     * @var integer
     *
     * @ORM\Column(name="floorFrom", type="integer", nullable=true)
     */
    private $floorFrom;

    /**
     * @var integer
     *
     * @ORM\Column(name="floorTo", type="integer", nullable=true)
     */
    private $floorTo;

    /**
     * @var integer
     *
     * @ORM\Column(name="floorsFrom", type="integer", nullable=true)
     */
    private $floorsFrom;

    /**
     * @var integer
     *
     * @ORM\Column(name="floorsTo", type="integer", nullable=true)
     */
    private $floorsTo;

    /**
     * @ORM\ManyToOne(targetEntity="\Mrsuh\RealEstateBundle\Entity\User")
     * @ORM\JoinColumn(name="user", referencedColumnName="id")
     */
    private $user;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="birthDay", type="date", nullable=true)
     */
    private $birthDay;

    /**
     * @var integer
     *
     * @ORM\Column(name="status", type="integer", nullable=true)
     */
    private $status;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="createTime", type="datetime", nullable=true)
     */
    private $createTime;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updateTime", type="datetime", nullable=true)
     */
    private $updateTime;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="processingTime", type="datetime", nullable=true)
     */
    private $processingTime;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="showTime", type="datetime", nullable=true)
     */
    private $showTime;

    /**
     * @var string
     *
     * @ORM\Column(name="comment", type="text", nullable=true)
     */
    private $comment;

    /**
     * @var boolean
     *
     * @ORM\Column(name="mortgage", type="boolean")
     */
    private $mortgage = false;

    /**
     * @var boolean
     *
     * @ORM\Column(name="hot", type="boolean")
     */
    private $hot = false;


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
     * Set name1
     *
     * @param string $name1
     * @return Client
     */
    public function setName1($name1)
    {
        $this->name1 = $name1;

        return $this;
    }

    /**
     * Get name1
     *
     * @return string 
     */
    public function getName1()
    {
        return $this->name1;
    }

    /**
     * Set name2
     *
     * @param string $name2
     * @return Client
     */
    public function setName2($name2)
    {
        $this->name2 = $name2;

        return $this;
    }

    /**
     * Get name2
     *
     * @return string 
     */
    public function getName2()
    {
        return $this->name2;
    }

    /**
     * Set name3
     *
     * @param string $name3
     * @return Client
     */
    public function setName3($name3)
    {
        $this->name3 = $name3;

        return $this;
    }

    /**
     * Get name3
     *
     * @return string 
     */
    public function getName3()
    {
        return $this->name3;
    }

    /**
     * Set phone1
     *
     * @param string $phone1
     * @return Client
     */
    public function setPhone1($phone1)
    {
        $this->phone1 = $phone1;

        return $this;
    }

    /**
     * Get phone1
     *
     * @return string 
     */
    public function getPhone1()
    {
        return $this->phone1;
    }

    /**
     * Set phone2
     *
     * @param string $phone2
     * @return Client
     */
    public function setPhone2($phone2)
    {
        $this->phone2 = $phone2;

        return $this;
    }

    /**
     * Get phone2
     *
     * @return string 
     */
    public function getPhone2()
    {
        return $this->phone2;
    }

    /**
     * Set phone3
     *
     * @param string $phone3
     * @return Client
     */
    public function setPhone3($phone3)
    {
        $this->phone3 = $phone3;

        return $this;
    }

    /**
     * Get phone3
     *
     * @return string 
     */
    public function getPhone3()
    {
        return $this->phone3;
    }

    /**
     * Set city
     *
     * @param integer $city
     * @return Client
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
     * Set objectType
     *
     * @param integer $objectType
     * @return Client
     */
    public function setObjectType($objectType)
    {
        $this->objectType = $objectType;

        return $this;
    }

    /**
     * Get objectType
     *
     * @return integer 
     */
    public function getObjectType()
    {
        return $this->objectType;
    }

    /**
     * Set priceFrom
     *
     * @param integer $priceFrom
     * @return Client
     */
    public function setPriceFrom($priceFrom)
    {
        $this->priceFrom = $priceFrom;

        return $this;
    }

    /**
     * Get priceFrom
     *
     * @return integer 
     */
    public function getPriceFrom()
    {
        return $this->priceFrom;
    }

    /**
     * Set priceTo
     *
     * @param integer $priceTo
     * @return Client
     */
    public function setPriceTo($priceTo)
    {
        $this->priceTo = $priceTo;

        return $this;
    }

    /**
     * Get priceTo
     *
     * @return integer 
     */
    public function getPriceTo()
    {
        return $this->priceTo;
    }

    /**
     * Set roomFrom
     *
     * @param integer $roomFrom
     * @return Client
     */
    public function setRoomFrom($roomFrom)
    {
        $this->roomFrom = $roomFrom;

        return $this;
    }

    /**
     * Get roomFrom
     *
     * @return integer 
     */
    public function getRoomFrom()
    {
        return $this->roomFrom;
    }

    /**
     * Set roomTo
     *
     * @param integer $roomTo
     * @return Client
     */
    public function setRoomTo($roomTo)
    {
        $this->roomTo = $roomTo;

        return $this;
    }

    /**
     * Get roomTo
     *
     * @return integer 
     */
    public function getRoomTo()
    {
        return $this->roomTo;
    }

    /**
     * Set commonAreaFrom
     *
     * @param integer $commonAreaFrom
     * @return Client
     */
    public function setCommonAreaFrom($commonAreaFrom)
    {
        $this->commonAreaFrom = $commonAreaFrom;

        return $this;
    }

    /**
     * Get commonAreaFrom
     *
     * @return integer 
     */
    public function getCommonAreaFrom()
    {
        return $this->commonAreaFrom;
    }

    /**
     * Set commonAreaTo
     *
     * @param integer $commonAreaTo
     * @return Client
     */
    public function setCommonAreaTo($commonAreaTo)
    {
        $this->commonAreaTo = $commonAreaTo;

        return $this;
    }

    /**
     * Get commonAreaTo
     *
     * @return integer 
     */
    public function getCommonAreaTo()
    {
        return $this->commonAreaTo;
    }

    /**
     * Set liveAreaFrom
     *
     * @param integer $liveAreaFrom
     * @return Client
     */
    public function setLiveAreaFrom($liveAreaFrom)
    {
        $this->liveAreaFrom = $liveAreaFrom;

        return $this;
    }

    /**
     * Get liveAreaFrom
     *
     * @return integer 
     */
    public function getLiveAreaFrom()
    {
        return $this->liveAreaFrom;
    }

    /**
     * Set liveAreaTo
     *
     * @param integer $liveAreaTo
     * @return Client
     */
    public function setLiveAreaTo($liveAreaTo)
    {
        $this->liveAreaTo = $liveAreaTo;

        return $this;
    }

    /**
     * Get liveAreaTo
     *
     * @return integer 
     */
    public function getLiveAreaTo()
    {
        return $this->liveAreaTo;
    }

    /**
     * Set kitchenAreaFrom
     *
     * @param integer $kitchenAreaFrom
     * @return Client
     */
    public function setKitchenAreaFrom($kitchenAreaFrom)
    {
        $this->kitchenAreaFrom = $kitchenAreaFrom;

        return $this;
    }

    /**
     * Get kitchenAreaFrom
     *
     * @return integer 
     */
    public function getKitchenAreaFrom()
    {
        return $this->kitchenAreaFrom;
    }

    /**
     * Set kitchenAreaTo
     *
     * @param integer $kitchenAreaTo
     * @return Client
     */
    public function setKitchenAreaTo($kitchenAreaTo)
    {
        $this->kitchenAreaTo = $kitchenAreaTo;

        return $this;
    }

    /**
     * Get kitchenAreaTo
     *
     * @return integer 
     */
    public function getKitchenAreaTo()
    {
        return $this->kitchenAreaTo;
    }

    /**
     * Set sectionAreaFrom
     *
     * @param integer $sectionAreaFrom
     * @return Client
     */
    public function setSectionAreaFrom($sectionAreaFrom)
    {
        $this->sectionAreaFrom = $sectionAreaFrom;

        return $this;
    }

    /**
     * Get sectionAreaFrom
     *
     * @return integer 
     */
    public function getSectionAreaFrom()
    {
        return $this->sectionAreaFrom;
    }

    /**
     * Set sectionAreaTo
     *
     * @param integer $sectionAreaTo
     * @return Client
     */
    public function setSectionAreaTo($sectionAreaTo)
    {
        $this->sectionAreaTo = $sectionAreaTo;

        return $this;
    }

    /**
     * Get sectionAreaTo
     *
     * @return integer 
     */
    public function getSectionAreaTo()
    {
        return $this->sectionAreaTo;
    }

    /**
     * Set floorFrom
     *
     * @param integer $floorFrom
     * @return Client
     */
    public function setFloorFrom($floorFrom)
    {
        $this->floorFrom = $floorFrom;

        return $this;
    }

    /**
     * Get floorFrom
     *
     * @return integer 
     */
    public function getFloorFrom()
    {
        return $this->floorFrom;
    }

    /**
     * Set floorTo
     *
     * @param integer $floorTo
     * @return Client
     */
    public function setFloorTo($floorTo)
    {
        $this->floorTo = $floorTo;

        return $this;
    }

    /**
     * Get floorTo
     *
     * @return integer 
     */
    public function getFloorTo()
    {
        return $this->floorTo;
    }

    /**
     * Set floorsFrom
     *
     * @param integer $floorsFrom
     * @return Client
     */
    public function setFloorsFrom($floorsFrom)
    {
        $this->floorsFrom = $floorsFrom;

        return $this;
    }

    /**
     * Get floorsFrom
     *
     * @return integer 
     */
    public function getFloorsFrom()
    {
        return $this->floorsFrom;
    }

    /**
     * Set floorsTo
     *
     * @param integer $floorsTo
     * @return Client
     */
    public function setFloorsTo($floorsTo)
    {
        $this->floorsTo = $floorsTo;

        return $this;
    }

    /**
     * Get floorsTo
     *
     * @return integer 
     */
    public function getFloorsTo()
    {
        return $this->floorsTo;
    }

    /**
     * Set user
     *
     * @param integer $user
     * @return Client
     */
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return integer 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set birthDay
     *
     * @param \DateTime $birthDay
     * @return Client
     */
    public function setBirthDay($birthDay)
    {
        $this->birthDay = $birthDay;

        return $this;
    }

    /**
     * Get birthDay
     *
     * @return \DateTime 
     */
    public function getBirthDay()
    {
        return $this->birthDay;
    }

    /**
     * Set status
     *
     * @param integer $status
     * @return Client
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
     * Set createTime
     *
     * @param \DateTime $createTime
     * @return Client
     */
    public function setCreateTime($createTime)
    {
        $this->createTime = $createTime;

        return $this;
    }

    /**
     * Get createTime
     *
     * @return \DateTime 
     */
    public function getCreateTime()
    {
        return $this->createTime;
    }

    /**
     * Set processingTime
     *
     * @param \DateTime $processingTime
     * @return Client
     */
    public function setProcessingTime($processingTime)
    {
        $this->processingTime = $processingTime;

        return $this;
    }

    /**
     * Get processingTime
     *
     * @return \DateTime 
     */
    public function getProcessingTime()
    {
        return $this->processingTime;
    }

    /**
     * Set showTime
     *
     * @param \DateTime $showTime
     * @return Client
     */
    public function setShowTime($showTime)
    {
        $this->showTime = $showTime;

        return $this;
    }

    /**
     * Get showTime
     *
     * @return \DateTime 
     */
    public function getShowTime()
    {
        return $this->showTime;
    }

    /**
     * Set comment
     *
     * @param string $comment
     * @return Client
     */
    public function setComment($comment)
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * Get comment
     *
     * @return string 
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * Set mortgage
     *
     * @param boolean $mortgage
     * @return Client
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
     * Set hot
     *
     * @param boolean $hot
     * @return Client
     */
    public function setHot($hot)
    {
        $this->hot = $hot;

        return $this;
    }

    /**
     * Get hot
     *
     * @return boolean 
     */
    public function getHot()
    {
        return $this->hot;
    }

    /**
     * @return \DateTime
     */
    public function getUpdateTime()
    {
        return $this->updateTime;
    }

    /**
     * @param \DateTime $updateTime
     */
    public function setUpdateTime($updateTime)
    {
        $this->updateTime = $updateTime;
    }
}
