<?php

namespace App\Listeners;

use App\Mail\IngredientStockShortageMail;
use Illuminate\Support\Facades\Mail;

class IngredientStockShortageMailListener
{
    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        Mail::to("ramy@isnaad.sa")->send(new IngredientStockShortageMail($event->ingredient));
    }
}
