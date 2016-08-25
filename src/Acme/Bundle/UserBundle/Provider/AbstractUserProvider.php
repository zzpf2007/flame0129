<?php

/**
 * AbstractUserProvider implements UserProviderInterface
 * UserProvider provider implements for Security Provider
 */

namespace Acme\Bundle\UserBundle\Provider;

use Acme\Component\User\Repository\UserRepositoryInterface;
// use Acme\Component\User\Model\UserInterface as AcmeUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @author kevin.zhou <kevin.zhou@hotmail.co.uk>
 */

abstract class AbstractUserProvider implements UserProviderInterface
{
    /**
     * @var string
     */
    // protected $supportedUserClass = UserInterface::class;

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
    public function refreshUser(UserInterface $user)
    {

    }

    /**
     * {@inheritDoc}
     */
    abstract protected function findUser($uniqueIdentifier);

    /**
     * {@inheritDoc}
     */
    public function supportsClass($class)
    {
        // return $this->supportedUserClass === $class || is_subclass_of($class, $this->supportedUserClass);
        return true;
    }
}