<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class IngredientStockShortageMailEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $ingredient;

    /**
     * Create a new event instance.
     */
    public function __construct($ingredient)
    {
        $this->ingredient = $ingredient;
    }

}
