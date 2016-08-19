<?php

/*
 * This file is part of the Isyfuture package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Acme\Bundle\CartBundle\Provider;

use Acme\Component\Cart\Provider\CartProviderInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\EventDispatcher\GenericEvent;

/**
 * Default cart provider.
 *
 * @author kevin.zhou
 */
class CartProvider implements CartProviderInterface
{

    /**
     * {@inheritdoc}
     */
    public function hasCart()
    {
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function getCart()
    {
        $cart = $this->provideCart();
    
        return $cart;
    }

    /**
     * Tries to initialize cart if there is data in storage.
     * If not, returns new instance from resourceFactory
     *
     * @return CartInterface
     */
    private function provideCart()
    {
        $cart = array('items' => 10, 'total' => 30);

        return $cart;
    }
}
