<?php

/*
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Acme\Bundle\ResourceBundle\DependencyInjection\Extension;

use Acme\Bundle\ResourceBundle\DependencyInjection\Driver\DriverProvider;
use Acme\Component\Resource\Metadata\Metadata;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;

/**
 */
abstract class AbstractResourceExtension extends Extension
{
    /**
     * @param string $applicationName
     * @param string $driver
     * @param array $resources
     * @param ContainerBuilder $container
     */
    protected function registerResources($applicationName, $driver, array $resources, ContainerBuilder $container)
    {
        // $container->setParameter(sprintf('%s.driver.%s', $this->getAlias(), $driver), true);
        // $container->setParameter(sprintf('%s.driver', $this->getAlias()), $driver);

        foreach ($resources as $resourceName => $resourceConfig) {
            $alias = $applicationName.'.'.$resourceName;
            // $resourceConfig = array_merge(array('driver' => $driver), $resourceConfig);

            // $resources = $container->hasParameter('sylius.resources') ? $container->getParameter('sylius.resources') : array();
            // $resources = array_merge($resources, array($alias => $resourceConfig));
            // $container->setParameter('sylius.resources', $resources);

            // var_dump($resourceConfig);

            $metadata = Metadata::fromAliasAndConfiguration($alias, $resourceConfig);
            // var_dump($metadata);

            // echo "register resources!";
            DriverProvider::get($metadata)->load($container, $metadata);

            // if ($metadata->hasParameter('translation')) {
            //     $alias = $alias.'_translation';
            //     $resourceConfig = array_merge(array('driver' => $driver), $resourceConfig['translation']);

            //     $resources = $container->hasParameter('sylius.resources') ? $container->getParameter('sylius.resources') : array();
            //     $resources = array_merge($resources, array($alias => $resourceConfig));
            //     $container->setParameter('sylius.resources', $resources);

            //     $metadata = Metadata::fromAliasAndConfiguration($alias, $resourceConfig);

            //     DriverProvider::get($metadata)->load($container, $metadata);
            // }
        }
    }
}
