<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Acme\Bundle\ResourceBundle\DependencyInjection\Driver;

// use Acme\Component\Resource\Factory\Factory;
use Acme\Component\Resource\Metadata\MetadataInterface;
// use Acme\Component\Translation\Factory\TranslatableFactoryInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Parameter;
use Symfony\Component\DependencyInjection\Reference;

/**
 * @author Paweł Jędrzejewski <pawel@sylius.org>
 * @author Arnaud Langlade <aRn0D.dev@gmail.com>
 */
abstract class AbstractDriver implements DriverInterface
{
    /**
     * {@inheritdoc}
     */
    public function load(ContainerBuilder $container, MetadataInterface $metadata)
    {
        $this->setClassesParameters($container, $metadata);

        // echo "meta load!";

        if ($metadata->hasClass('controller')) {
            $this->addController($container, $metadata);
        }

        $this->addManager($container, $metadata);
        $this->addRepository($container, $metadata);

        if ($metadata->hasClass('factory')) {
            $this->addFactory($container, $metadata);
        }

        if ($metadata->hasClass('form')) {
            $this->addForms($container, $metadata);
        }
    }

    /**
     * @param ContainerBuilder $container
     * @param MetadataInterface $metadata
     */
    protected function setClassesParameters(ContainerBuilder $container, MetadataInterface $metadata)
    {
        // echo "Set ClassesParameters";
        if ($metadata->hasClass('model')) {
            $container->setParameter(sprintf('%s.model.%s.class', $metadata->getApplicationName(), $metadata->getName()), $metadata->getClass('model'));
            // echo sprintf('%s.model.%s.class', $metadata->getApplicationName(), $metadata->getName());
        }
        if ($metadata->hasClass('controller')) {
            // var_dump( sprintf('%s.controller.%s.class', $metadata->getApplicationName(), $metadata->getName()) );
            // var_dump( $metadata->getClass('controller') );
            $container->setParameter(sprintf('%s.controller.%s.class', $metadata->getApplicationName(), $metadata->getName()), $metadata->getClass('controller'));
            // echo sprintf('%s.controller.%s.class', $metadata->getApplicationName(), $metadata->getName());
        }
        if ($metadata->hasClass('factory')) {
            $container->setParameter(sprintf('%s.factory.%s.class', $metadata->getApplicationName(), $metadata->getName()), $metadata->getClass('factory'));
            // echo sprintf('%s.factory.%s.class', $metadata->getApplicationName(), $metadata->getName());
        }
        if ($metadata->hasClass('repository')) {
            $container->setParameter(sprintf('%s.repository.%s.class', $metadata->getApplicationName(), $metadata->getName()), $metadata->getClass('repository'));
            // echo sprintf('%s.repository.%s.class', $metadata->getApplicationName(), $metadata->getName());
        }

        if (!$metadata->hasParameter('validation_groups')) {
            return;
        }

        $validationGroups = $metadata->getParameter('validation_groups');

        foreach ($validationGroups as $formName => $groups) {
            $suffix = 'default' === $formName ? '' : sprintf('_%s', $formName);
            $container->setParameter(sprintf('%s.validation_groups.%s%s', $metadata->getApplicationName(), $metadata->getName(), $suffix), array_merge(array('Default'), $groups));
        }
    }

    /**
     * @param ContainerBuilder $container
     * @param MetadataInterface $metadata
     */
    protected function addController(ContainerBuilder $container, MetadataInterface $metadata)
    {
        // @todo: Remove when ResourceController is reworked.
        $configurationDefinition = new Definition(new Parameter('acme.controller.configuration.class'));
        $configurationDefinition
            ->setFactory(array(new Reference('acme.controller.configuration_factory'), 'createConfiguration'))
            ->setArguments(array($metadata->getApplicationName(), $metadata->getName(), $metadata->getTemplatesNamespace()))
            ->setPublic(false)
        ;

        // var_dump(new Parameter('acme.controller.configuration.class'));
        // var_dump($container->getParameter('acme.controller.configuration.class'));
        // var_dump($container->getParameter('acme.controller.product.class'));
        // var_dump($configurationDefinition);

        // echo "metadata";
        $definition = new Definition($metadata->getClass('controller'));
        // var_dump($metadata->getClass('controller'));        
        $definition
            ->setArguments(array($configurationDefinition))
            ->addMethodCall('setContainer', array(new Reference('service_container')))
        ;

        // var_dump($definition);
        $container->setDefinition($metadata->getServiceId('controller'), $definition);
    }

    /**
     * @param ContainerBuilder $container
     * @param MetadataInterface $metadata
     */
    protected function addFactory(ContainerBuilder $container, MetadataInterface $metadata)
    {
        $translatableFactoryInterface = TranslatableFactoryInterface::class;

        $factoryClass = $metadata->getClass('factory');
        $modelClass = $metadata->getClass('model');

        $reflection = new \ReflectionClass($factoryClass);
        $definition = new Definition($factoryClass);

        if (interface_exists($translatableFactoryInterface) && $reflection->implementsInterface($translatableFactoryInterface)) {
            $decoratedDefinition = new Definition(Factory::class);
            $decoratedDefinition->setArguments(array($modelClass));

            $definition->setArguments(array($decoratedDefinition, new Reference('acme.translation.locale_provider')));

            $container->setDefinition($metadata->getServiceId('factory'), $definition);

            return;
        }

        $definition->setArguments(array($modelClass));

        $container->setDefinition($metadata->getServiceId('factory'), $definition);
    }

    /**
     * @param ContainerBuilder $container
     * @param MetadataInterface $metadata
     */
    protected function addForms(ContainerBuilder $container, MetadataInterface $metadata)
    {
        foreach ($metadata->getClass('form') as $formName => $formClass) {
            $suffix = 'default' === $formName ? '' : sprintf('_%s', $formName);
            $alias = sprintf('%s_%s%s', $metadata->getApplicationName(), $metadata->getName(), $suffix);

            // echo "\nIamin addForms alias: " . $alias . "\n";

            $definition = new Definition($formClass);

            switch ($formName) {
                case 'choice':
                    $definition->setArguments(array(
                        $metadata->getClass('model'),
                        $metadata->getDriver(),
                        $alias,
                    ));
                break;

                default:
                    $validationGroupsParameterName = sprintf('%s.validation_groups.%s%s', $metadata->getApplicationName(), $metadata->getName(), $suffix);
                    $validationGroups = new Parameter($validationGroupsParameterName);

                    if (!$container->hasParameter($validationGroupsParameterName)) {
                        $validationGroups = array('Default');
                    }

                    $definition->setArguments(array(
                        $metadata->getClass('model'),
                        $validationGroups
                    ));
                break;
            }

            $definition->addTag('form.type', array('alias' => $alias));

            $container->setParameter(sprintf('%s.form.type.%s%s.class', $metadata->getApplicationName(), $metadata->getName(), $suffix), $formClass);
            $container->setDefinition(
                sprintf('%s.form.type.%s%s', $metadata->getApplicationName(), $metadata->getName(), $suffix),
                $definition
            );
        }
    }

    /**
     * @param ContainerBuilder $container
     * @param MetadataInterface $metadata
     */
    abstract protected function addManager(ContainerBuilder $container, MetadataInterface $metadata);

    /**
     * @param ContainerBuilder $container
     * @param MetadataInterface $metadata
     */
    abstract protected function addRepository(ContainerBuilder $container, MetadataInterface $metadata);
}
