<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\LoginController;


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

// route for user registration
Route::post('register', [RegistrationController::class, 'store']);
Route::get('register', [RegistrationController::class, 'create']);

// route for user login
Route::get('login', [LoginController::class, 'create']);
Route::post('login', [LoginController::class, 'store']);


