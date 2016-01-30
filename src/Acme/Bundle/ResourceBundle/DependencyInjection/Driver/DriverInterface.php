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

use Acme\Component\Resource\Metadata\MetadataInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * @author Paweł Jędrzejewski <pawel@sylius.org>
 */
interface DriverInterface
{
    /**
     * @param ContainerBuilder $container
     * @param MetadataInterface $metadata
     */
    public function load(ContainerBuilder $container, MetadataInterface $metadata);

    /**
     * Returns unique name of the driver.
     *
     * @return string
     */
    public function getType();
}
