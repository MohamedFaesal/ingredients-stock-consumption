<?php

namespace App\Services;

use App\Events\IngredientStockEvent;
use App\Models\Order;
use App\Models\Product;
use http\Exception\InvalidArgumentException;
use Illuminate\Support\Facades\DB;

class OrderService extends AbstractService
{
    private IngredientService $ingredientService;

    public function __construct(IngredientService $ingredientService)
    {
        $this->ingredientService = $ingredientService;
    }

    public function order(array $data)
    {
        if (!$this->ingredientService->validateIfThereAreEnoughIngredients($data)) {
            throw new \Exception("There's no enough Ingredients");
        }
        $orderTotalPrice = 0;
        try {
            DB::beginTransaction();
            $order = Order::create(['total' => 0]);
            $orderProducts = [];
            foreach ($data as $item) {
                $product = Product::find($item['product_id']);
                $productPrice = $product->price * $item['quantity'];
                $orderTotalPrice += $productPrice;
                $orderProducts[] = [
                    'order_id' => $order->id,
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity'],
                    'price' => $productPrice
                ];
            }
            DB::table('order_details')->insert($orderProducts);
            Order::find($order->id)->update(['total' => $orderTotalPrice]);
            $requiredIngredients = $this->ingredientService->getRequiredIngredients($data);
            $this->ingredientService->deductOrderIngredientsFromStock($requiredIngredients);
            event(new IngredientStockEvent(array_keys($requiredIngredients)));
            DB::commit();

        } catch (\Exception $e) {
            DB::rollBack();
        }
        return Order::find($order->id);
    }
}