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
  * @ORM\Entity(repositoryClass="Acme\Bundle\IOTBundle\Repository\PointRepository")
  * @ORM\Table(name="point")
  */
class Point
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
    private $value;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     */
    private $datetime;

    /**
     * @ORM\Column(type="datetime")
     * @Assert\DateTime()
     */
    private $createdAt;

    /**
    * @ORM\ManyToOne(targetEntity="Channel", inversedBy="points")
    * @ORM\JoinColumn(name="channel_id", referencedColumnName="id")
    */
    private $channel;
    
    public function __construct()
    {
        $this->createdAt = new \DateTime();
    }

    public function getId()
    {
        return $this->id;
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
     * Set value
     *
     * @param string $value
     * @return Point
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value
     *
     * @return string 
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set datetime
     *
     * @param string $datetime
     * @return Point
     */
    public function setDatetime($datetime)
    {
        $this->datetime = $datetime;

        return $this;
    }

    /**
     * Get datetime
     *
     * @return string 
     */
    public function getDatetime()
    {
        return $this->datetime;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Point
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
     * Set channel
     *
     * @param \Acme\Bundle\IOTBundle\Entity\Channel $channel
     * @return Point
     */
    public function setChannel(\Acme\Bundle\IOTBundle\Entity\Channel $channel = null)
    {
        $this->channel = $channel;

        return $this;
    }

    /**
     * Get channel
     *
     * @return \Acme\Bundle\IOTBundle\Entity\Channel 
     */
    public function getChannel()
    {
        return $this->channel;
    }
}
