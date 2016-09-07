<?php

namespace Acme\Bundle\UserBundle\EventListener;

use Doctrine\ORM\Event\LifecycleEventArgs;
// use Acme\Component\Resource\Exception\UnexpectedTypeException;
// use Acme\Component\User\Model\CustomerInterface;
use Acme\Component\User\Model\UserInterface;
use Acme\Component\User\Security\PasswordUpdaterInterface;
use Symfony\Component\EventDispatcher\GenericEvent;

class PasswordUpdaterListener
{
    /**
     * @var PasswordUpdaterInterface
     */
    protected $passwordUpdater;

    /**
     * @param PasswordUpdaterInterface $passwordUpdater
     */
    public function __construct(PasswordUpdaterInterface $passwordUpdater)
    {
        $this->passwordUpdater = $passwordUpdater;
    }

    /**
     * @param UserInterface $user
     */
    public function updateUserPassword(UserInterface $user)
    {
        if (null !== $user->getPlainPassword()) {
            $this->passwordUpdater->updatePassword($user);
        }
    }

    /**
     * @param LifecycleEventArgs $event
     */
    protected function updatePassword(LifecycleEventArgs $event)
    {
        $item = $event->getEntity();

        if (!$item instanceof UserInterface) {
            return;
        }

        $this->updateUserPassword($item);
    }

    /**
     * @param GenericEvent $event
     */
    public function genericEventUpdater(GenericEvent $event)
    {
        $user = $event->getSubject();

        if (!$user instanceof UserInterface) {
            // throw new UnexpectedTypeException(
            //     $user,
            //     UserInterface::class
            // );
        }

        $this->updateUserPassword($user);
    }

    // /**
    //  * @param GenericEvent $event
    //  */
    // public function customerUpdateEvent(GenericEvent $event)
    // {
    //     $customer = $event->getSubject();

    //     if (!$customer instanceof CustomerInterface) {
    //         throw new UnexpectedTypeException(
    //             $customer,
    //             'Acme\Component\User\Model\CustomerInterface'
    //         );
    //     }

    //     if (null !== $user = $customer->getUser()) {
    //         $this->updateUserPassword($user);
    //     }
    // }

    /**
     * @param LifecycleEventArgs $event
     */
    public function prePersist(LifecycleEventArgs $event)
    {
        $this->updatePassword($event);
    }

    /**
     * @param LifecycleEventArgs $event
     */
    public function preUpdate(LifecycleEventArgs $event)
    {
        $this->updatePassword($event);
    }
}
