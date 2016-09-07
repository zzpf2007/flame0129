<?php

namespace Acme\Component\Resource\Model;

/**
 * @author Anna Walasek <anna.walasek@lakion.com>
 */
interface CodeAwareInterface
{
    /**
     * @return string
     */
    public function getCode();

    /**
     * @param string $code
     */
    public function setCode($code);
}
