<?php

namespace Database\Seeders;

use App\Models\Ingredient;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IngredientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('ingredients')->insert(
            [
                [
                    'id' => 1,
                    'name' => 'Beef',
                    'full_stock' => 20000,
                    'current_stock' => 20000,
                ],
                [
                    'id' => 2,
                    'name' => 'Cheese',
                    'full_stock' => 5000,
                    'current_stock' => 5000,
                ],
                [
                    'id' => 3,
                    'name' => 'Onion',
                    'full_stock' => 1000,
                    'current_stock' => 1000,
                ],
                [
                    'id' => 4,
                    'name' => 'Chicken',
                    'full_stock' => 15000,
                    'current_stock' => 15000,
                ],
                [
                    'id' => 5,
                    'name' => 'Fish',
                    'full_stock' => 10000,
                    'current_stock' => 10000,
                ]
            ]
        );
    }
}
