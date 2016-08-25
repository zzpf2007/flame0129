<?php

/**
 * AbstractUserProvider implements UserProviderInterface
 * UserProvider provider implements for Security Provider
 */

namespace Acme\Bundle\UserBundle\Provider;

use Acme\Component\User\Repository\UserRepositoryInterface;

/**
 * @author kevin.zhou <kevin.zhou@hotmail.co.uk>
 */

abstract class AbstractUserProvider implements UserProviderInterface
{
    /**
     * @var UserRepositoryInterface
     */
    protected $userRepository;

    /**
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * {@inheritDoc}
     */
    public function loadUserByUsername($usernameOrEmail)
    {
        $user = $this->findUser($usernameOrEmail);

        if (null === $user) {
            return null;
        }

        return $user;
    }

    /**
     * {@inheritDoc}
     */
    abstract protected function findUser($uniqueIdentifier);
}