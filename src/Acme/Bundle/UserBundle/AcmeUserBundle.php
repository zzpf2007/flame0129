<?php

namespace Acme\Bundle\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Acme\Bundle\ResourceBundle\AbstractResourceBundle;
use Acme\Bundle\ResourceBundle\AcmeResourceBundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Doctrine\Bundle\DoctrineBundle\DependencyInjection\Compiler\DoctrineOrmMappingsPass;

class AcmeUserBundle extends AbstractResourceBundle
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
        return 'Acme\Component\User\Model';
    }
}
