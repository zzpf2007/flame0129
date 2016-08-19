<?php

namespace Acme\Bundle\ProductBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Acme\Bundle\ResourceBundle\AbstractResourceBundle;
use Acme\Bundle\ResourceBundle\AcmeResourceBundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Doctrine\Bundle\DoctrineBundle\DependencyInjection\Compiler\DoctrineOrmMappingsPass;

class AcmeProductBundle extends AbstractResourceBundle
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

        // $container->addCompilerPass(new ServicesPass());
        // $container->addCompilerPass(new ValidatorPass());

        // $modelDir = realpath(__DIR__.'/Resources/config/doctrine/model');
        // echo "\nModelDir: " . $modelDir . "\n";
        // $mappings = array( $modelDir => 'Acme\Component\Product\Model');
        // var_dump($mappings);

        // $ormCompilerClass = 'Doctrine\Bundle\DoctrineBundle\DependencyInjection\Compiler\DoctrineOrmMappingsPass';

        // if (class_exists($ormCompilerClass)) {
        //     $container->addCompilerPass(
        //         DoctrineOrmMappingsPass::createXmlMappingDriver(
        //             $mappings,
        //             array('acme.product.manager'),
        //             'acme_product.orm_enable',
        //             array('AcmeProductBundle' => 'Acme\Component\Product\Model')
        //     ));
        // }
    }

    /**
     * {@inheritdoc}
     */
    protected function getModelNamespace()
    {
        return 'Acme\Component\Product\Model';
    }
}
