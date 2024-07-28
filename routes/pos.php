<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('pos', function () {
    return view('scene::pos.index');
})->name('pos');

Route::get('/products', [ProductController::class, "index"])->name('products');
Route::get('/products/create', [ProductController::class, "create"])->name('add.product');
Route::post('/products', [ProductController::class, "store"])->name('store.product');

Route::get('/orders', function () {
    return view('scene::orders.index');
})->name('orders');
