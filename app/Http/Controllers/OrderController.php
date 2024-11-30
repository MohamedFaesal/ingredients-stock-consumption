<?php
namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Http\Resources\OrderResource;
use App\Http\Resources\ProductResource;
use App\Services\OrderService;
use App\Services\ProductService;

class OrderController extends Controller
{
    private OrderService $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function order(OrderRequest $orderRequest)
    {
        $data = $orderRequest->all();
        $order = $this->orderService->order($data['products']);

        return new OrderResource($order);
    }
}