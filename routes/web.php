<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', [App\Http\Controllers\WebController::class,"home"]);

Route::get('about-us', [App\Http\Controllers\WebController::class,"aboutUs"] );

//product
Route::get('/admin/product', [App\Http\Controllers\Admin\ProductController::class,"listAll"]);
Route::get('/admin/product/create', [App\Http\Controllers\Admin\ProductController::class,"createForm"]);
Route::post('/admin/product/create', [App\Http\Controllers\Admin\ProductController::class,"store"]);
Route::get('/admin/product/edit/{product}', [App\Http\Controllers\Admin\ProductController::class,"editForm"]);
Route::post('/admin/product/edit/{product}', [App\Http\Controllers\Admin\ProductController::class,"update"]);

//category
Route::get('/admin/category', [App\Http\Controllers\Admin\CategoryController::class, "caList"]);
Route::get('/admin/category/create', [App\Http\Controllers\Admin\CategoryController::class, "caCreate"]);
Route::post('/admin/category/create', [App\Http\Controllers\Admin\CategoryController::class, "caSave"]);

