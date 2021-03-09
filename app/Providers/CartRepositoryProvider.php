<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\CartRepository;
use App\Cart;
class CartRepositoryProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(CartRepository::class, function(){
            return new CartRepository(new Cart);
        });
    }
}
