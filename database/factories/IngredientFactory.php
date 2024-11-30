<?php

namespace Database\Factories;

use App\Models\Ingredient;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ingredient>
 */
class IngredientFactory extends Factory
{
    protected $model = Ingredient::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'full_stock' => $this->faker->randomDigit(),
            'current_stock' => $this->faker->randomDigit(),
            'need_refill' => 0,
        ];
    }
}
