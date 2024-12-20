<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class IngredientStockEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public array $affectedIngredients;
    /**
     * Create a new event instance.
     */
    public function __construct($affectedIngredients)
    {
        $this->affectedIngredients = $affectedIngredients;
    }
}
