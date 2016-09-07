<?php

namespace Acme\Bundle\CoreBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Acme\Bundle\ResourceBundle\AcmeResourceBundle;

class AcmeCoreBundle extends AbstractResourceBundle
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
        );
    }

    /**
     * {@inheritdoc}
     */
    protected function getModelNamespace()
    {
        return 'Acme\Component\Core\Model';
    }
}