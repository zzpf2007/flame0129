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

use Acme\Bundle\ResourceBundle\Doctrine\ORM\EntityRepository;
// use Sylius\Bundle\ResourceBundle\SyliusResourceBundle;
// use Acme\Bundle\TranslationBundle\Doctrine\ORM\TranslatableResourceRepository;
use Acme\Component\Resource\Metadata\MetadataInterface;
use Acme\Component\Translation\Model\TranslatableInterface;
use Acme\Component\Translation\Repository\TranslatableResourceRepositoryInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Reference;

/**
 * @author Paweł Jędrzejewski <pawel@sylius.org>
 * @author Arnaud Langlade <aRn0D.dev@gmail.com>
 * @author Gonzalo Vilaseca <gvilaseca@reiss.co.uk>
 */
class DoctrineORMDriver extends AbstractDoctrineDriver
{
    /**
     * {@inheritdoc}
     */
    public function getType()
    {
        return SyliusResourceBundle::DRIVER_DOCTRINE_ORM;
    }

    /**
     * {@inheritdoc}
     */
    protected function addRepository(ContainerBuilder $container, MetadataInterface $metadata)
    {
        $reflection = new \ReflectionClass($metadata->getClass('model'));

        $translatableInterface = TranslatableInterface::class;
        $translatable = interface_exists($translatableInterface) && $reflection->implementsInterface($translatableInterface);

        $repositoryClassParameterName = sprintf('%s.repository.%s.class', $metadata->getApplicationName(), $metadata->getName());
        echo $repositoryClassParameterName;
        // $repositoryClass = $translatable
        //     ? TranslatableResourceRepository::class
        //     : EntityRepository::class
        // ;
        $repositoryClass = EntityRepository::class;

        if ($container->hasParameter($repositoryClassParameterName)) {
            $repositoryClass = $container->getParameter($repositoryClassParameterName);
        }

        if ($metadata->hasClass('repository')) {
            // echo "\nHas repository class";
            $repositoryClass = $metadata->getClass('repository');
            // echo $repositoryClass . "\n";
        }

        echo "\nRepository: " . $repositoryClass . "\n";

        $definition = new Definition($repositoryClass);
        $definition->setArguments(array(
            new Reference($metadata->getServiceId('manager')),
            $this->getClassMetadataDefinition($metadata),
        ));

        echo "\nAdd Repository method: " . $metadata->getServiceId('manager') . "\n";

        if ($metadata->hasParameter('translation')) {
            $repositoryReflection = new \ReflectionClass($repositoryClass);
            $translatableRepositoryInterface = TranslatableResourceRepositoryInterface::class;
            $translationConfig = $metadata->getParameter('translation');

            if (interface_exists($translatableRepositoryInterface) && $repositoryReflection->implementsInterface($translatableRepositoryInterface)) {
                if (isset($translationConfig['fields'])) {
                    $definition->addMethodCall('setTranslatableFields', array($translationConfig['fields']));
                }
            }
        }

        // echo "\n" . $metadata->getServiceId('repository') . "\n";

        $container->setDefinition($metadata->getServiceId('repository'), $definition);
    }

    /**
     * {@inheritdoc}
     */
    protected function getManagerServiceId(MetadataInterface $metadata)
    {
        // return sprintf('doctrine.orm.entity_manager', $this->getObjectManagerName($metadata));
        return sprintf('doctrine.orm.%s_entity_manager', $this->getObjectManagerName($metadata));
    }

    /**
     * {@inheritdoc}
     */
    protected function getClassMetadataClassname()
    {
        return 'Doctrine\\ORM\\Mapping\\ClassMetadata';
    }
}
