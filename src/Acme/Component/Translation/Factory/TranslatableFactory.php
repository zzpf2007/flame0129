<?php

/*
 */

namespace Acme\Component\Translation\Factory;

// use Acme\Component\Resource\Exception\UnexpectedTypeException;
use Acme\Component\Resource\Factory\FactoryInterface;
use Acme\Component\Translation\Model\TranslatableInterface;
use Acme\Component\Translation\Provider\LocaleProviderInterface;

/**
 * @author Paweł Jędrzejewski <pawel@sylius.org>
 */
class TranslatableFactory implements TranslatableFactoryInterface
{
    /**
     * @var FactoryInterface
     */
    private $factory;

    /**
     * @var LocaleProviderInterface
     */
    private $localeProvider;

    /**
     * @param FactoryInterface $factory
     * @param LocaleProviderInterface $localeProvider
     */
    public function __construct(FactoryInterface $factory, LocaleProviderInterface $localeProvider)
    {
        $this->factory = $factory;
        $this->localeProvider = $localeProvider;
    }

    /**
     * {@inheritdoc}
     */
    public function createNew()
    {
        $resource = $this->factory->createNew();

        if (!$resource instanceof TranslatableInterface) {
            // throw new UnexpectedTypeException($resource, TranslatableInterface::class);
        }

        $resource->setCurrentLocale($this->localeProvider->getCurrentLocale());
        $resource->setFallbackLocale($this->localeProvider->getFallbackLocale());

        return $resource;
    }
}
