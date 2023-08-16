<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// registration
Route::post('register', [RegistrationController::class, 'store']);
Route::get('register', [RegistrationController::class, 'create']);

// login
Route::get('login', [LoginController::class, 'create']);
Route::post('login', [LoginController::class, 'store']);

// products
Route::get('products', [ProductController::class, 'products']);
Route::get('product/{id}', [ProductController::class, 'product']);

// cart
Route::get('cart', [CartController::class, 'cart']);
Route::get('viewCart', [CartController::class, 'viewCart'])->name('cart.viewCart');

Route::post('addToCart', [CartController::class, 'addToCart'])->name('cart.add');