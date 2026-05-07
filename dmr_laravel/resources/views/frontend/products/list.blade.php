@extends('layouts.frontend')

@section('title', 'Our Products | DMR Metal Corporation')

@section('content')
    <div class="bg-gray-50 py-12 min-h-screen">
        <div class="container mx-auto px-4">

            <!-- Header Section -->
            <div
                class="mb-10 flex flex-col md:flex-row justify-between items-center bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                <div>
                    <h1 class="text-3xl font-black text-gray-900 uppercase tracking-tight">Our Products</h1>
                    <p class="text-gray-500 mt-2 text-sm">Browse our premium collection of industrial solutions.</p>
                </div>

                <div class="mt-4 md:mt-0 flex gap-4 w-full md:w-auto">
                    <form action="{{ route('products') }}" method="GET" class="relative w-full md:w-64 group">
                        <input type="text" name="q" value="{{ request('q') }}" placeholder="Search catalog..."
                            class="w-full pl-10 pr-4 py-2 bg-gray-50 border border-gray-200 rounded-lg text-sm focus:outline-none focus:border-secondary focus:ring-1 focus:ring-secondary transition-colors">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-search text-gray-400 group-focus-within:text-secondary"></i>
                        </div>
                    </form>
                </div>
            </div>

            <div class="flex flex-col lg:flex-row gap-8">

                <!-- Sidebar Filters -->
                <div class="w-full lg:w-1/4">
                    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 sticky top-24">
                        <h3 class="font-bold text-gray-900 mb-4 uppercase tracking-widest text-sm flex items-center gap-2">
                            <i class="fas fa-filter text-secondary"></i> Filters
                        </h3>

                        <div class="space-y-6">
                            <!-- Categories (Placeholder for future) -->
                            <div>
                                <h4 class="font-medium text-gray-700 mb-3 text-sm">Categories</h4>
                                <div class="space-y-2">
                                    <label class="flex items-center gap-3 cursor-pointer group">
                                        <input type="checkbox"
                                            class="w-4 h-4 rounded border-gray-300 text-secondary focus:ring-secondary">
                                        <span class="text-sm text-gray-600 group-hover:text-secondary transition">Industrial
                                            Machinery</span>
                                    </label>
                                    <label class="flex items-center gap-3 cursor-pointer group">
                                        <input type="checkbox"
                                            class="w-4 h-4 rounded border-gray-300 text-secondary focus:ring-secondary">
                                        <span class="text-sm text-gray-600 group-hover:text-secondary transition">Safety
                                            Equipment</span>
                                    </label>
                                    <label class="flex items-center gap-3 cursor-pointer group">
                                        <input type="checkbox"
                                            class="w-4 h-4 rounded border-gray-300 text-secondary focus:ring-secondary">
                                        <span
                                            class="text-sm text-gray-600 group-hover:text-secondary transition">Measurement
                                            Tools</span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="mt-8">
                            <a href="{{ route('products') }}"
                                class="w-full block text-center py-2 px-4 border border-gray-300 rounded text-sm font-medium text-gray-700 hover:bg-gray-50 transition">
                                Clear Filters
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Product Grid -->
                <div class="w-full lg:w-3/4">

                    @if($products->isEmpty())
                        <div
                            class="bg-white p-12 rounded-xl shadow-sm border border-gray-100 text-center flex flex-col items-center justify-center min-h-[400px]">
                            <div class="w-24 h-24 bg-gray-50 rounded-full flex items-center justify-center mb-6">
                                <i class="fas fa-box-open text-4xl text-gray-300"></i>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-900 mb-2">No Products Found</h3>
                            <p class="text-gray-500 mb-6">We couldn't find any products matching your search criteria.</p>
                            <a href="{{ route('products') }}"
                                class="bg-secondary text-white px-6 py-2 rounded-lg font-medium hover:bg-red-700 transition">View
                                All Products</a>
                        </div>
                    @else
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6" x-data="{
                                    addToCart(productId) {
                                        fetch('{{ route('cart.add') }}', {
                                            method: 'POST',
                                            headers: {
                                                'Content-Type': 'application/json',
                                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                                'Accept': 'application/json'
                                            },
                                            body: JSON.stringify({
                                                product_id: productId,
                                                quantity: 1
                                            })
                                        })
                                        .then(res => res.json())
                                        .then(data => {
                                            if(data.success) {
                                                window.dispatchEvent(new CustomEvent('updated-cart', { detail: { count: data.cartCount }}));
                                                // Optional: Show toast
                                            }
                                        })
                                        .catch(err => console.error(err));
                                    }
                                 }">
                            @foreach($products as $product)
                                <div
                                    class="bg-white rounded-xl border border-gray-100 overflow-hidden group hover:shadow-xl transition-all duration-300 flex flex-col relative transform hover:-translate-y-1">

                                    <!-- Badges -->
                                    <div class="absolute top-3 left-3 z-10 flex flex-col gap-2">
                                        @if($product->is_featured)
                                            <span
                                                class="bg-secondary text-white text-[10px] font-black px-2 py-1 rounded uppercase tracking-wider shadow-sm">Featured</span>
                                        @endif
                                    </div>

                                    <!-- Image Container -->
                                    <div class="relative h-56 bg-gray-50 p-4 flex items-center justify-center overflow-hidden">
                                        @if($product->main_image)
                                            <img src="{{ asset('storage/' . $product->main_image) }}" alt="{{ $product->name }}"
                                                class="max-w-full max-h-full object-contain group-hover:scale-110 transition-transform duration-500">
                                        @else
                                            <i class="fas fa-image text-gray-300 text-5xl"></i>
                                        @endif

                                        <!-- Quick Action Overlay -->
                                        <div
                                            class="absolute inset-0 bg-gray-900/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center backdrop-blur-[2px]">
                                            <a href="{{ route('product.detail', $product->slug) }}"
                                                class="bg-white text-gray-900 font-bold px-6 py-2 rounded-full transform translate-y-4 group-hover:translate-y-0 transition-all duration-300 hover:bg-secondary hover:text-white shadow-lg text-sm uppercase tracking-wide">
                                                View Details
                                            </a>
                                        </div>
                                    </div>

                                    <!-- Content -->
                                    <div class="p-5 flex-grow flex flex-col">
                                        <h3
                                            class="font-bold text-gray-900 mb-2 leading-snug group-hover:text-secondary transition-colors line-clamp-2">
                                            <a href="{{ route('product.detail', $product->slug) }}">{{ $product->name }}</a>
                                        </h3>

                                        <p class="text-sm text-gray-500 line-clamp-2 mb-4 flex-grow">{{ $product->description }}</p>

                                        <div class="mt-auto pt-4 border-t border-gray-100 flex items-center justify-between">
                                            <span class="text-xs font-bold text-gray-400 uppercase tracking-wider">SKU:
                                                DMR-{{ str_pad($product->id, 4, '0', STR_PAD_LEFT) }}</span>
                                            <button @click="addToCart({{ $product->id }})"
                                                class="w-8 h-8 rounded-full bg-gray-50 text-gray-600 hover:bg-secondary hover:text-white transition flex items-center justify-center"
                                                title="Add to Cart">
                                                <i class="fas fa-shopping-cart text-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Pagination -->
                        <div class="mt-12 flex justify-center">
                            {{ $products->links('pagination::tailwind') }}
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
@endsection