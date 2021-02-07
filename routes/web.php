<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/',[ProductController::Class,'index'])->name('products');
Route::get('/cart',[ProductController::Class,'cart'])->name('cart');
Route::get('/add-to-cart/{product}',[ProductController::Class,'addToCart'])->name('add');
Route::get('/remove/{id}',[ProductController::Class,'removeItem'])->name('remove');

