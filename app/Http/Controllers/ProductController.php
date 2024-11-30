<?php
namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Services\ProductService;

class ProductController extends Controller
{
    private ProductService $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function listProducts()
    {
        return ProductResource::collection($this->productService->getProducts());
    }
}