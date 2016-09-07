<?php

namespace Acme\Bundle\UserBundle\Security;

use Acme\Component\User\Model\CredentialsHolderInterface;
use Acme\Component\User\Security\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;

/**
 */
class UserPasswordEncoder implements UserPasswordEncoderInterface
{
    /**
     * @var EncoderFactoryInterface
     */
    private $encoderFactory;

    /**
     * @param EncoderFactoryInterface $encoderFactory
     */
    public function __construct(EncoderFactoryInterface $encoderFactory)
    {
        $this->encoderFactory = $encoderFactory;
    }

    /**
     * {@inheritdoc}
     */
    public function encode(CredentialsHolderInterface $user)
    {
        $encoder = $this->encoderFactory->getEncoder(get_class($user));

        return $encoder->encodePassword($user->getPlainPassword(), $user->getSalt());
    }
}
