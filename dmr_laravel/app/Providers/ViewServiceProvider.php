<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\CompanyInfo;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {
            $view->with('company_info', CompanyInfo::first());
            
            $cart = session()->get('cart', []);
            $cartCount = array_sum(array_column($cart, 'quantity'));
            $view->with('cart_items_count', $cartCount);
        });
    }
}
