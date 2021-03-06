<?php

namespace Acme\Component\User\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Acme\Component\User\Model\UserInterface;
use Symfony\Component\Security\Core\User\UserInterface as BaseUserInterface;

class User implements UserInterface
{
    /**
     * @var mixed
     */
    protected $id;

    // /**
    //  * @var CustomerInterface
    //  */
    // protected $customer;

    /**
     * @var string
     */
    protected $username;

    // /**
    //  * Normalized representation of a username.
    //  *
    //  * @var string
    //  */
    // protected $usernameCanonical;

    // /**
    //  * @var boolean
    //  */
    // protected $enabled = false;

    // /**
    //  * Random data that is used as an additional input to a function that hashes a password.
    //  *
    //  * @var string
    //  */
    protected $salt;

    // /**
    //  * Encrypted password. Must be persisted.
    //  *
    //  * @var string
    //  */
    protected $password;

    // /**
    //  * Password before encryption. Used for model validation. Must not be persisted.
    //  *
    //  * @var string
    //  */
    protected $plainPassword;

    // /**
    //  * @var \DateTime
    //  */
    // protected $lastLogin;

    // /**
    //  * Random string sent to the user email address in order to verify it
    //  *
    //  * @var string
    //  */
    // protected $confirmationToken;

    // /**
    //  * @var \DateTime
    //  */
    // protected $passwordRequestedAt;

    // /**
    //  * @var boolean
    //  */
    // protected $locked = false;

    // /**
    //  * @var \DateTime
    //  */
    // protected $expiresAt;

    // /**
    //  * @var \DateTime
    //  */
    // protected $credentialsExpireAt;

    // /**
    //  * We need at least one role to be able to authenticate
    //  *
    //  * @var array
    //  */
    protected $roles = array(UserInterface::DEFAULT_ROLE);

    // /**
    //  * @var Collection
    //  */
    // protected $oauthAccounts;

    // /**
    //  * @var \DateTime
    //  */
    protected $createdAt;

    // /**
    //  * @var \DateTime
    //  */
    // protected $updatedAt;

    // /**
    //  * @var \DateTime
    //  */
    // protected $deletedAt;

    public function __construct()
    {
        $this->salt = base_convert(sha1(uniqid(mt_rand(), true)), 16, 36);
    //     $this->oauthAccounts = new ArrayCollection();
        $this->createdAt = new \DateTime();
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    // /**
    //  * {@inheritdoc}
    //  */
    // public function getCustomer()
    // {
    //     return $this->customer;
    // }

    // /**
    //  * {@inheritdoc}
    //  */
    // public function setCustomer(CustomerInterface $customer = null)
    // {
    //     if ($this->customer !== $customer) {
    //         $this->customer = $customer;
    //         $this->assignUser($customer);
    //     }
    // }

    /**
     * {@inheritdoc}
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * {@inheritdoc}
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    // /**
    //  * {@inheritdoc}
    //  */
    // public function getUsernameCanonical()
    // {
    //     return $this->usernameCanonical;
    // }

    // /**
    //  * {@inheritdoc}
    //  */
    // public function setUsernameCanonical($usernameCanonical)
    // {
    //     $this->usernameCanonical = $usernameCanonical;
    // }

    /**
     * {@inheritdoc}
     */
    public function getSalt()
    {
        return $this->salt;
    }

    /**
     * {@inheritdoc}
     */
    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    /**
     * {@inheritdoc}
     */
    public function setPlainPassword($password)
    {
        $this->plainPassword = $password;
    }

    /**
     * {@inheritdoc}
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * {@inheritdoc}
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    // /**
    //  * {@inheritdoc}
    //  */
    // public function getExpiresAt()
    // {
    //     return $this->expiresAt;
    // }

    // /**
    //  * @param \DateTime $date
    //  */
    // public function setExpiresAt(\DateTime $date = null)
    // {
    //     $this->expiresAt = $date;
    // }

    // /**
    //  * {@inheritdoc}
    //  */
    // public function getCredentialsExpireAt()
    // {
    //     return $this->credentialsExpireAt;
    // }

    // /**
    //  * {@inheritdoc}
    //  */
    // public function setCredentialsExpireAt(\DateTime $date = null)
    // {
    //     $this->credentialsExpireAt = $date;
    // }

    // /**
    //  * {@inheritdoc}
    //  */
    // public function getLastLogin()
    // {
    //     return $this->lastLogin;
    // }

    // /**
    //  * {@inheritdoc}
    //  */
    // public function setLastLogin(\DateTime $time = null)
    // {
    //     $this->lastLogin = $time;
    // }

    // /**
    //  * {@inheritdoc}
    //  */
    // public function getConfirmationToken()
    // {
    //     return $this->confirmationToken;
    // }

    // /**
    //  * {@inheritdoc}
    //  */
    // public function setConfirmationToken($confirmationToken)
    // {
    //     $this->confirmationToken = $confirmationToken;
    // }

    // /**
    //  * {@inheritdoc}
    //  */
    // public function isCredentialsNonExpired()
    // {
    //     return !$this->hasExpired($this->credentialsExpireAt);
    // }

    // /**
    //  * {@inheritdoc}
    //  */
    // public function isEnabled()
    // {
    //     return $this->enabled;
    // }

    // /**
    //  * {@inheritdoc}
    //  */
    // public function setEnabled($enabled)
    // {
    //     $this->enabled = (bool) $enabled;
    // }

    // /**
    //  * {@inheritdoc}
    //  */
    // public function isAccountNonExpired()
    // {
    //     return !$this->hasExpired($this->expiresAt);
    // }

    // /**
    //  * {@inheritdoc}
    //  */
    // public function setLocked($locked)
    // {
    //     $this->locked = $locked;
    // }

    // /**
    //  * {@inheritdoc}
    //  */
    // public function isAccountNonLocked()
    // {
    //     return !$this->locked;
    // }

    /**
     * {@inheritdoc}
     */
    public function hasRole($role)
    {
        return in_array(strtoupper($role), $this->getRoles(), true);
    }

    /**
     * {@inheritdoc}
     */
    public function addRole($role)
    {
        $role = strtoupper($role);
        if (!in_array($role, $this->roles, true)) {
            $this->roles[] = $role;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function removeRole($role)
    {
        if (false !== $key = array_search(strtoupper($role), $this->roles, true)) {
            unset($this->roles[$key]);
            $this->roles = array_values($this->roles);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getRoles()
    {
        return $this->roles;
    }

    /**
     * {@inheritdoc}
     */
    public function setRoles(array $roles)
    {
        $this->roles = array();

        foreach ($roles as $role) {
            $this->addRole($role);
        }
    }

    // /**
    //  * {@inheritdoc}
    //  */
    // public function getEmail()
    // {
    //     return $this->customer->getEmail();
    // }

    // /**
    //  * {@inheritdoc}
    //  */
    // public function setEmail($email)
    // {
    //     $this->customer->setEmail($email);
    // }

    // /**
    //  * {@inheritdoc}
    //  */
    // public function getEmailCanonical()
    // {
    //     return $this->customer->getEmailCanonical();
    // }

    // /**
    //  * {@inheritdoc}
    //  */
    // public function setEmailCanonical($emailCanonical)
    // {
    //     $this->customer->setEmailCanonical($emailCanonical);
    // }

    // /**
    //  * {@inheritdoc}
    //  */
    // public function isPasswordRequestNonExpired(\DateInterval $ttl)
    // {
    //     return (null !== $this->passwordRequestedAt && new \DateTime() <= $this->passwordRequestedAt->add($ttl));
    // }

    // /**
    //  * Gets the timestamp that the user requested a password reset.
    //  *
    //  * @return null|\DateTime
    //  */
    // public function getPasswordRequestedAt()
    // {
    //     return $this->passwordRequestedAt;
    // }

    // /**
    //  * {@inheritdoc}
    //  */
    // public function setPasswordRequestedAt(\DateTime $date = null)
    // {
    //     $this->passwordRequestedAt = $date;
    // }

    /**
     * {@inheritdoc}
     */
    public function eraseCredentials()
    {
        $this->plainPassword = null;
    }

    // /**
    //  * {@inheritdoc}
    //  */
    // public function getOAuthAccounts()
    // {
    //     return $this->oauthAccounts;
    // }

    // /**
    //  * {@inheritdoc}
    //  */
    // public function getOAuthAccount($provider)
    // {
    //     if ($this->oauthAccounts->isEmpty()) {
    //         return null;
    //     }

    //     $filtered = $this->oauthAccounts->filter(function (UserOAuthInterface $oauth) use ($provider) {
    //         return $provider === $oauth->getProvider();
    //     });

    //     if ($filtered->isEmpty()) {
    //         return null;
    //     }

    //     return $filtered->current();
    // }

    // /**
    //  * {@inheritdoc}
    //  */
    // public function addOAuthAccount(UserOAuthInterface $oauth)
    // {
    //     if (!$this->oauthAccounts->contains($oauth)) {
    //         $this->oauthAccounts->add($oauth);
    //         $oauth->setUser($this);
    //     }
    // }

    /**
     * {@inheritdoc}
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * {@inheritdoc}
     */
    public function setCreatedAt(\DateTime $createdAt)
    {
        $this->createdAt = $createdAt;
    }

    // /**
    //  * {@inheritdoc}
    //  */
    // public function getUpdatedAt()
    // {
    //     return $this->updatedAt;
    // }

    // /**
    //  * {@inheritdoc}
    //  */
    // public function setUpdatedAt(\DateTime $updatedAt)
    // {
    //     $this->updatedAt = $updatedAt;
    // }

    // /**
    //  * {@inheritdoc}
    //  */
    // public function getDeletedAt()
    // {
    //     return $this->deletedAt;
    // }

    // /**
    //  * {@inheritdoc}
    //  */
    // public function setDeletedAt(\DateTime $deletedAt = null)
    // {
    //     $this->deletedAt = $deletedAt;
    // }

    // /**
    //  * {@inheritdoc}
    //  */
    // public function isDeleted()
    // {
    //     return $this->hasExpired($this->deletedAt);
    // }

    /**
     * Returns username.
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->getUsername();
    }

    /**
     * The serialized data have to contain the fields used by the equals method and the username.
     *
     * @return string
     */
    public function serialize()
    {
        return serialize(array(
            $this->password,
            $this->salt,
            // $this->usernameCanonical,
            $this->username,
            // $this->locked,
            // $this->enabled,
            $this->id,
        ));
    }

    /**
     * @param string $serialized
     */
    public function unserialize($serialized)
    {
        $data = unserialize($serialized);
        // add a few extra elements in the array to ensure that we have enough keys when unserializing
        // older data which does not include all properties.
        // $data = array_merge($data, array_fill(0, 2, null));

        list(
            $this->password,
            $this->salt,
            // $this->usernameCanonical,
            $this->username,
            // $this->locked,
            // $this->enabled,
            $this->id
            ) = $data;
    }

    // /**
    //  * @param CustomerInterface $customer
    //  */
    // protected function assignUser(CustomerInterface $customer = null)
    // {
    //     if (null !== $customer) {
    //         $customer->setUser($this);
    //     }
    // }

    // /**
    //  * @return bool
    //  */
    // protected function hasExpired($date)
    // {
    //     return (null !== $date) && ((new \DateTime()) >= $date);
    // }

    /**
     * @inheritDoc
     */
    // public function equals(UserInterface $user)
    // {
    //     return $this->username === $user->getUsername();
    // }

    public function isEqualTo(BaseUserInterface $user)
    {
        return true;
    }
}
