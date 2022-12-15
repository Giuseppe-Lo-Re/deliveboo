<?php

namespace App\Providers;

use Braintree\Gateway;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Inietto i dati di accesso di Braintree
        $this->app->singleton(Gateway::class, function($app){
            return new Gateway(
                [
                    'environment' => 'sandbox',
                    'merchantId' => 'xct68yh7j5bwfn4c',
                    'publicKey' => '8486vjx4pqkscmyp',
                    'privateKey' => 'd4532f66cc18ae2b90e1ea04d64eaeb1'
                ]
            );
        });
    }
}

