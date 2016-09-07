<?php

namespace Acme\Component\Translation\Provider;

/**
 */
interface LocaleProviderInterface
{
    /**
     * @return string
     */
    public function getCurrentLocale();

    /**
     * @return string
     */
    public function getFallbackLocale();
}
