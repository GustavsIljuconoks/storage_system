<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\UserController;
use \App\Http\Controllers\ProductController;
use \App\Http\Controllers\OrderController;
use \App\Http\Controllers\ShelfController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/get-products', [ProductController::class, 'getProducts'])->name('products.all');
Route::post('/add-product', [ProductController::class, 'addProduct'])->name('product.delete');
Route::put('/update-product/{id}', [ProductController::class, 'updateProduct'])->name('product.update');
Route::delete('/delete-product', [ProductController::class, 'deleteProduct'])->name('product.delete');
Route::get('/get-products/{id}', [ProductController::class, 'productDetails'])->name('product.delete');
Route::get('/log-products', [ProductController::class, 'logProducts'])->name('order.products');

Route::post('/make-order', [OrderController::class, 'makeOrder'])->name('order.make');
Route::get('/get-categories', [OrderController::class, 'getCategories'])->name('order.category');
Route::get('/get-orders', [OrderController::class, 'getOrders'])->name('order.category');
Route::post('/get-product', [OrderController::class, 'getProducts'])->name('order.products');
Route::post('/get-manufacturer', [OrderController::class, 'getManufactures'])->name('order.manufacturers');
Route::put('/change-order-status', [OrderController::class, 'changeOrderStatus'])->name('order.status');
Route::delete('/delete-order', [OrderController::class, 'deleteOrder'])->name('order.destroy');
Route::get('/pending-order', [OrderController::class, 'getPendingOrders'])->name('order.pending');
Route::get('/delivered-order', [OrderController::class, 'getDeliveredOrders'])->name('order.pending');
Route::get('/log-order', [OrderController::class, 'logOrder'])->name('order.log');

Route::post('/login', [UserController::class, 'login'])->name('user.login');
Route::post('/register', [UserController::class, 'register'])->name('user.register');
Route::get('/get-roles', [UserController::class, 'getRoles'])->name('user.roles');
Route::get('/get-users', [UserController::class, 'getUsers'])->name('user.all');
Route::delete('/delete-user', [UserController::class, 'deleteUser'])->name('user.delete');
Route::get('/get-users/{id}', [UserController::class, 'detailsUser'])->name('user.update');
Route::put('/update-user/{id}', [UserController::class, 'updateUser'])->name('user.update');
Route::get('/log-users', [UserController::class, 'logUsers'])->name('user.logs');

Route::get('/get-shelfes', [ShelfController::class, 'getAllShelfes'])->name('shelfe.all');
Route::get('/get-product-location', [ShelfController::class, 'getProductLocation'])->name('shelfes.location');
Route::post('/put-item', [ShelfController::class, 'putItem'])->name('shelve.put');
Route::delete('/delete-item', [ShelfController::class, 'deleteItem'])->name('shelve.delete');
Route::post('/update-item', [ShelfController::class, 'updateItem'])->name('shelve.update');

Route::group([
    "middleware" => ["auth:sanctum"]
], function () {
    Route::post('/logout', [UserController::class, 'logout'])->name('user.logout');
});
