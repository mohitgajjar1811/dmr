@extends('layouts.frontend')

@section('title', 'Request Quote | DMR Metal Corporation')

@section('content')
<div class="bg-gray-50 py-12 min-h-screen">
    <div class="container mx-auto px-4 max-w-6xl">
        
        <div class="mb-8">
            <h1 class="text-3xl font-black text-gray-900 uppercase tracking-tight">Request <span class="text-secondary">Quote</span></h1>
            <p class="text-gray-500 mt-2 text-sm">Please provide your details below and our team will get back to you with a formal quotation.</p>
        </div>

        @if(session('error'))
            <div class="bg-red-50 text-red-700 p-4 rounded-xl mb-8 border-l-4 border-red-500 shadow-sm flex items-center">
                <i class="fas fa-exclamation-circle mr-3 text-lg"></i> {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('contact') }}" method="GET" class="flex flex-col lg:flex-row gap-8">
            <!-- Left: Form Details -->
            <div class="w-full lg:w-2/3">
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="p-6 bg-gray-50 border-b border-gray-100">
                        <h3 class="font-bold text-gray-900 uppercase tracking-widest text-sm flex items-center gap-2">
                            <i class="fas fa-user-circle text-secondary"></i> Contact Information
                        </h3>
                    </div>
                    
                    <div class="p-6 md:p-8 space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="first_name" class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">First Name <span class="text-red-500">*</span></label>
                                <input type="text" id="first_name" name="first_name" required class="w-full bg-gray-50 border border-gray-200 text-gray-900 text-sm rounded-lg focus:ring-secondary focus:border-secondary block p-3 transition-colors" placeholder="John">
                            </div>
                            <div>
                                <label for="last_name" class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Last Name <span class="text-red-500">*</span></label>
                                <input type="text" id="last_name" name="last_name" required class="w-full bg-gray-50 border border-gray-200 text-gray-900 text-sm rounded-lg focus:ring-secondary focus:border-secondary block p-3 transition-colors" placeholder="Doe">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="email" class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Email Address <span class="text-red-500">*</span></label>
                                <input type="email" id="email" name="email" required class="w-full bg-gray-50 border border-gray-200 text-gray-900 text-sm rounded-lg focus:ring-secondary focus:border-secondary block p-3 transition-colors" placeholder="john@company.com">
                            </div>
                            <div>
                                <label for="phone" class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Phone Number <span class="text-red-500">*</span></label>
                                <input type="tel" id="phone" name="phone" required class="w-full bg-gray-50 border border-gray-200 text-gray-900 text-sm rounded-lg focus:ring-secondary focus:border-secondary block p-3 transition-colors" placeholder="+91 98765 43210">
                            </div>
                        </div>

                        <div>
                            <label for="company" class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Company Name <span class="text-red-500">*</span></label>
                            <input type="text" id="company" name="company" required class="w-full bg-gray-50 border border-gray-200 text-gray-900 text-sm rounded-lg focus:ring-secondary focus:border-secondary block p-3 transition-colors" placeholder="Acme Corp">
                        </div>


                        
                        <div>
                            <label for="notes" class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Additional Notes / Requirements <span class="text-red-500">*</span></label>
                            <textarea id="notes" name="notes" rows="2" required class="w-full bg-gray-50 border border-gray-200 text-gray-900 text-sm rounded-lg focus:ring-secondary focus:border-secondary block p-3 transition-colors resize-none" placeholder="Any specific requirements or customization?"></textarea>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right: Order Summary -->
            <div class="w-full lg:w-1/3">
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden sticky top-24">
                    <div class="p-6 bg-gray-50 border-b border-gray-100">
                        <h3 class="font-bold text-gray-900 uppercase tracking-widest text-sm flex items-center gap-2">
                            <i class="fas fa-shopping-basket text-secondary"></i> Quote Summary
                        </h3>
                    </div>
                    
                    <div class="p-6">
                        <!-- Items Preview -->
                        <div class="max-h-64 overflow-y-auto pr-2 mb-6 space-y-4 custom-scrollbar">
                            @foreach($cart as $id => $details)
                                <div class="flex items-center gap-4">
                                    <div class="w-16 h-16 bg-gray-100 rounded-lg flex-shrink-0 flex items-center justify-center p-1 border border-gray-200">
                                        @if($details['image'])
                                            <img src="{{ asset('storage/' . $details['image']) }}" alt="{{ $details['name'] }}" class="max-w-full max-h-full object-contain">
                                        @else
                                            <i class="fas fa-image text-gray-300"></i>
                                        @endif
                                    </div>
                                    <div class="flex-grow">
                                        <h4 class="font-bold text-gray-900 text-sm leading-tight line-clamp-1">{{ $details['name'] }}</h4>
                                        <p class="text-xs text-gray-500 mt-1">Qty: <span class="font-bold text-gray-800">{{ $details['quantity'] }}</span></p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        
                        <div class="border-t border-gray-100 pt-6 space-y-4 mb-6">
                            <div class="flex justify-between text-sm text-gray-600">
                                <span>Total Products</span>
                                <span class="font-bold">{{ array_sum(array_column($cart, 'quantity')) }} Items</span>
                            </div>
                        </div>

                        <!-- Terms Checkbox -->
                        <div class="mb-6 bg-gray-50 p-4 rounded-lg border border-gray-200">
                            <label class="flex items-start gap-3 cursor-pointer group">
                                <input type="checkbox" required class="mt-1 w-4 h-4 rounded border-gray-300 text-secondary focus:ring-secondary">
                                <span class="text-xs text-gray-600 leading-tight">
                                    I agree to the <a href="#" class="text-secondary hover:underline font-bold">Terms & Conditions</a> and consent to being contacted regarding this quote.
                                </span>
                            </label>
                        </div>
                        
                        <button type="submit" class="w-full bg-secondary text-white font-bold py-4 px-6 rounded-xl hover:bg-red-700 transition shadow-lg shadow-red-500/30 flex items-center justify-center gap-3 uppercase tracking-widest text-sm group">
                            <i class="fas fa-paper-plane group-hover:-translate-y-1 group-hover:translate-x-1 transition-transform"></i>
                            <span>Submit Request</span>
                        </button>
                        
                        <div class="mt-4 text-center">
                            <a href="{{ route('cart.index') }}" class="text-xs font-bold text-gray-500 hover:text-primary transition uppercase tracking-wider">
                                <i class="fas fa-arrow-left mr-1"></i> Back to Cart
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        
    </div>
</div>

<style>
/* Custom Scrollbar for items list */
.custom-scrollbar::-webkit-scrollbar {
    width: 4px;
}
.custom-scrollbar::-webkit-scrollbar-track {
    background: #f1f5f9;
    border-radius: 4px;
}
.custom-scrollbar::-webkit-scrollbar-thumb {
    background: #cbd5e1;
    border-radius: 4px;
}
.custom-scrollbar::-webkit-scrollbar-thumb:hover {
    background: #94a3b8;
}
</style>
@endsection
