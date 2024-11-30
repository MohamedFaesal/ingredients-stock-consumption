<?php

use Illuminate\Support\Facades\Route;

Route::post('/order', [\App\Http\Controllers\OrderController::class, 'order']);

Route::get('/products', [\App\Http\Controllers\ProductController::class, 'listProducts']);
