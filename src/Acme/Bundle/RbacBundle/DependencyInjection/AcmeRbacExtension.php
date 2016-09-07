<?php

namespace Acme\Bundle\RbacBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;
use Acme\Bundle\ResourceBundle\DependencyInjection\Extension\AbstractResourceExtension;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class AcmeRbacExtension extends AbstractResourceExtension implements PrependExtensionInterface
// class AcmeRbacExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        
        $this->registerResources('acme', $config['driver'], $config['resources'], $container);
        // var_dump($config['driver']);

        $configFiles = array(
            'services.xml',
        );

        foreach ($configFiles as $configFile) {
            $loader->load($configFile);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function prepend(ContainerBuilder $container)
    {
        // $config = $this->processConfiguration(new Configuration(), $container->getExtensionConfig($this->getAlias()));

        // $this->prependAttribute($container, $config);
        // $this->prependVariation($container, $config);
    }
}
