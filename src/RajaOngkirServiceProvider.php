<?php

namespace Pw\RajaOngkir;

use Illuminate\Support\ServiceProvider;

/**
 * @see \Pw\RajaOngkir\RajaOngkirServiceProvider
 *
 * @author Purwadi <purwadie97@gmail.com>
 */

class RajaOngkirServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/config/rajaongkir.php' => config_path() . '/rajaongkir.php',
        ]);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->registerRajaOngkir();

        $this->app->alias('RajaOngkir', 'Pw\RajaOngkir\Endpoints');
    }

    public function registerRajaOngkir()
    {
        $this->app->singleton('RajaOngkir', function () {
            return new Endpoints(config('rajaongkir.api_key'), config('rajaongkir.account_type'));
        });
    }
}
