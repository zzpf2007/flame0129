<?php

/**
 * AbstractUserProvider implements UserProviderInterface
 * UserProvider provider implements for Security Provider
 */

namespace Acme\Bundle\UserBundle\Provider;

use Acme\Component\User\Repository\UserRepositoryInterface;
use Acme\Component\User\Model\UserInterface as AcmeUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Acme\Bundle\UserBundle\Provider\UserProviderInterface;

/**
 * @author kevin.zhou <kevin.zhou@hotmail.co.uk>
 */

abstract class AbstractUserProvider implements UserProviderInterface
{
    /**
     * @var string
     */
    protected $supportedUserClass = UserInterface::class;

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
            throw new UsernameNotFoundException(
                sprintf('Username "%s" does not exist.', $usernameOrEmail)
            );
        }
       
        return $user;
    }

    /**
     * {@inheritDoc}
     */
    public function refreshUser(UserInterface $user)
    {
        if (null === $reloadedUser = $this->userRepository->find($user->getId())) {
            throw new UnsupportedUserException(
                sprintf('Instances of "%s" are not supported.', get_class($user))
            );
        }

        return $this->loadUserByUsername($user->getUsername());        
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
        return $this->supportedUserClass === $class || is_subclass_of($class, $this->supportedUserClass);
    }
}