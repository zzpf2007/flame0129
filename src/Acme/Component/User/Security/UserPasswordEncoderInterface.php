<?php

namespace Acme\Component\User\Security;

use Acme\Component\User\Model\CredentialsHolderInterface;

/**
 */
interface UserPasswordEncoderInterface
{
    /**
     * Encodes the user plain password.
     *
     * @param CredentialsHolderInterface $user
     *
     * @return string The encoded password
     */
    public function encode(CredentialsHolderInterface $user);
}
