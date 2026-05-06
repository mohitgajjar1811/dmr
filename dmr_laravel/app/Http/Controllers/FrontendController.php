<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Brand;
use App\Models\Banner;
use App\Models\HomePageContent;
use App\Models\HomeFeature;

class FrontendController extends Controller
{
    public function index()
    {
        $banners = Banner::where('is_active', true)->orderBy('order')->get();
        $featured_products = Product::where('is_featured', true)->where('is_active', true)->take(8)->get();
        $brands = Brand::where('is_featured', true)->take(12)->get();
        $home_content = HomePageContent::first();
        $features = HomeFeature::orderBy('order')->get();

        return view('frontend.index', compact('banners', 'featured_products', 'brands', 'home_content', 'features'));
    }

    public function about()
    {
        return view('frontend.about');
    }

    public function productList(Request $request)
    {
        $query = Product::where('is_active', true)->with('brand');
        
        if ($request->brand) {
            $query->where('brand_id', $request->brand);
        }

        $products = $query->paginate(12);
        return view('frontend.products.list', compact('products'));
    }

    public function productDetail($slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();
        return view('frontend.products.detail', compact('product'));
    }
}
