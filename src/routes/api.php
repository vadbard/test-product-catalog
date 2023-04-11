<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

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

Route::get('/categories', [CategoryController::class, 'getTree']);
Route::get('/categories/{categoryId}', [CategoryController::class, 'getOne']);
Route::patch('/categories/{categoryId}', [CategoryController::class, 'updateOne'])->name('categories.updateCategory');

Route::get('/products', [ProductController::class, 'getListByCategory']);
Route::get('/products/search', [ProductController::class, 'search']);
Route::get('/products/{productId}', [ProductController::class, 'getOne']);
