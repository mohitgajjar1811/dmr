<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\Admin\DashboardController;

// Frontend Routes
Route::get('/', [FrontendController::class, 'index'])->name('home');
Route::get('/about', [FrontendController::class, 'about'])->name('about');
Route::get('/products', [FrontendController::class, 'productList'])->name('products');
Route::get('/products/{slug}', [FrontendController::class, 'productDetail'])->name('product.detail');
Route::get('/contact', [FrontendController::class, 'contact'])->name('contact');

// Cart Routes
use App\Http\Controllers\CartController;
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::get('/checkout', [CartController::class, 'checkout'])->name('checkout');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::patch('/cart/update', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');

// Default auth redirect
Route::get('/login', function () {
    return redirect()->route('admin.login'); })->name('login');

// Dashboard Routes
Route::prefix('dashboard')->name('admin.')->group(function () {
    Route::get('/login', function () {
        return view('admin.login'); })->name('login');
    Route::post('/login', [DashboardController::class, 'authenticate'])->name('login.post');
    Route::match(['get', 'post'], '/logout', [DashboardController::class, 'logout'])->name('logout');

    Route::middleware(['auth'])->group(function () {
        Route::get('/', [DashboardController::class, 'home'])->name('home');
        Route::get('/products', [DashboardController::class, 'productList'])->name('product.list');
        Route::get('/products/create', [DashboardController::class, 'productCreate'])->name('product.create');
        Route::post('/products', [DashboardController::class, 'productStore'])->name('product.store');
        Route::get('/products/{id}/edit', [DashboardController::class, 'productEdit'])->name('product.edit');
        Route::post('/products/{id}', [DashboardController::class, 'productUpdate'])->name('product.update');
        Route::delete('/products/{id}', [DashboardController::class, 'productDelete'])->name('product.delete');
        Route::get('/enquiries', [DashboardController::class, 'enquiryList'])->name('enquiry.list');
        Route::delete('/enquiries/{id}', [DashboardController::class, 'enquiryDelete'])->name('enquiry.delete');
        Route::get('/banners', [DashboardController::class, 'bannerList'])->name('banner.list');
        Route::get('/banners/create', [DashboardController::class, 'bannerCreate'])->name('banner.create');
        Route::post('/banners', [DashboardController::class, 'bannerStore'])->name('banner.store');
        Route::get('/banners/{id}/edit', [DashboardController::class, 'bannerEdit'])->name('banner.edit');
        Route::post('/banners/{id}', [DashboardController::class, 'bannerUpdate'])->name('banner.update');
        Route::delete('/banners/{id}', [DashboardController::class, 'bannerDelete'])->name('banner.delete');

        Route::get('/features', [DashboardController::class, 'featureList'])->name('feature.list');
        Route::get('/features/create', [DashboardController::class, 'featureCreate'])->name('feature.create');
        Route::post('/features', [DashboardController::class, 'featureStore'])->name('feature.store');
        Route::get('/features/{id}/edit', [DashboardController::class, 'featureEdit'])->name('feature.edit');
        Route::post('/features/{id}', [DashboardController::class, 'featureUpdate'])->name('feature.update');
        Route::delete('/features/{id}', [DashboardController::class, 'featureDelete'])->name('feature.delete');

        Route::get('/settings', [DashboardController::class, 'siteSettings'])->name('settings.site');
        Route::post('/settings', [DashboardController::class, 'siteSettingsUpdate'])->name('settings.site.update');
        Route::get('/smtp', [DashboardController::class, 'smtpSettings'])->name('settings.smtp');
        Route::post('/smtp', [DashboardController::class, 'smtpSettingsUpdate'])->name('settings.smtp.update');

        Route::get('/newsletter', [DashboardController::class, 'newsletterList'])->name('newsletter.list');
        Route::delete('/newsletter/{id}', [DashboardController::class, 'newsletterDelete'])->name('newsletter.delete');
        
        // Home Page Content
        Route::get('/home-content', [DashboardController::class, 'homeContent'])->name('home.content');
        Route::post('/home-content', [DashboardController::class, 'homeContentUpdate'])->name('home.content.update');

        // About Page Content
        Route::get('/about-content', [DashboardController::class, 'aboutContent'])->name('about.content');
        Route::post('/about-content', [DashboardController::class, 'aboutContentUpdate'])->name('about.content.update');
        
        Route::get('/leads', [DashboardController::class, 'leadList'])->name('lead.list');
        Route::post('/upload-image', [DashboardController::class, 'uploadImage'])->name('upload.image');
    });
});
