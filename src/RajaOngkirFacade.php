<?php

namespace Pw\RajaOngkir;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Pw\RajaOngkir\RajaOngkirFacade
 *
 * @author Purwadi <purwadie97@gmail.com>
 */
class RajaOngkirFacade extends Facade
{

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'RajaOngkir';
    }
}
