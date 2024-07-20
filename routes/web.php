<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    HomeController, 
    CategoryController, 
    ProductController,
    CartController
};

use App\Http\Controllers\Auth\RegisterController;
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
Route::get("/products/{id}", [ProductController::class, "show"])->name("products.detail");
Route::get("/cart", [CartController::class, "index"])->name("detail");
Route::delete("/cart/{id}", [CartController::class, "delete"])->name("cart-delete");
Route::post("/checkout", [CartController::class, "delete"])->name("checkout");
Route::get("/success", [CartController::class, "success"])->name("checkout-success");
Route::get("/register/success", [RegisterController::class, "success"])->name("register-success");

Route::get("/api-provinces", [ProductController::class, "apiProvinces"])->name("api-provinces");
Route::get("/api-regencies", [ProductController::class, "apiRgencies"])->name("api-regencies");


