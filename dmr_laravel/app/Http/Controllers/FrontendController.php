<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Banner;
use App\Models\HomePageContent;
use App\Models\AboutPageContent;
use App\Models\HomeFeature;

class FrontendController extends Controller
{
    public function index()
    {
        $banners = Banner::where('is_active', true)->orderBy('order')->get();
        $featured_products = Product::where('is_featured', true)->where('is_active', true)->take(8)->get();
        $home_content = HomePageContent::first();
        $features = HomeFeature::orderBy('order')->get();

        return view('frontend.index', compact('banners', 'featured_products', 'home_content', 'features'));
    }

    public function about()
    {
        $about_content = AboutPageContent::first();
        return view('frontend.about', compact('about_content'));
    }

    public function productList(Request $request)
    {
        $query = Product::where('is_active', true);

        // Simple search if 'q' is present
        if ($request->has('q')) {
            $query->where('name', 'like', '%' . $request->q . '%');
        }

        $all_products = Product::where('is_active', true)->select('id', 'name', 'slug')->get();
        $products = $query->paginate(12);
        
        return view('frontend.products.list', compact('products', 'all_products'));
    }

    public function productDetail($slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();
        return view('frontend.products.detail', compact('product'));
    }

    public function contact()
    {
        return view('frontend.contact');
    }
}
