<?php

use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SearchController;


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


Route::get('/', [HomeController::class, 'index'])->name('home');

// registration
Route::get('register', [RegistrationController::class, 'create']);
Route::post('register', [RegistrationController::class, 'store']);

// login
Route::get('login', [LoginController::class, 'create']);
Route::post('login', [LoginController::class, 'store']);

// logout
Route::get('logout', [LoginController::class, 'logout']);

// products
Route::get('products', [ProductController::class, 'products']);
Route::get('product/{id}', [ProductController::class, 'product']);

// cart
Route::get('cart', [CartController::class, 'cart']);
Route::get('viewCart', [CartController::class, 'viewCart'])->name('cart.viewCart');
Route::get('cart/destroy/{cartItemId}', [CartController::class, 'destroy'])->name('cart.destroy');
Route::get('cart/clear', [CartController::class, 'clear'])->name('cart.clear');
Route::post('addToCart', [CartController::class, 'addToCart'])->name('cart.add');
Route::get('cart/count', [CartController::class, 'getCartCount'])->name('cart.getCount');

Route::post('cart/change-quantity', [CartController::class, 'changeQuantity'])->name('cart.changeQuantity');

// account
Route::get('account', [UserController::class, 'account'])->name('user.account');
Route::get('account/update-password', [UserController::class, 'create']);
Route::post('update-password', [UserController::class, 'store']);

// checkout
Route::get('checkout', [OrderController::class, 'checkout'])->name('checkout');
Route::get('show', [OrderController::class, 'show'])->name('orders');

// search
Route::get('/search', [SearchController::class, 'search'])->name('search');

