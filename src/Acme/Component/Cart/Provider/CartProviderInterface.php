<?php

/*
 * This file is part of the Isyfuture package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Acme\Component\Cart\Provider;

/**
 * Interface for object that is accessor for cart.
 * It should retrieve existing cart or create new one based on storage.
 *
 * @author kevin.zhou
 */
interface CartProviderInterface
{
    /**
     * Returns true if a cart exists otherwise false.
     * It does not create a new cart if none exists
     *
     * @return Boolean
     */
    public function hasCart();

    /**
     * Returns current cart.
     * If none found is by storage, it should create new one and save it.
     *
     * @return CartInterface
     */
    public function getCart();
}
