<?php

namespace Acme\Component\Resource\Factory;

/**
 *
 */
interface FactoryInterface
{
    /**
     * Create a new resource.
     *
     * @return object
     */
    public function createNew();
}
