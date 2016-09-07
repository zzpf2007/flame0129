<?php

/**
 * UsernameProvider extends from AbstractUserProvider
 * Implements the method findUser()
 */

namespace Acme\Bundle\UserBundle\Provider;
use Acme\Component\User\Repository\UserRepositoryInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class UsernameProvider extends AbstractUserProvider
{
    /**
     * {@inheritDoc}
     */
    protected function findUser($username)
    {
        return $this->userRepository->findOneBy(array('username' => $username));
    }
}