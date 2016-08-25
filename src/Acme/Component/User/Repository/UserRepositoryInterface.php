<?php

/**
 * UserRepositoryInterface extends Resource RepositoryInterface
 */

namespace Acme\Component\User\Repository;

use Acme\Component\Resource\Repository\RepositoryInterface;

/**
 * @author kevin.zhou <kevin.zhou@hotmail.co.uk>
 */
interface UserRepositoryInterface extends RepositoryInterface
{
    /**
     * @param string $email
     *
     * @return UserInterface | null
     */
    public function findOneByEmail($email);
}