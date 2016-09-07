<?php

namespace Acme\Component\User\Security;

use Acme\Component\User\Model\CredentialsHolderInterface;

/**
 */
interface PasswordUpdaterInterface
{
    public function updatePassword(CredentialsHolderInterface $user);
}
