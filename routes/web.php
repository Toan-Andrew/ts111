<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\AuthMiddleware;
use App\Http\Controllers\RateController;
use App\Http\Controllers\SuggestionController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('login', [AuthController::class, 'index'])->name('login');
Route::post('post-login', [AuthController::class, 'postLogin'])->name('login.post'); 
Route::get('registration', [AuthController::class, 'registration'])->name('register');
Route::post('post-registration', [AuthController::class, 'postRegistration'])->name('register.post'); 
Route::get('logout', [AuthController::class, 'logout'])->name('logout');
Route::get('profile', [UserController::class, 'profile'])->name('profile')->middleware('auth');
Route::put('profile', [UserController::class, 'updateProfile'])->name('profile.update')->middleware('auth');
Route::post('suggestions', [SuggestionController::class, 'store'])->name('suggestions.store');


Route::middleware([AuthMiddleware::class])->group(function () {
    
    
    Route::get('products/admin', [ProductController::class, 'admin'])->name('products.admin');
    Route::get('products/showdetail2/{id}', [ProductController::class, 'showdetail2'])->name('products.showdetail2');
    Route::post('products/{id}/buy', [ProductController::class, 'buy'])->name('products.buy');
    Route::get('orders', [OrderController::class, 'index'])->name('orders.index');
    Route::delete('orders/{id}', [OrderController::class, 'destroy'])->name('orders.destroy');

Route::resource('products', ProductController::class);
    // Các route chỉ dành cho admin
    Route::middleware([AuthMiddleware::class])->group(function () {
        Route::get('/categories/{categoryId}/create/product', [CategoryController::class, 'createProduct'])->name('categories.createProduct');
        Route::resource('categories', CategoryController::class);
        Route::get('categories/{categoryId}/showProducts', [CategoryController::class, 'showProducts'])->name('categories.showProducts');
        Route::post('/categories/{categoryId}/products', [CategoryController::class, 'storeProduct'])->name('categories.storeProduct');
        Route::get('orders/search', [OrderController::class, 'search'])->name('orders.search');
        // Nếu bạn muốn điều hướng đến trang hiển thị sản phẩm theo danh mục:
        Route::get('categories/{categoryId}/showProducts', [CategoryController::class, 'showProducts'])->name('categories.showProducts');
        Route::put('categories/{id}', [CategoryController::class, 'update'])->name('categories.update');
        Route::get('admin/suggestions', [SuggestionController::class, 'index'])->name('admin.suggestions.index');

        Route::get('suggestions/search', [SuggestionController::class, 'search'])->name('suggestions.search');

    });

    Route::get('/user', [UserController::class, 'index']);
});
