<?php

namespace Tests\Unit;

use App\Events\IngredientStockEvent;
use App\Models\Ingredient;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductIngredient;
use App\Services\OrderService;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class OrderTest extends TestCase
{
    public function test_order_product_with_valid_and_sufficient_ingredients_will_place_order_successfully()
    {
        $product = Product::factory()->create();
        $in1 = Ingredient::factory()->create(['name' => 'Beef', 'full_stock' => 20000, 'current_stock' => 20000,]);
        $in2 = Ingredient::factory()->create(['name' => 'Cheese', 'full_stock' => 5000, 'current_stock' => 5000]);
        $in3 = Ingredient::factory()->create(['name' => 'Onion', 'full_stock' => 1000, 'current_stock' => 1000]);
        ProductIngredient::factory()->create(['product_id' => $product->id, 'ingredient_id' => $in1->id, 'amount' => 150],);
        ProductIngredient::factory()->create(['product_id' => $product->id, 'ingredient_id' => $in2->id, 'amount' => 30]);
        ProductIngredient::factory()->create(['product_id' => $product->id, 'ingredient_id' => $in3->id, 'amount' => 20],);

        $order = [['product_id' => $product->id, 'quantity' => 1]];
        /**
         * @var $orderService OrderService
         */
        $orderService = app()->make(OrderService::class);
        $order = $orderService->order($order);

        $this->assertDatabaseHas('orders', ['id' => $order->id, 'total' => $order->total]);
        $this->assertDatabaseHas('ingredients', ['id' => $in1->id, 'current_stock' => $in1->current_stock - 150]);
        $this->assertDatabaseHas('ingredients', ['id' => $in2->id, 'current_stock' => $in2->current_stock - 30]);
        $this->assertDatabaseHas('ingredients', ['id' => $in3->id, 'current_stock' => $in3->current_stock - 20]);

        $this->assertTrue(true);
    }

    public function test_order_product_with_valid_and_insufficient_ingredients_will_throw_exception()
    {
        $product = Product::factory()->create();
        $in1 = Ingredient::factory()->create(['name' => 'Beef', 'full_stock' => 20000, 'current_stock' => 100]);
        $in2 = Ingredient::factory()->create(['name' => 'Cheese', 'full_stock' => 5000, 'current_stock' => 5000]);
        $in3 = Ingredient::factory()->create(['name' => 'Onion', 'full_stock' => 1000, 'current_stock' => 1000]);
        ProductIngredient::factory()->create(['product_id' => $product->id, 'ingredient_id' => $in1->id, 'amount' => 150],);
        ProductIngredient::factory()->create(['product_id' => $product->id, 'ingredient_id' => $in2->id, 'amount' => 30]);
        ProductIngredient::factory()->create(['product_id' => $product->id, 'ingredient_id' => $in3->id, 'amount' => 20],);

        $order = [['product_id' => $product->id, 'quantity' => 1]];

        $this->expectException(\Exception::class);

        /**
         * @var $orderService OrderService
         */
        $orderService = app()->make(OrderService::class);
        $order = $orderService->order($order);

        $this->assertDatabaseHas('ingredients', ['id' => $in1->id, 'current_stock' => $in1->current_stock]);
        $this->assertDatabaseHas('ingredients', ['id' => $in2->id, 'current_stock' => $in2->current_stock]);
        $this->assertDatabaseHas('ingredients', ['id' => $in3->id, 'current_stock' => $in3->current_stock]);

        $this->assertTrue(true);
    }
}
