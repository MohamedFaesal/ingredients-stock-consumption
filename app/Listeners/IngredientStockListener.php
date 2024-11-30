<?php

namespace App\Listeners;

use App\Events\IngredientStockEvent;
use App\Services\IngredientService;

class IngredientStockListener
{
    private IngredientService $ingredientService;
    public function __construct(IngredientService $ingredientService)
    {
        $this->ingredientService = $ingredientService;
    }

    /**
     * Handle the event.
     */
    public function handle(IngredientStockEvent $event): void
    {
        $this->ingredientService->validateOnIngredientShortage($event->affectedIngredients);
    }
}
