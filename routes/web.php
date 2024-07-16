<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{HomeController, CategoryController, ProductController};
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

// Route::get('/', function () {
//     return view('welcome');
// });

// Auth::routes();

Route::get("/", [HomeController::class, "index"])->name("home");

Route::get("/categories", [CategoryController::class, "index"])->name("categories");
Route::get("/categories-detail", [CategoryController::class, "show"])->name("categories-detail");
Route::get("/products-detail", [ProductController::class, "show"])->name("products-detail");
