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
Route::get('/detail/{product}', [App\Http\Controllers\WebController::class,"detail"])->name("product_detail");
Route::post('/add_to_cart/{product}', [App\Http\Controllers\WebController::class, "addToCart"])->name("add_to_cart");
Route::get('/shopping-cart', [App\Http\Controllers\WebController::class, "shop_cart"])->name("shopping_cart");
Route::get("/checkout",[App\Http\Controllers\WebController::class,"checkout"]);
Route::post("/checkout",[App\Http\Controllers\WebController::class,"createOrder"]);
Route::get("/remove-cart/{product}",[App\Http\Controllers\WebController::class,"remove"]);

Route::get('about-us', [App\Http\Controllers\WebController::class,"aboutUs"] );

//product
Route:: middleware(["auth","admin"])->prefix("admin")->group(function (){
    Route::get("/dashboard",[App\Http\Controllers\HomeController::class,"index"]);
    Route::get('/product', [App\Http\Controllers\Admin\ProductController::class,"listAll"]);
    Route::get('/product/create', [App\Http\Controllers\Admin\ProductController::class,"createForm"]);
    Route::post('/product/create', [App\Http\Controllers\Admin\ProductController::class,"store"]);
    Route::get('/product/edit/{product}', [App\Http\Controllers\Admin\ProductController::class,"editForm"]);
    Route::post('/product/edit/{product}', [App\Http\Controllers\Admin\ProductController::class,"update"]);
    Route::post("/product/delete/{product}",[App\Http\Controllers\Admin\ProductController::class,"delete"]);

});

//category
Route::get('/admin/category', [App\Http\Controllers\Admin\CategoryController::class, "caList"]);
Route::get('/admin/category/create', [App\Http\Controllers\Admin\CategoryController::class, "caCreate"]);
Route::post('/admin/category/create', [App\Http\Controllers\Admin\CategoryController::class, "caSave"]);


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

////student
//    Route::get("/studentList", [App\Http\Controllers\Student\StudentController::class, "listStudent"]);
//    Route::get("/createStudent", [App\Http\Controllers\Student\StudentController::class, "createStudent"]);
//    Route::post("/createStudent", [App\Http\Controllers\Student\StudentController::class, "saveStudent"]);
