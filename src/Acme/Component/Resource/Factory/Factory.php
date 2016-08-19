<?php

namespace Acme\Component\Resource\Factory;

class Factory implements FactoryInterface
{
    /**
     * @var string
     */
    private $className;

    /**
     * @param $className
     */
    public function __construct($className)
    {
        $this->className = $className;
    }

    /**
     * {@inheritdoc}
     */
    public function createNew()
    {
        return new $this->className;
    }
}
