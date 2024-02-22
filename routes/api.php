<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\UserController;
use \App\Http\Controllers\ProductController;

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
Route::put('/update-product', [ProductController::class, 'updateProduct'])->name('product.update');
Route::delete('/delete-product', [ProductController::class, 'deleteProduct'])->name('product.delete');

Route::post('/login', [UserController::class, 'login'])->name('user.login');
Route::post('/register', [UserController::class, 'register'])->name('user.register');

Route::group([
    "middleware" => ["auth:sanctum"]
], function () {
    Route::post('/logout', [UserController::class, 'logout'])->name('user.logout');
});
