<?php

namespace App\Services;

use App\Events\IngredientStockShortageMailEvent;
use App\Models\Ingredient;
use App\Models\Product;

class IngredientService extends AbstractService
{
    public function validateOnIngredientShortage($ingredients)
    {
        foreach ($ingredients as $ingredient) {
            $ing = Ingredient::find($ingredient);
            if (!$ing->need_refill && ($ing->full_stock/2) > $ing->current_stock) {
                $ing->update(['need_refill' => true]);
                // send mail
                try {
                    event(new IngredientStockShortageMailEvent($ing));
                } catch (\Exception $e) {}
            }
        }
    }

    public function getProductIngredients($productId)
    {
        return Product::find($productId)->ingredients;
    }

    public function validateIfThereAreEnoughIngredients($data) : bool
    {
        $requiredIngredients = $this->getRequiredIngredients($data);
        foreach ($requiredIngredients as $ingredientId => $requiredIngredient ) {
            $requiredValue = $requiredIngredient['required_grams'] * $requiredIngredient['quantity'];
            if (
                Ingredient::where('id', $ingredientId)
                    ->where('current_stock', '>=', $requiredValue)
                    ->count() == 0
            ) {
                return false;
            }
        }
        return true;
    }

    public function deductOrderIngredientsFromStock($ingredients)
    {
        foreach ($ingredients as $ingredientId => $requiredIngredient ) {
            $ingredient = Ingredient::find($ingredientId);
            $newStock = $ingredient->current_stock - $requiredIngredient['required_grams'] * $requiredIngredient['quantity'];
            $ingredient->update([
                'current_stock' => $newStock
            ]);
        }
    }

    public function getRequiredIngredients($data) {
        $requiredIngredients = [];
        foreach ($data as $item) {
            $ingredients = $this->getProductIngredients($item['product_id']);
            foreach ($ingredients as $ingredient) {
                if (!isset($requiredIngredients[$ingredient->id])) {
                    $requiredIngredients[$ingredient->id] =
                        [
                            'required_grams' => $ingredient->pivot->amount,
                            'quantity' => $item['quantity']
                        ];
                } else {
                    $requiredIngredients[$ingredient->id]['quantity'] += $item['quantity'];
                }
            }
        }
        return $requiredIngredients;
    }
}