<?php

namespace Acme\Bundle\CartBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Acme\Bundle\ResourceBundle\AbstractResourceBundle;
use Acme\Bundle\ResourceBundle\AcmeResourceBundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class AcmeCartBundle extends AbstractResourceBundle
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
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

    }

    /**
     * {@inheritdoc}
     */
    protected function getModelNamespace()
    {
        return 'Acme\Component\Cart\Model';
    }
}
