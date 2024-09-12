<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\{
    DashboardController as AdminDashboardController, 
    CategoryController as AdminCategoryController,
    UserController,
    ProductController,
    ProductGalleryController
};

use App\Http\Controllers\{
    HomeController, 
    CategoryController, 
    CartController,
    DashboardController,
    DashboardProductController,
    DashboardTransactionController,
    DashboardSettingController,
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

Auth::routes();

Route::get("/", [HomeController::class, "index"])->name("home");

// Route::get("/categories", [CategoryController::class, "index"])->name("categories");
// Route::get("/categories-detail", [CategoryController::class, "show"])->name("categories-detail");

Route::get("categories",[CategoryController::class,"index"])->name("categories.index");
Route::get("categories/{slug}",[CategoryController::class,"show"])->name("categories.show");
Route::get("/products/{id}", [ProductController::class, "show"])->name("products.show");
Route::get("/cart", [CartController::class, "index"])->name("cart");
Route::delete("/cart/{id}", [CartController::class, "delete"])->name("cart-delete");
Route::post("/checkout", [CartController::class, "delete"])->name("checkout");
Route::get("/success", [CartController::class, "success"])->name("checkout-success");
Route::get("/register/success", [RegisterController::class, "success"])->name("register-success");

Route::get("/api-provinces", [ProductController::class, "apiProvinces"])->name("api-provinces");
Route::get("/api-regencies", [ProductController::class, "apiRgencies"])->name("api-regencies");
Route::get("/api-register-check", [RegisterController::class, "registerCheck"])->name("api-register-check");

Route::get("/dashboard", [DashboardController::class,"index"])->name("dashboard.index");

Route::prefix("dashboard")->name("dashboard.")->group(function(){
    Route::resource("products",DashboardProductController::class);
    Route::resource("transactions",DashboardTransactionController::class);
    Route::prefix("settings")->name("settings.")->controller(DashboardSettingController::class)->group(function(){
        Route::get("account","account")->name("account");
        Route::get("redirect","redirect")->name("redirect");
        Route::get("store","store")->name("store");
    });
});

Route::prefix("admin")->name("admin.")->group(function(){
    Route::get("dashboard",[AdminDashboardController::class,"index"])->name("dashboard");
    Route::resource("categories", AdminCategoryController::class);
    Route::resource("users",UserController::class);
    Route::resource("products",ProductController::class);
    Route::resource("product-galleries",ProductGalleryController::class);
});