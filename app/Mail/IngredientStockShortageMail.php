<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class IngredientStockShortageMail extends Mailable
{
    use Queueable, SerializesModels;

    private $ingredient;
    public function __construct($ingredient)
    {
        $this->ingredient = $ingredient;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Ingredient Stock Shortage',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mails.ingredient-stock-shortage-mail',
            with: ['ingredient' => $this->ingredient]
        );
    }
}
