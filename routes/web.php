<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\Admin\DashboardController;

// Frontend Routes
Route::get('/', [FrontendController::class, 'index'])->name('home');
Route::get('/about', [FrontendController::class, 'about'])->name('about');
Route::get('/products', [FrontendController::class, 'productList'])->name('products');
Route::get('/products/{slug}', [FrontendController::class, 'productDetail'])->name('product.detail');

// Dashboard Routes
Route::prefix('dashboard')->name('admin.')->group(function () {
    Route::get('/login', function() { return view('admin.login'); })->name('login');
    
    Route::middleware(['auth'])->group(function () {
        Route::get('/', [DashboardController::class, 'home'])->name('home');
        Route::get('/products', [DashboardController::class, 'productList'])->name('product.list');
        Route::get('/brands', [DashboardController::class, 'brandList'])->name('brand.list');
        // Add more dashboard routes here
    });
});
