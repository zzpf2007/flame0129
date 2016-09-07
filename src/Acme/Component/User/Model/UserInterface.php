<?php

namespace Acme\Component\User\Model;

use Doctrine\Common\Collections\Collection;
use Symfony\Component\Security\Core\User\UserInterface as BaseUserInterface;
use Symfony\Component\Security\Core\User\EquatableInterface;

interface UserInterface extends BaseUserInterface,
                                EquatableInterface,
                                CredentialsHolderInterface,
                                \Serializable    
{
    const DEFAULT_ROLE = 'ROLE_USER';

    public function setUsername($username);

    public function getUsername();

    public function getRoles();

    public function getPassword();

    public function hasRole($role);

    public function setRoles(array $roles);

    public function addRole($role);

    public function removeRole($role);

    public function getSalt();

    public function eraseCredentials();

    // public function equals($user);

    public function isEqualTo(BaseUserInterface $user);
}