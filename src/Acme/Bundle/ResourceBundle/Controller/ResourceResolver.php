<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Acme\Bundle\ResourceBundle\Controller;

use Acme\Component\Resource\Factory\FactoryInterface;
use Acme\Component\Resource\Repository\RepositoryInterface;

/**
 * Resource resolver.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@sylius.pl>
 */
class ResourceResolver
{
    /**
     * @var Configuration
     */
    private $config;

    public function __construct(Configuration $config)
    {
        $this->config = $config;
    }

    /**
     * Get resources via repository based on the configuration.
     *
     * @param RepositoryInterface $repository
     * @param string              $defaultMethod
     * @param array               $defaultArguments
     *
     * @return mixed
     */
    public function getResource(RepositoryInterface $repository, $defaultMethod, array $defaultArguments = array())
    {
        // var_dump($this->config->getRepositoryMethod($defaultMethod));
        $callable = array($repository, $this->config->getRepositoryMethod($defaultMethod));
        $arguments = $this->config->getRepositoryArguments($defaultArguments);

        return call_user_func_array($callable, $arguments);
    }

    /**
     * Create resource.
     *
     * @param FactoryInterface $factory
     * @param string           $defaultMethod
     * @param array            $defaultArguments
     *
     * @return mixed
     */
    public function createResource(FactoryInterface $factory, $defaultMethod, array $defaultArguments = array())
    {
        $callable = array($factory, $this->config->getFactoryMethod($defaultMethod));
        $arguments = $this->config->getFactoryArguments($defaultArguments);

        return call_user_func_array($callable, $arguments);
    }
}
