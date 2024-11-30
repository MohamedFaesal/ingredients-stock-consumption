<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $products = [];
        foreach ($this->details as $item) {
            $product = $item->product;
            $products[] = [
                'id' => $product->id,
                'name' => $product->name,
                'quantity' => $item->quantity,
                'price' => $item->price
            ];
        }
        return [
            'id' => $this->id,
            'total' => $this->total,
            'products' => $products
        ];
    }
}
