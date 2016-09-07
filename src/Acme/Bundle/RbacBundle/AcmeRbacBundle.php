<?php

namespace Acme\Bundle\RbacBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Acme\Bundle\ResourceBundle\AbstractResourceBundle;
use Acme\Bundle\ResourceBundle\AcmeResourceBundle;
// use Acme\Component\Rbac\Model\PermissionInterface;
use Acme\Component\Rbac\Model\RoleInterface;

class AcmeRbacBundle extends AbstractResourceBundle
{
    /**
     * {@inheritdoc}
     */
    public static function getSupportedDrivers()
    {
        return array(
            AcmeResourceBundle::DRIVER_DOCTRINE_ORM,
        );
    }

    /**
     * {@inheritdoc}
     */
    protected function getModelInterfaces()
    {
        return array(
            RoleInterface::class       => 'acme.model.role.class',
            // PermissionInterface::class => 'acmemodel.permission.class',
        );
    }

    /**
     * {@inheritdoc}
     */
    protected function getModelNamespace()
    {
        return 'Acme\Component\Rbac\Model';
    }
}
