<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/******************************* Auth ******************************************* */
Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('post-login', [AuthController::class, 'postLogin'])->name('login.post');
Route::get('registration', [AuthController::class, 'registration'])->name('register');
Route::post('post-registration', [AuthController::class, 'postRegistration'])->name('register.post');


/******************************* Product ******************************************* */
Route::get('products', [ProductController::class, 'index']);


/******************************* Cart ******************************************* */
Route::get('carts', [CartController::class, 'index']);
Route::post('cart', [CartController::class, 'store']);
Route::post('cart', [CartController::class, 'store']);
Route::get('checkProductID', [CartController::class, 'checkProductID']);
Route::post('updateCart/{id}', [CartController::class, 'update']);
Route::post('deleteCart/{id}', [CartController::class, 'delete']);







