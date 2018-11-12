<?php

namespace Pw\RajaOngkir\Facades;

use Illuminate\Support\Facades\Facade as IlluminateFacade;
// use Pw\RajaOngkir\RajaOngkir as RajaOngkirClass;

/**
 * @see \Pw\RajaOngkir\RajaOngkir
 *
 * @author Purwadi <purwadie97@gmail.com>
 */
class RajaOngkir extends IlluminateFacade
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
