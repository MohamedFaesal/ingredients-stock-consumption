<?php

namespace App\Services;

use App\Models\Product;

class ProductService extends AbstractService
{
    public function getProducts()
    {
        return Product::all();
    }
}