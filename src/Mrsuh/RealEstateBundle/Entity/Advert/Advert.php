<?php

namespace Mrsuh\RealEstateBundle\Entity\Advert;

use Doctrine\ORM\Mapping as ORM;

/**
 * Advert
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Mrsuh\RealEstateBundle\Repository\Advert\AdvertRepository")
 */
class Advert
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
     * @ORM\ManyToOne(targetEntity="\Mrsuh\RealEstateBundle\Entity\User")
     * @ORM\JoinColumn(name="user", referencedColumnName="id")
     */
    private $user;

    /**
     * @var string
     *
     * @ORM\Column(name="seller_name1", type="string", length=255, nullable=true)
     */
    private $sellerName1;

    /**
     * @var string
     *
     * @ORM\Column(name="seller_name2", type="string", length=255, nullable=true)
     */
    private $sellerName2;

    /**
     * @var string
     *
     * @ORM\Column(name="seller_name3", type="string", length=255, nullable=true)
     */
    private $sellerName3;

    /**
     * @var string
     *
     * @ORM\Column(name="seller_phone1", type="string", length=255, nullable=true)
     */
    private $sellerPhone1;

    /**
     * @var string
     *
     * @ORM\Column(name="seller_phone2", type="string", length=255, nullable=true)
     */
    private $sellerPhone2;

    /**
     * @var string
     *
     * @ORM\Column(name="seller_phone3", type="string", length=255, nullable=true)
     */
    private $sellerPhone3;

    /**
     * @var string
     *
     * @ORM\OneToOne(targetEntity="Mrsuh\RealEstateBundle\Entity\Advert\AdvertDescription")
     */
    private $description;

    /**
     *
     * @ORM\ManyToOne(targetEntity="Mrsuh\RealEstateBundle\Entity\Advert\AdvertType")
     * @ORM\JoinColumn(name="type", referencedColumnName="id")
     */
    private $type;

    /**
     * @var integer
     *
     * @ORM\Column(name="status", type="integer")
     */
    private $status;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="createTime", type="datetime")
     */
    private $createTime;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updateTime", type="datetime")
     */
    private $updateTime;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="expireTime", type="datetime")
     */
    private $expireTime;

    /**
     * @var boolean
     *
     * @ORM\Column(name="exclusive", type="boolean")
     */
    private $exclusive;

    /**
     * @var integer
     *
     * @ORM\OneToOne(targetEntity="Mrsuh\RealEstateBundle\Entity\Object\Object")
     */
    private $object;

    /**
     * @var string
     *
     * @ORM\Column(name="price", type="integer", nullable=true)
     */
    private $price;

    /**
     * @ORM\ManyToOne(targetEntity="Mrsuh\RealEstateBundle\Entity\Advert\AdvertCategory")
     * @ORM\JoinColumn(name="category", referencedColumnName="id")
     */
    private $category;

    /**
     * @var string
     *
     * @ORM\Column(name="meterPrice", type="string", length=255, nullable=true)
     */
    private $meterPrice;


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
     * Set user
     *
     * @param integer $user
     * @return Advert
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
     * Set description
     *
     * @param string $description
     * @return Advert
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set type
     *
     * @param integer $type
     * @return Advert
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
     * Set status
     *
     * @param integer $status
     * @return Advert
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
     * @return Advert
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
     * Set updateTime
     *
     * @param \DateTime $updateTime
     * @return Advert
     */
    public function setUpdateTime($updateTime)
    {
        $this->updateTime = $updateTime;

        return $this;
    }

    /**
     * Get updateTime
     *
     * @return \DateTime 
     */
    public function getUpdateTime()
    {
        return $this->updateTime;
    }

    /**
     * Set expireTime
     *
     * @param \DateTime $expireTime
     * @return Advert
     */
    public function setExpireTime($expireTime)
    {
        $this->expireTime = $expireTime;

        return $this;
    }

    /**
     * Get expireTime
     *
     * @return \DateTime 
     */
    public function getExpireTime()
    {
        return $this->expireTime;
    }

    /**
     * Set exclusive
     *
     * @param boolean $exclusive
     * @return Advert
     */
    public function setExclusive($exclusive)
    {
        $this->exclusive = $exclusive;

        return $this;
    }

    /**
     * Get exclusive
     *
     * @return boolean 
     */
    public function getExclusive()
    {
        return $this->exclusive;
    }

    /**
     * Set object
     *
     * @param integer $object
     * @return Advert
     */
    public function setObject($object)
    {
        $this->object = $object;

        return $this;
    }

    /**
     * Get object
     *
     * @return integer 
     */
    public function getObject()
    {
        return $this->object;
    }

    /**
     * @return mixed
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param mixed $category
     */
    public function setCategory($category)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * @return string
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param string $price
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * @return string
     */
    public function getSellerName1()
    {
        return $this->sellerName1;
    }

    /**
     * @param string $sellerName1
     */
    public function setSellerName1($sellerName1)
    {
        $this->sellerName1 = $sellerName1;

        return $this;
    }

    /**
     * @return string
     */
    public function getSellerName2()
    {
        return $this->sellerName2;
    }

    /**
     * @param string $sellerName2
     */
    public function setSellerName2($sellerName2)
    {
        $this->sellerName2 = $sellerName2;

        return $this;
    }

    /**
     * @return string
     */
    public function getSellerName3()
    {
        return $this->sellerName3;
    }

    /**
     * @param string $sellerName3
     */
    public function setSellerName3($sellerName3)
    {
        $this->sellerName3 = $sellerName3;

        return $this;
    }

    /**
     * @return string
     */
    public function getSellerPhone1()
    {
        return $this->sellerPhone1;
    }

    /**
     * @param string $sellerPhone1
     */
    public function setSellerPhone1($sellerPhone1)
    {
        $this->sellerPhone1 = $sellerPhone1;

        return $this;
    }

    /**
     * @return string
     */
    public function getSellerPhone2()
    {
        return $this->sellerPhone2;
    }

    /**
     * @param string $sellerPhone2
     */
    public function setSellerPhone2($sellerPhone2)
    {
        $this->sellerPhone2 = $sellerPhone2;

        return $this;
    }

    /**
     * @return string
     */
    public function getSellerPhone3()
    {
        return $this->sellerPhone3;
    }

    /**
     * @param string $sellerPhone3
     */
    public function setSellerPhone3($sellerPhone3)
    {
        $this->sellerPhone3 = $sellerPhone3;

        return $this;
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
}

