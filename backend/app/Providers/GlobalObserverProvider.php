<?php

namespace App\Providers;

use App\Models\Product;
use App\Observers\CacheObserver;
use Illuminate\Support\ServiceProvider;

class GlobalObserverProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $models = [
            Product::class,
        ];

        foreach ($models as $model) {
            $model::observe(CacheObserver::class);
        }
    }
}
