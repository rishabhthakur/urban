<?php

namespace Urban\Providers;

use Illuminate\Support\ServiceProvider;
use Darryldecode\Cart\Cart;

class Wishlist extends ServiceProvider
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
        $this->app->singleton('wishlist', function($app) {
            $storage = $app['session'];
            $events = $app['events'];
            $instanceName = 'wishlist';
            $session_key = str_random(13);
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
