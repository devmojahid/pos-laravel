<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\PosController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PosController::class, "index"])->name('pos');
Route::get('pos/product/item/{id}', [PosController::class, "getProduct"])->name('pos.product.item');
Route::get('pos/product', [PosController::class, "getProducts"])->name('pos.product');

Route::get('/products', [ProductController::class, "index"])->name('products');
Route::get('/products/create', [ProductController::class, "create"])->name('add.product');
Route::post('/products', [ProductController::class, "store"])->name('store.product');
Route::delete('product/{product}', [ProductController::class, "destroy"])->name('delete.product');


Route::get('/orders', [OrderController::class, 'index'])->name('orders');

Route::post('/pos/order', [OrderController::class, "store"])->name('pos.order');