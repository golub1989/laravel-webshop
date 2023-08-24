<?php

use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\UserController;


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

// logout
Route::get('logout', [LoginController::class, 'logout']);

// products
Route::get('products', [ProductController::class, 'products']);
// match single product 
Route::get('product/{id}', [ProductController::class, 'product']);

// cart
Route::get('cart', [CartController::class, 'cart']);
Route::get('viewCart', [CartController::class, 'viewCart'])->name('cart.viewCart');
Route::get('cart/destroy/{cartItemId}', [CartController::class, 'destroy'])->name('cart.destroy');
Route::get('cart/clear', [CartController::class, 'clear'])->name('cart.clear');
Route::post('addToCart', [CartController::class, 'addToCart'])->name('cart.add');

// account
Route::get('account', [UserController::class, 'account']);

// checkout
Route::get('checkout', [OrderController::class, 'checkout']);
Route::get('show', [OrderController::class, 'show']);