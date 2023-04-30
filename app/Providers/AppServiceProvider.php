<?php

namespace App\Providers;

use App\Modifiers\ShippingModifier;
use Illuminate\Support\ServiceProvider;
use Lunar\Base\ShippingModifiers;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(ShippingModifiers $shippingModifiers): void
    {
        $shippingModifiers->add(
            ShippingModifier::class
        );
    }
}
