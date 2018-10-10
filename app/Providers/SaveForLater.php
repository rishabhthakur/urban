<?php

namespace Urban\Providers;

use Illuminate\Support\ServiceProvider;
use Darryldecode\Cart\Cart;

class SaveForLater extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register() {
        $this->app->singleton('saveForLater', function($app) {
            $storage = $app['session'];
            $events = $app['events'];
            $instanceName = 'saveForLater';
            $session_key = 'AsASDMCks0ks1';
            return new Cart(
                $storage,
                $events,
                $instanceName,
                $session_key,
                config('shopping_cart')
            );
        });
    }
}
