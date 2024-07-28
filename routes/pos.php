<?php

use App\Http\Controllers\PosController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('pos', [PosController::class, "index"])->name('pos');
Route::get('pos/product/item/{id}', [PosController::class, "getProduct"])->name('pos.product.item');

Route::get('/products', [ProductController::class, "index"])->name('products');
Route::get('/products/create', [ProductController::class, "create"])->name('add.product');
Route::post('/products', [ProductController::class, "store"])->name('store.product');


Route::get('/orders', function () {
    return view('scene::orders.index');
})->name('orders');
