<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\{
    DashboardController as AdminDashboardController, 
    CategoryController as AdminCategoryController
};

use App\Http\Controllers\{
    HomeController, 
    CategoryController, 
    ProductController,
    CartController,
    DashboardController,
    DashboardProductController,
    DashboardTransactionController,
    DashboardSettingController
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

Route::resource("categories",CategoryController::class);
Route::get("/products/{id}", [ProductController::class, "show"])->name("products.detail");
Route::get("/cart", [CartController::class, "index"])->name("cart");
Route::delete("/cart/{id}", [CartController::class, "delete"])->name("cart-delete");
Route::post("/checkout", [CartController::class, "delete"])->name("checkout");
Route::get("/success", [CartController::class, "success"])->name("checkout-success");
Route::get("/register/success", [RegisterController::class, "success"])->name("register-success");

Route::get("/api-provinces", [ProductController::class, "apiProvinces"])->name("api-provinces");
Route::get("/api-regencies", [ProductController::class, "apiRgencies"])->name("api-regencies");
Route::get("/api-register-check", [RegisterController::class, "registerCheck"])->name("api-register-check");
Route::get("/dashboard", [DashboardController::class,"index"])->name("dashboard.index");
Route::get("/dashboard/products", [DashboardProductController::class,"index"])->name("dashboard.products");
Route::get("/dashboard/products/create", [DashboardProductController::class, "create"])->name("dashboard.product-create");
Route::post("/dashboard/products/store", [DashboardController::class, "store"])->name("dashboard.product-store");
Route::get("/dashboard/products/{id}", [DashboardProductController::class,"detail"])->name("dashboard.products-detail");
Route::put("/dashboard/products/{id}", [DashboardProductController::class, "update"])->name("dashboard.product-update");
Route::get("/dashboard/transactions", [DashboardTransactionController::class,"index"])->name("dashboard.transactions");
Route::get("/dashboard/transactions/{id}", [DashboardTransactionController::class,"show"])->name("dashboard.transaction-details");
Route::put("/dashboard/transactions/{id}", [DashboardTransactionController::class,"update"])->name("dashboard.transaction-update");
Route::get("/dashboard/settings/store", [DashboardSettingController::class,"store"])->name("dashboard.settings-store");
Route::get("/dashboard/settings/account", [DashboardSettingController::class,"account"])->name("dashboard.settings-account");
Route::get("/dashboard/settings/redirect", [DashboardSettingController::class,"redirect"])->name("dashboard.settings-redirect");


Route::prefix("admin")->name("admin.")->group(function(){
    Route::get("/",[AdminDashboardController::class,"index"])->name("dashboard");
    Route::resource("categories", AdminCategoryController::class);
});