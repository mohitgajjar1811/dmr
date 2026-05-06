<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Brand;
use App\Models\Enquiry;
use App\Models\Banner;
use App\Models\NewsletterSubscriber;
use App\Models\CompanyInfo;
use App\Models\HomePageContent;
use App\Models\SMTPSettings;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function home()
    {
        $stats = [
            'total_products' => Product::count(),
            'newsletter_count' => NewsletterSubscriber::count(),
            'total_brands' => Brand::count(),
            'total_banners' => Banner::count(),
            'new_enquiries' => Enquiry::where('is_read', false)->where('message', 'not like', 'Downloaded%')->count(),
            'total_leads' => Enquiry::where('message', 'like', 'Downloaded%')->count(),
        ];

        return view('admin.home', compact('stats'));
    }

    public function productList(Request $request)
    {
        $query = Product::with('brand')->orderBy('created_at', 'desc');

        if ($request->q) {
            $query->where('name', 'like', '%' . $request->q . '%');
        }
        if ($request->brand) {
            $query->where('brand_id', $request->brand);
        }
        if ($request->status !== null) {
            $query->where('is_active', $request->status);
        }

        $products = $query->paginate(20);
        $brands = Brand::orderBy('name')->get();

        return view('admin.catalog.product_list', compact('products', 'brands'));
    }

    public function brandList(Request $request)
    {
        $query = Brand::orderBy('name');

        if ($request->q) {
            $query->where('name', 'like', '%' . $request->q . '%');
        }
        if ($request->featured !== null) {
            $query->where('is_featured', $request->featured);
        }

        $brands = $query->paginate(20);

        return view('admin.catalog.brand_list', compact('brands'));
    }
}
