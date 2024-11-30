<?php

namespace App\Providers;

use App\Events\IngredientStockEvent;
use App\Events\IngredientStockShortageMailEvent;
use App\Listeners\IngredientStockListener;
use App\Listeners\IngredientStockShortageMailListener;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Event::listen(IngredientStockEvent::class, IngredientStockListener::class);
        Event::listen(IngredientStockShortageMailEvent::class, IngredientStockShortageMailListener::class);
    }
}
