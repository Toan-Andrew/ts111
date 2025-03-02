<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\RateController;
use App\Http\Controllers\SuggestionController;
use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\AuthMiddleware;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Đây là các route chính của ứng dụng.
|
*/

Route::get('welcome', function () {return view('welcome'); })->name('welcome');



// Public routes (khách hàng có thể duyệt sản phẩm mà không cần đăng nhập)
Route::get('/', [ProductController::class, 'index'])->name('products.index');
Route::get('products/{id}', [ProductController::class, 'show'])->name('products.show');

// Auth routes
Route::get('login', [AuthController::class, 'index'])->name('login');
Route::post('post-login', [AuthController::class, 'postLogin'])->name('login.post'); 
Route::get('registration', [AuthController::class, 'registration'])->name('register');
Route::post('post-registration', [AuthController::class, 'postRegistration'])->name('register.post'); 
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

// Các route profile (không cần đăng nhập để xem sản phẩm, nhưng xem profile cần đăng nhập)
Route::get('profile', [UserController::class, 'profile'])->name('profile')->middleware('auth');
Route::put('profile', [UserController::class, 'updateProfile'])->name('profile.update')->middleware('auth');
Route::get('products/showdetail2/{id}', [ProductController::class, 'showdetail2'])->name('products.showdetail2');
// Góp ý (không yêu cầu đăng nhập)
Route::post('suggestions', [SuggestionController::class, 'store'])->name('suggestions.store')->middleware('auth');


// Các route cần đăng nhập (bảo vệ bởi AuthMiddleware)
Route::middleware([AuthMiddleware::class])->group(function () {

    // Product routes (cho admin quản lý sản phẩm)
    Route::get('products/admin', [ProductController::class, 'admin'])->name('products.admin');
    //Route::get('products/showdetail2/{id}', [ProductController::class, 'showdetail2'])->name('products.showdetail2');
    Route::post('products/{id}/buy', [ProductController::class, 'buy'])->name('products.buy');
    Route::resource('products', ProductController::class);

    // Order routes (cho admin quản lý đơn hàng)
    Route::get('orders', [OrderController::class, 'index'])->name('orders.index');
    Route::delete('orders/{id}', [OrderController::class, 'destroy'])->name('orders.destroy');
    Route::get('orders/search', [OrderController::class, 'search'])->name('orders.search');
    Route::put('/orders/{order}', [OrderController::class, 'update'])->name('orders.update');

    // Category routes
    Route::get('/categories/{categoryId}/create/product', [CategoryController::class, 'createProduct'])->name('categories.createProduct');
    Route::resource('categories', CategoryController::class);
    Route::get('categories/{categoryId}/showProducts', [CategoryController::class, 'showProducts'])->name('categories.showProducts');
    Route::post('/categories/{categoryId}/products', [CategoryController::class, 'storeProduct'])->name('categories.storeProduct');
    Route::put('categories/{id}', [CategoryController::class, 'update'])->name('categories.update');

    // Suggestion routes (cho admin quản lý góp ý)
    Route::get('suggestions/search', [SuggestionController::class, 'search'])->name('suggestions.search');

    // Cart routes (chỉ cho phép khách hàng đã đăng nhập thao tác giỏ hàng)
    Route::post('cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
    Route::get('cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');

    // Route đặt hàng trực tiếp (mua ngay)
    Route::post('/products/buy/{id}', [OrderController::class, 'store'])->name('products.buy');

    // User routes (cho admin quản lý người dùng)
    Route::get('/user', [UserController::class, 'index']);
});
