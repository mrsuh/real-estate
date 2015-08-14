<?php

namespace Mrsuh\RealEstateBundle\Entity\Advert;

use Doctrine\ORM\Mapping as ORM;
use Mrsuh\RealEstateBundle\Service\CommonFunction;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * AdvertImage
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Mrsuh\RealEstateBundle\Repository\Advert\AdvertImageRepository")
 * @ORM\HasLifecycleCallbacks
 */
class AdvertImage
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
     * @ORM\Column(name="type", type="string", length=255)
     */
    public $type;

    /**
     *
     * @ORM\ManyToOne(targetEntity="Mrsuh\RealEstateBundle\Entity\Advert\Advert")
     * @ORM\JoinColumn(name="advert", referencedColumnName="id")
     */
    private $advert;

    /**
     * @Assert\File(maxSize="2m")
     * @Assert\Valid
     */
    private $file;


    public function getAbsolutePath()
    {
        return null === $this->type
            ? null
            : $this->getUploadRootDir().'/'. $this->id  . '.' . $this->type;
    }

    public function getMiniAbsolutePath()
    {
        return null === $this->type
            ? null
            : $this->getUploadRootDir().'/'. $this->id  . 'mini.' . $this->type;
    }

    public function getWebPath()
    {
        return null === $this->type
            ? null
            : $this->getUploadDir().'/'. $this->id  . '.' . $this->type;
    }

    public function getMiniWebPath()
    {
        return null === $this->type
            ? null
            : $this->getUploadDir().'/'. $this->id  . 'mini.' . $this->type;
    }

    protected function getUploadRootDir()
    {
        return __DIR__.'/../../../../../web/' . $this->getUploadDir();
    }

    protected function getUploadDir()
    {
        return 'uploads/documents';
    }

    private $temp;
    private $tempMini;

    public function getFile()
    {
        return $this->file;
    }

    /**
     * Sets file.
     *
     * @param UploadedFile $file
     */
    public function setFile(UploadedFile $file = null)
    {
        $this->file = $file;
        // check if we have an old image path
        if (is_file($this->getAbsolutePath())) {
            // store the old name to delete after the update
            $this->temp = $this->getAbsolutePath();
        } else {
            $this->type = 'initial';
        }

        return $this;
    }

    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function preUpload()
    {
        if (null !== $this->getFile()) {
            $this->type = $this->getFile()->guessExtension();
        }
    }

    /**
     * @ORM\PostPersist()
     * @ORM\PostUpdate()
     */
    public function upload()
    {
        if (null === $this->getFile()) {
            return;
        }

        // check if we have an old image
        if (isset($this->temp)) {
            // delete the old image
            unlink($this->temp);
            // clear the temp image path
            $this->temp = null;
        }

        // you must throw an exception here if the file cannot be moved
        // so that the entity is not persisted to the database
        // which the UploadedFile move() method does
        $this->getFile()->move(
            $this->getUploadRootDir(),
            $this->id.'.'.$this->getFile()->guessExtension()
        );

        CommonFunction::imageCrop($this->getUploadRootDir().'/'. $this->id  . '.' . $this->type, $this->getUploadRootDir().'/'. $this->id  . 'mini.' . $this->type, 150, 50);

        $this->setFile(null);
    }

    /**
     * @ORM\PreRemove()
     */
    public function storeFilenameForRemove()
    {
        $this->temp = $this->getAbsolutePath();
        $this->tempMini = $this->getMiniAbsolutePath();
    }

    /**
     * @ORM\PostRemove()
     */
    public function removeUpload()
    {
        if (isset($this->temp) && file_exists($this->temp)) {
            unlink($this->temp);
        }

        if (isset($this->tempMini) && file_exists($this->tempMini)) {
            unlink($this->tempMini);
        }
    }

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
     * @return mixed
     */
    public function getAdvert()
    {
        return $this->advert;
    }

    /**
     * @param mixed $advert
     */
    public function setAdvert($advert)
    {
        $this->advert = $advert;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }
}
