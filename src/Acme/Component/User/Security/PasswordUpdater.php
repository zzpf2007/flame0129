<?php

namespace Acme\Component\User\Security;

use Acme\Component\User\Model\CredentialsHolderInterface;

/**
 */
class PasswordUpdater implements PasswordUpdaterInterface
{
    /**
     * @var UserPasswordEncoderInterface
     */
    private $userPasswordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->userPasswordEncoder = $passwordEncoder;
    }

    /**
     * {@inheritDoc}
     */
    public function updatePassword(CredentialsHolderInterface $user)
    {
        if (0 !== strlen($password = $user->getPlainPassword())) {
            $user->setPassword($this->userPasswordEncoder->encode($user));
            $user->eraseCredentials();
        }
    }
}
