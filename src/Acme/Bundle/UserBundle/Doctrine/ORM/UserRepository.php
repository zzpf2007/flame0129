<?php

/**
 * UserRepository implements UserRepositoryInterface
 */

namespace Acme\Bundle\UserBundle\Doctrine\ORM;

use Acme\Component\User\Repository\UserRepositoryInterface;
use Acme\Bundle\ResourceBundle\Doctrine\ORM\EntityRepository;

/**
 * @author kevin.zhou <kevin.zhou@hotmail.co.uk>
 */
class UserRepository extends EntityRepository implements UserRepositoryInterface
{
    public function findOneByEmail($email)
    {
        return "email";
    }
}