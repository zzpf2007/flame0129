<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Acme\Bundle\ResourceBundle\DependencyInjection\Driver\Doctrine;

use Acme\Component\Resource\Metadata\MetadataInterface;
use Symfony\Component\DependencyInjection\Alias;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Acme\Bundle\ResourceBundle\DependencyInjection\Driver\AbstractDriver;
use Symfony\Component\DependencyInjection\Reference;

/**
 * @author Paweł Jędrzejewski <pawel@sylius.org>
 * @author Arnaud Langlade <aRn0D.dev@gmail.com>
 */
abstract class AbstractDoctrineDriver extends AbstractDriver
{
    /**
     * @param MetadataInterface $metadata
     *
     * @return Definition
     */
    protected function getClassMetadataDefinition(MetadataInterface $metadata)
    {
        $definition = new Definition($this->getClassMetadataClassname());

        // var_dump(array(new Reference($this->getManagerServiceId($metadata)), 'getClassMetadata'));
        // echo "\nClass name: " . $this->getClassMetadataClassname() . "\n";

        echo "\nGetClassMetadata: " . $this->getManagerServiceId($metadata) . "\n";
        // $definition
        //     ->setFactory(array(new Reference($this->getManagerServiceId($metadata)), 'getClassMetadata'))
        //     ->setArguments(array($metadata->getClass('model')))
        //     ->setPublic(false)
        // ;
        echo "\nModel: " . $metadata->getClass('model') . "\n";

        $definition
            ->setFactory(array(new Reference($this->getManagerServiceId($metadata)), 'getClassMetadata'))
            ->setArguments(array($metadata->getClass('model')))
            ->setPublic(false)
        ;

        return $definition;
    }

    /**
     * {@inheritdoc}
     */
    protected function addManager(ContainerBuilder $container, MetadataInterface $metadata)
    {

        echo "\nAdd manager: " . $this->getManagerServiceId($metadata) . "\n";
        $container->setAlias(
            $metadata->getServiceId('manager'),
            new Alias($this->getManagerServiceId($metadata))
        );

        echo "\nManager alias: " . $metadata->getServiceId('manager') . "\n";
    }

    /**
     * @param MetadataInterface $metadata
     *
     * @return string
     */
    protected function getObjectManagerName(MetadataInterface $metadata)
    {
        $objectManagerName = 'default';

        if ($metadata->hasParameter('options') && isset($metadata->getParameter('options')['object_manager'])) {
            $objectManagerName = $metadata->getParameter('options')['object_manager'];
        }
        
        return $objectManagerName;
    }

    /**
     * @param MetadataInterface $metadata
     *
     * @return string
     */
    abstract protected function getManagerServiceId(MetadataInterface $metadata);

    /**
     * @return string
     */
    abstract protected function getClassMetadataClassname();
}
