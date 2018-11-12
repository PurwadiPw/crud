<?php

namespace Pw\RajaOngkir;

use Illuminate\Support\ServiceProvider;
use Pw\RajaOngkir\RajaOngkir;

/**
 * @see \Pw\RajaOngkir\RajaOngkirServiceProvider
 *
 * @author Purwadi <purwadie97@gmail.com>
 */

class RajaOngkirServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred
     */
    protected $defer = true;

    /**
     * Config path of rajaongkir packages
     */
    private $config_path = __DIR__ . '/../config/rajaongkir.php';

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            $this->config_path => config_path('rajaongkir.php'),
        ], 'lara-ongkir');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom($this->config_path, 'rajaongkir');
        $this->registerRajaOngkir();

        // $this->app->alias('RajaOngkir', 'Pw\RajaOngkir\RajaOngkir');
    }

    public function registerRajaOngkir()
    {
        $this->app->singleton('RajaOngkir', function ($app) {
            return new RajaOngkir($this->app['config']['rajaongkir.api_key'], $this->app['config']['rajaongkir.account_type']);
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['RajaOngkir'];
    }
}
