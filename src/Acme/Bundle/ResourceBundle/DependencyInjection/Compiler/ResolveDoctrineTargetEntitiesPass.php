<?php

/*
 * This file is part of the Acme package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Acme\Bundle\ResourceBundle\DependencyInjection\Compiler;

use Acme\Bundle\ResourceBundle\DependencyInjection\DoctrineTargetEntitiesResolver;
use Acme\Bundle\ResourceBundle\AcmeResourceBundle;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * Resolves given target entities with container parameters.
 * Usable only with *doctrine/orm* driver.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@Acme.pl>
 */
class ResolveDoctrineTargetEntitiesPass implements CompilerPassInterface
{
    /**
     * @var array $interfaces
     */
    private $interfaces;

    /**
     * @var string $bundlePrefix
     */
    private $bundlePrefix;

    public function __construct($bundlePrefix, array $interfaces)
    {
        $this->bundlePrefix = $bundlePrefix;
        $this->interfaces = $interfaces;
    }

    /**
     * {@inheritdoc}
     */
    public function process(ContainerBuilder $container)
    {
        if (AcmeResourceBundle::DRIVER_DOCTRINE_ORM === $this->getDriver($container)) {
            $resolver = new DoctrineTargetEntitiesResolver();
            $resolver->resolve($container, $this->interfaces);
        }
    }

    /**
     * @param ContainerBuilder $container
     *
     * @return string
     */
    private function getDriver(ContainerBuilder $container)
    {
        // echo sprintf('%s.driver||', $this->bundlePrefix);
        return $container->getParameter(sprintf('%s.driver', $this->bundlePrefix));        
    }
}
