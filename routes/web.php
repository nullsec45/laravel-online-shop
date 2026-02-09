<?php


use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\LocationControlller;
use App\Http\Controllers\ReviewController;
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
    DetailController,
    SocialiteController
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

// Global
Route::get("/", [HomeController::class, "index"])->name("home");

Route::get("categories", [CategoryController::class, "index"])->name("categories.index");
Route::get("categories/{slug}", [CategoryController::class, "show"])->name("categories.show");
Route::get("products/{slug}", [DetailController::class, "ShowProduct"])->name("products.show");


Route::get("success", [CartController::class, "success"])->name("checkout-success");


// Auth
Route::get("register/success", [RegisterController::class, "success"])->name("register-success");
Route::get("register/check", [RegisterController::class, "check"])->name("api-register-check");
Route::get("register/check-registered", [RegisterController::class, "checkRegistered"])->name("api-check-registered");
Route::get("forgot-password", [ForgotPasswordController::class, "index"])->name("forgot-password");
Route::post("forgot-password/send-token", [ForgotPasswordController::class, "sendToken"])->name("forgot-password-send-token");
Route::get("forgot-password/reset-password-form/{email}/{token}", [ForgotPasswordController::class, "resetPasswordForm"])->name("forgot-password-reset-password-form");
Route::put("forgot-password/reset-password/{email}/{token}", [ForgotPasswordController::class, "resetPassword"])->name("forgot-password-reset-password");


Route::get('/auth/{provider}', [SocialiteController::class, 'redirectToProvider'])->name('auth.provider');
Route::get('/auth/{provider}/callback', [SocialiteController::class, 'handleProvideCallback']);

Route::get("provinces", [LocationControlller::class, "provinces"])->name("api-provinces");
Route::get("regencies/{province_id}", [LocationControlller::class, "regencies"])->name("api-regencies");

Route::group(["middleware" => "auth"], function () {
    Route::get("cart", [CartController::class, "index"])->name("cart");
    Route::post("cart/{id}", [CartController::class, "add"])->name("cart-add");
    Route::delete("cart/{id}", [CartController::class, "delete"])->name("cart-delete");

    Route::post("checkout", [CheckoutController::class, "proccess"])->name("checkout");
    Route::post("checkout/callback", [CheckoutController::class, "callback"])->name("midtrans-callback");
    Route::post("products/review/{id}", [ReviewController::class, "store"])->name("add-reviews");
    Route::delete("products/review/{id}/{productId}", [ReviewController::class, "destroy"])->name("delete-review");
});

// Admin
Route::group(["middleware" => "admin"], function () {
    Route::prefix("admin")->name("admin.")->group(function () {
        Route::get("dashboard", [AdminDashboardController::class, "index"])->name("dashboard");
        Route::resource("categories", AdminCategoryController::class)->except("show");
        Route::resource("users", UserController::class);
        Route::resource("products", ProductController::class);
        Route::resource("product-galleries", ProductGalleryController::class);
    });
});

// User
Route::group(["middleware" => "user"], function () {
    Route::get("/dashboard", [DashboardController::class, "index"])->name("dashboard.index");
    Route::prefix("dashboard")->name("dashboard.")->group(function () {
        Route::post("products/gallery/upload", [DashboardProductController::class, "uploadGallery"])->name("products-gallery-upload");
        Route::delete("products/gallery/delete/{id}", [DashboardProductController::class, "deleteGallery"])->name("products-gallery-delete");
        Route::resource("products", DashboardProductController::class);
        Route::resource("transactions", DashboardTransactionController::class);
        Route::prefix("settings")->name("settings.")
            ->controller(DashboardSettingController::class)
            ->group(function () {
                Route::get("store", "store")->name("store");
                Route::put("store/update/{redirect}", "update")->name("store-update");
                Route::get("account", "account")->name("account");
                Route::put("account/update/{redirect}", "update")->name("account-update");
            });
    });
});
