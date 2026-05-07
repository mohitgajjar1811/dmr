<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Enquiry;
use App\Models\Banner;
use App\Models\NewsletterSubscriber;
use App\Models\CompanyInfo;
use App\Models\HomePageContent;
use App\Models\SMTPSettings;
use App\Models\HomeFeature;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $remember = $request->has('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            return redirect()->intended(route('admin.home'));
        }

        return back()->withErrors([
            'username' => 'The provided credentials do not match our records.',
        ])->onlyInput('username');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.login');
    }

    public function home()
    {
        $stats = [
            'total_products' => Product::count(),
            'newsletter_count' => NewsletterSubscriber::count(),
            'total_banners' => Banner::count(),
            'new_enquiries' => Enquiry::where('is_read', false)->where('message', 'not like', 'Downloaded%')->count(),
            'total_leads' => Enquiry::where('message', 'like', 'Downloaded%')->count(),
        ];

        return view('admin.home', compact('stats'));
    }

    public function productList(Request $request)
    {
        $query = Product::orderBy('created_at', 'desc');

        if ($request->q) {
            $query->where('name', 'like', '%' . $request->q . '%');
        }
        if ($request->status !== null) {
            $query->where('is_active', $request->status);
        }

        $products = $query->paginate(20);

        return view('admin.catalog.product_list', compact('products'));
    }

    public function enquiryList()
    {
        $enquiries = Enquiry::where('message', 'not like', 'Downloaded%')->orderBy('created_at', 'desc')->paginate(20);
        return view('admin.leads.enquiry_list', compact('enquiries'));
    }

    public function leadList()
    {
        $leads = Enquiry::where('message', 'like', 'Downloaded%')->orderBy('created_at', 'desc')->paginate(20);
        return view('admin.leads.lead_list', compact('leads'));
    }

    public function bannerList()
    {
        $banners = Banner::orderBy('id', 'desc')->paginate(20);
        return view('admin.content.banner_list', compact('banners'));
    }

    public function bannerCreate()
    {
        return view('admin.content.banner_create');
    }

    public function bannerStore(Request $request)
    {
        $request->validate([
            'image' => 'required|image|max:2048',
        ]);

        $banner = new Banner();
        $banner->order = $request->order ?? 0;
        $banner->is_active = $request->has('is_active');

        if ($request->hasFile('image')) {
            $banner->image = $request->file('image')->store('banners', 'public');
        }

        $banner->save();

        return redirect()->route('admin.banner.list')->with('success', 'Banner created successfully.');
    }

    public function bannerEdit($id)
    {
        $banner = Banner::findOrFail($id);
        return view('admin.content.banner_edit', compact('banner'));
    }

    public function bannerUpdate(Request $request, $id)
    {
        $request->validate([
            'image' => 'nullable|image|max:2048',
        ]);

        $banner = Banner::findOrFail($id);
        $banner->order = $request->order ?? 0;
        $banner->is_active = $request->has('is_active');

        if ($request->hasFile('image')) {
            $banner->image = $request->file('image')->store('banners', 'public');
        }

        $banner->save();

        return redirect()->route('admin.banner.list')->with('success', 'Banner updated successfully.');
    }

    public function bannerDelete($id)
    {
        $banner = Banner::findOrFail($id);
        $banner->delete();
        return redirect()->route('admin.banner.list')->with('success', 'Banner deleted successfully.');
    }

    public function newsletterList()
    {
        $subscribers = NewsletterSubscriber::orderBy('subscribed_at', 'desc')->paginate(50);
        return view('admin.leads.newsletter_list', compact('subscribers'));
    }

    public function productCreate()
    {
        return view('admin.catalog.product_create');
    }

    public function productStore(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'description' => 'nullable',
            'main_image' => 'nullable|image|max:2048',
            'pdf_brochure' => 'nullable|mimes:pdf|max:10240',
        ]);

        $product = new Product();
        $product->name = $request->name;
        $product->description = $request->description;
        $product->is_active = $request->has('is_active');
        $product->is_featured = $request->has('is_featured');

        if ($request->hasFile('main_image')) {
            $product->main_image = $request->file('main_image')->store('products', 'public');
        }

        if ($request->hasFile('pdf_brochure')) {
            $product->pdf_brochure = $request->file('pdf_brochure')->store('brochures', 'public');
        }

        $product->save();

        return redirect()->route('admin.product.list')->with('success', 'Product created successfully.');
    }

    public function productEdit($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.catalog.product_edit', compact('product'));
    }

    public function productUpdate(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:255',
            'description' => 'nullable',
            'main_image' => 'nullable|image|max:2048',
            'pdf_brochure' => 'nullable|mimes:pdf|max:10240',
        ]);

        $product = Product::findOrFail($id);
        $product->name = $request->name;
        $product->description = $request->description;
        $product->is_active = $request->has('is_active');
        $product->is_featured = $request->has('is_featured');

        if ($request->hasFile('main_image')) {
            $product->main_image = $request->file('main_image')->store('products', 'public');
        }

        if ($request->hasFile('pdf_brochure')) {
            $product->pdf_brochure = $request->file('pdf_brochure')->store('brochures', 'public');
        }

        $product->save();

        return redirect()->route('admin.product.list')->with('success', 'Product updated successfully.');
    }

    public function productDelete($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->route('admin.product.list')->with('success', 'Product deleted successfully.');
    }

    public function enquiryDelete($id)
    {
        $enquiry = Enquiry::findOrFail($id);
        $enquiry->delete();
        return back()->with('success', 'Enquiry deleted successfully.');
    }

    public function newsletterDelete($id)
    {
        $subscriber = NewsletterSubscriber::findOrFail($id);
        $subscriber->delete();
        return back()->with('success', 'Subscriber removed successfully.');
    }

    public function featureList()
    {
        $features = HomeFeature::orderBy('order')->get();
        return view('admin.content.feature_list', compact('features'));
    }

    public function featureCreate()
    {
        return view('admin.content.feature_create');
    }

    public function featureStore(Request $request)
    {
        $request->validate(['title' => 'required|max:255', 'icon' => 'required']);
        HomeFeature::create($request->all());
        return redirect()->route('admin.feature.list')->with('success', 'Feature added successfully.');
    }

    public function featureEdit($id)
    {
        $feature = HomeFeature::findOrFail($id);
        return view('admin.content.feature_edit', compact('feature'));
    }

    public function featureUpdate(Request $request, $id)
    {
        $request->validate(['title' => 'required|max:255', 'icon' => 'required']);
        $feature = HomeFeature::findOrFail($id);
        $feature->update($request->all());
        return redirect()->route('admin.feature.list')->with('success', 'Feature updated successfully.');
    }

    public function featureDelete($id)
    {
        HomeFeature::findOrFail($id)->delete();
        return back()->with('success', 'Feature deleted.');
    }

    public function siteSettings()
    {
        $settings = CompanyInfo::first() ?? new CompanyInfo();
        return view('admin.settings.site_settings', compact('settings'));
    }

    public function siteSettingsUpdate(Request $request)
    {
        $settings = CompanyInfo::first() ?? new CompanyInfo();
        $data = $request->all();

        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')->store('settings', 'public');
        }
        if ($request->hasFile('favicon')) {
            $data['favicon'] = $request->file('favicon')->store('settings', 'public');
        }

        $settings->fill($data)->save();
        return back()->with('success', 'Site settings updated.');
    }

    public function smtpSettings()
    {
        $settings = SMTPSettings::first() ?? new SMTPSettings();
        return view('admin.settings.smtp_settings', compact('settings'));
    }

    public function smtpSettingsUpdate(Request $request)
    {
        $settings = SMTPSettings::first() ?? new SMTPSettings();
        $settings->fill($request->all())->save();
        return back()->with('success', 'SMTP settings updated.');
    }
}
