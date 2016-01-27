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
  * @ORM\Entity(repositoryClass="Acme\Bundle\IOTBundle\Repository\ChannelRepository")
  * @ORM\Table(name="channel")
  */
class Channel
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
     * @ORM\Column(type="datetime")
     * @Assert\DateTime()
     */
    private $createdAt;

    /**
     * @ORM\OneToMany(
     *      targetEntity="Point",
     *      mappedBy="channel",
     *      orphanRemoval=true
     * )
     * @ORM\OrderBy({"createdAt" = "DESC"})
     */
    private $points;

    /**
    * @ORM\ManyToOne(targetEntity="Device", inversedBy="channels")
    * @ORM\JoinColumn(name="device_id", referencedColumnName="id")
    */
    private $device;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
        $this->points = new ArrayCollection();
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
        $device_slug = '';
        if ( $this->device ) {
            $device_slug = $this->device->getSlug();
        }
        $this->slug = $device_slug . '_' . $slug;
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
     * @return Channel
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
     * @return Channel
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
     * @return Channel
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
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Channel
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
     * Add points
     *
     * @param \Acme\Bundle\IOTBundle\Entity\Point $points
     * @return Channel
     */
    public function addPoint(\Acme\Bundle\IOTBundle\Entity\Point $points)
    {
        $this->points[] = $points;

        return $this;
    }

    /**
     * Remove points
     *
     * @param \Acme\Bundle\IOTBundle\Entity\Point $points
     */
    public function removePoint(\Acme\Bundle\IOTBundle\Entity\Point $points)
    {
        $this->points->removeElement($points);
    }

    /**
     * Get points
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPoints()
    {
        return $this->points;
    }

    /**
     * Set device
     *
     * @param \Acme\Bundle\IOTBundle\Entity\Device $device
     * @return Channel
     */
    public function setDevice(\Acme\Bundle\IOTBundle\Entity\Device $device = null)
    {
        $this->device = $device;

        return $this;
    }

    /**
     * Get device
     *
     * @return \Acme\Bundle\IOTBundle\Entity\Device 
     */
    public function getDevice()
    {
        return $this->device;
    }
}
