<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        \Braintree_Configuration::environment('sandbox');
        \Braintree_Configuration::merchantId('p29925ccbb74yfwj');
        \Braintree_Configuration::publicKey('b86vhzpgvz4w3x88');
        \Braintree_Configuration::privateKey('86e3e8756bdd52b36188241d9dc220d0');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
