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

// use Acme\Bundle\ResourceBundle\DependencyInjection\Driver\Doctrine\DoctrineODMDriver;
use Acme\Bundle\ResourceBundle\DependencyInjection\Driver\Doctrine\DoctrineORMDriver;
// use Sylius\Bundle\ResourceBundle\DependencyInjection\Driver\Doctrine\DoctrinePHPCRDriver;
// use Sylius\Bundle\ResourceBundle\DependencyInjection\Driver\Exception\UnknownDriverException;
// use Sylius\Bundle\ResourceBundle\SyliusResourceBundle;
use Acme\Component\Resource\Metadata\MetadataInterface;

/**
 * @author Arnaud Langlade <aRn0D.dev@gmail.com>
 */
class DriverProvider
{
    /**
     * @var DriverInterface[]
     */
    static private $drivers = array();

    /**
     * @param MetadataInterface $metadata
     *
     * @return DriverInterface
     *
     * @throws UnknownDriverException
     */
    public static function get(MetadataInterface $metadata)
    {
        // echo 'Metadata Get!';
        $type = $metadata->getDriver();

        // if (isset(self::$drivers[$type])) {
        //     return self::$drivers[$type];
        // }

        // switch ($type) {
        //     case SyliusResourceBundle::DRIVER_DOCTRINE_ORM:
        //         return self::$drivers[$type] = new DoctrineORMDriver();
        //     case SyliusResourceBundle::DRIVER_DOCTRINE_MONGODB_ODM:
        //         return self::$drivers[$type] = new DoctrineODMDriver();
        //     case SyliusResourceBundle::DRIVER_DOCTRINE_PHPCR_ODM:
        //         return self::$drivers[$type] = new DoctrinePHPCRDriver();
        // }

        // throw new UnknownDriverException($type);
        return self::$drivers[$type] = new DoctrineORMDriver();
    }
}
