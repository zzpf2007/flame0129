<?php

namespace Acme\Bundle\IOTBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 *
 * Defines the properties of the Device entity to represent the iot devices.
 *
 * @author Kevin Zhou <kevin.zhou@hotmail.co.uk>
 */

/**
  * @ORM\Entity(repositoryClass="Acme\Bundle\IOTBundle\Repository\DeviceRepository")
  * @ORM\Table(name="device")
  */
class Device
{
    /**
     * Use constants to define configuration options that rarely change instead
     * of specifying them in app/config/config.yml.
     * See http://symfony.com/doc/current/best_practices/configuration.html#constants-vs-configuration-options
     */
    const NUM_ITEMS = 10;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     */
    private $iotname;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     */
    private $iotid;

    /**
     * @ORM\Column(type="string")
     */
    private $slug;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $iotdescription;

    /**
     * @ORM\Column(type="string", nullable=true)
     * @Assert\Email()
     */
    private $authorEmail;

    /**
     * @ORM\Column(type="boolean")
     * @Assert\Email()
     */
    private $online;

    /**
     * @ORM\Column(type="datetime")
     * @Assert\DateTime()
     */
    private $createdAt;

    /**
     * @ORM\OneToMany(
     *      targetEntity="Channel",
     *      mappedBy="device",
     *      orphanRemoval=true
     * )
     * @ORM\OrderBy({"createdAt" = "DESC"})
     */
    private $channels;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
        $this->online = false;
        $this->channels = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getSlug()
    {
        return $this->slug;
    }

    public function setSlug($slug)
    {
        $this->slug = $slug;
    }

    public function getAuthorEmail()
    {
        return $this->authorEmail;
    }

    public function setAuthorEmail($authorEmail)
    {
        $this->authorEmail = $authorEmail;
    }

    /**
     * Is the given User the author of this Post?
     *
     * @param User $user
     *
     * @return bool
     */
    public function isAuthor(User $user)
    {
        return $user->getEmail() == $this->getAuthorEmail();
    }

    /**
     * Set iotname
     *
     * @param string $iotname
     * @return Device
     */
    public function setIotname($iotname)
    {
        $this->iotname = $iotname;

        return $this;
    }

    /**
     * Get iotname
     *
     * @return string 
     */
    public function getIotname()
    {
        return $this->iotname;
    }

    /**
     * Set iotid
     *
     * @param string $iotid
     * @return Device
     */
    public function setIotid($iotid)
    {
        $this->iotid = $iotid;

        return $this;
    }

    /**
     * Get iotid
     *
     * @return string 
     */
    public function getIotid()
    {
        return $this->iotid;
    }

    /**
     * Set iotdescription
     *
     * @param string $iotdescription
     * @return Device
     */
    public function setIotdescription($iotdescription)
    {
        $this->iotdescription = $iotdescription;

        return $this;
    }

    /**
     * Get iotdescription
     *
     * @return string 
     */
    public function getIotdescription()
    {
        return $this->iotdescription;
    }

    /**
     * Set online
     *
     * @param boolean $online
     * @return Device
     */
    public function setOnline($online)
    {
        $this->online = $online;

        return $this;
    }

    /**
     * Get online
     *
     * @return boolean 
     */
    public function getOnline()
    {
        return $this->online;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Device
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Add channels
     *
     * @param \Acme\Bundle\IOTBundle\Entity\Channel $channels
     * @return Device
     */
    public function addChannel(\Acme\Bundle\IOTBundle\Entity\Channel $channels)
    {
        $this->channels[] = $channels;

        return $this;
    }

    /**
     * Remove channels
     *
     * @param \Acme\Bundle\IOTBundle\Entity\Channel $channels
     */
    public function removeChannel(\Acme\Bundle\IOTBundle\Entity\Channel $channels)
    {
        $this->channels->removeElement($channels);
    }

    /**
     * Get channels
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getChannels()
    {
        return $this->channels;
    }
}
