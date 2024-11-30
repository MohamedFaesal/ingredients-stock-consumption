<?php

namespace Database\Seeders;

use App\Models\Ingredient;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $product = Product::create([
            'id' => 1,
            'name' => 'Beef Burger',
            'price' => 30
        ]);
        DB::table('product_ingredients')->insert([
            [
                'product_id' => $product->id,
                'ingredient_id' => 1,
                'amount' => 150
            ],
            [
                'product_id' => $product->id,
                'ingredient_id' => 2,
                'amount' => 30
            ],
            [
                'product_id' => $product->id,
                'ingredient_id' => 3,
                'amount' => 20
            ]
        ]);

        $product = Product::create([
            'id' => 2,
            'name' => 'Chicken Burger',
            'price' => 25
        ]);
        DB::table('product_ingredients')->insert([
            [
                'product_id' => $product->id,
                'ingredient_id' => 4,
                'amount' => 250
            ],
            [
                'product_id' => $product->id,
                'ingredient_id' => 2,
                'amount' => 20
            ],
            [
                'product_id' => $product->id,
                'ingredient_id' => 3,
                'amount' => 20
            ]
        ]);

        $product = Product::create([
            'id' => 3,
            'name' => 'Chicken Sandwich',
            'price' => 40
        ]);
        DB::table('product_ingredients')->insert([
            [
                'product_id' => $product->id,
                'ingredient_id' => 5,
                'amount' => 400
            ],
            [
                'product_id' => $product->id,
                'ingredient_id' => 2,
                'amount' => 40
            ],
            [
                'product_id' => $product->id,
                'ingredient_id' => 3,
                'amount' => 30
            ]
        ]);

    }
}
