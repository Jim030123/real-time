<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\productController;
use App\Http\Controllers\updateStatusController;
use  App\Http\Controllers\cartController;
use  App\Http\Controllers\OrderController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get("userProducts",[productController::class,"userIndex"])->name("products.index");
Route::get("products",[productController::class,"index"])->name("products.index");
Route::get("/updateStatus",[updateStatusController::class,"index"])->name("productUpdate");
Route::post("products",[productController::class,"store"])->name("products.store");
Route::post('/cart/addToCart', [CartController::class, 'addToCart'])->name('addToCart.add');
Route::get('/myCart', function () {
    $cartItems = \App\Models\Cart::with('product')->where('user_id', auth()->id())->get();
    return view('myCart', compact('cartItems'));
})->name('my.cart');

Route::post('/place-order', [CartController::class, 'placeOrder'])->name('place.order');

Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
Route::get('/manageOrders', [OrderController::class, 'adminIndex'])->name('admin.orders');
Route::post('/admin/orders/{id}/status', [OrderController::class, 'updateStatus'])->name('admin.orders.update');