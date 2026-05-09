@extends('layouts.frontend')

@section('title', $product->name . ' | DMR Metal Corporation')

@section('content')
<div class="bg-gray-50 py-12 min-h-screen">
    <div class="container mx-auto px-4">
        
        <!-- Breadcrumbs -->
        <nav class="flex text-sm text-gray-500 mb-8" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="{{ route('home') }}" class="hover:text-secondary transition flex items-center">
                        <i class="fas fa-home mr-2 text-xs"></i> Home
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <i class="fas fa-chevron-right text-xs mx-2"></i>
                        <a href="{{ route('products') }}" class="hover:text-secondary transition">Products</a>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <i class="fas fa-chevron-right text-xs mx-2"></i>
                        <span class="text-gray-800 font-medium truncate max-w-[200px] sm:max-w-xs">{{ $product->name }}</span>
                    </div>
                </li>
            </ol>
        </nav>

        <!-- Product Container -->
        <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
            <div class="flex flex-col lg:flex-row">
                
                <!-- Left: Image Gallery -->
                <div class="w-full lg:w-1/2 p-8 lg:p-12 border-b lg:border-b-0 lg:border-r border-gray-100 flex flex-col items-center">
                    <!-- Main Image -->
                    <div class="relative w-full aspect-square bg-gray-50 rounded-xl flex items-center justify-center p-6 mb-6">
                        @if($product->main_image)
                            <img src="{{ asset('storage/' . $product->main_image) }}" alt="{{ $product->name }}" id="mainProductImage" class="max-w-full max-h-full object-contain cursor-zoom-in hover:scale-105 transition-transform duration-300">
                        @else
                            <i class="fas fa-image text-gray-300 text-6xl"></i>
                        @endif
                        
                        @if($product->is_featured)
                            <span class="absolute top-4 left-4 bg-secondary text-white text-xs font-black px-3 py-1.5 rounded uppercase tracking-wider shadow-md">Featured</span>
                        @endif
                    </div>
                    
                    <!-- Thumbnails (Placeholder if no relations exist, otherwise loop images) -->
                    @if(isset($product->images) && count($product->images) > 0)
                    <div class="flex gap-4 overflow-x-auto pb-2 w-full justify-center">
                        <button class="w-20 h-20 rounded-lg border-2 border-secondary p-1 flex-shrink-0">
                            <img src="{{ asset('storage/' . $product->main_image) }}" class="w-full h-full object-contain rounded">
                        </button>
                        @foreach($product->images as $img)
                        <button class="w-20 h-20 rounded-lg border border-gray-200 p-1 flex-shrink-0 hover:border-gray-400 transition">
                            <img src="{{ asset('storage/' . $img->image_path) }}" class="w-full h-full object-contain rounded">
                        </button>
                        @endforeach
                    </div>
                    @endif
                </div>
                
                <!-- Right: Product Info -->
                <div class="w-full lg:w-1/2 p-8 lg:p-12 flex flex-col">
                    <div class="mb-6">
                        <h1 class="text-3xl md:text-4xl font-black text-gray-900 leading-tight mb-4 uppercase tracking-tight">{{ $product->name }}</h1>
                        <div class="flex items-center gap-4 text-sm">
                            <span class="bg-gray-100 text-gray-600 px-3 py-1 rounded font-bold uppercase tracking-widest">SKU: DMR-{{ str_pad($product->id, 4, '0', STR_PAD_LEFT) }}</span>
                            <span class="text-green-600 font-bold flex items-center gap-1"><i class="fas fa-check-circle"></i> In Stock</span>
                        </div>
                    </div>
                    
                    <div class="ck-content mb-8">
                        <div class="text-lg leading-relaxed">{!! $product->description !!}</div>
                    </div>
                    
                    <!-- Action Area -->
                    <div class="mt-auto bg-gray-50 p-6 rounded-xl border border-gray-200"
                         x-data="{ 
                            quantity: 1, 
                            loading: false,
                            addToCart() {
                                this.loading = true;
                                fetch('{{ route('cart.add') }}', {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                        'Accept': 'application/json'
                                    },
                                    body: JSON.stringify({
                                        product_id: {{ $product->id }},
                                        quantity: this.quantity
                                    })
                                })
                                .then(res => res.json())
                                .then(data => {
                                    this.loading = false;
                                    if(data.success) {
                                        window.dispatchEvent(new CustomEvent('updated-cart', { detail: { count: data.cartCount }}));
                                    }
                                })
                                .catch(err => {
                                    this.loading = false;
                                    console.error(err);
                                });
                            }
                         }">
                        <div class="flex flex-col sm:flex-row gap-4">
                            <!-- Quantity -->
                            <div class="flex items-center bg-white border border-gray-300 rounded-lg h-12 w-full sm:w-32">
                                <button type="button" @click="if(quantity > 1) quantity--" class="px-4 text-gray-500 hover:text-secondary transition font-bold text-lg">-</button>
                                <input type="number" x-model="quantity" min="1" class="w-full text-center font-bold focus:outline-none text-gray-800" readonly>
                                <button type="button" @click="quantity++" class="px-4 text-gray-500 hover:text-secondary transition font-bold text-lg">+</button>
                            </div>
                            
                            <!-- Add to Cart -->
                            <button @click="addToCart()" :disabled="loading" class="flex-1 bg-secondary text-white font-bold py-3 px-6 rounded-lg hover:bg-red-700 transition shadow-lg shadow-red-500/30 flex items-center justify-center gap-3 uppercase tracking-widest text-sm group h-12 disabled:opacity-50">
                                <i class="fas fa-shopping-cart group-hover:scale-110 transition-transform" x-show="!loading"></i> 
                                <i class="fas fa-spinner fa-spin" x-show="loading" x-cloak></i>
                                <span x-text="loading ? 'Adding...' : 'Add to Cart'"></span>
                            </button>
                        </div>
                        
                        <div class="mt-6 flex flex-col sm:flex-row gap-4 pt-6 border-t border-gray-200">
                            @if($product->pdf_brochure)
                            <a href="{{ asset('storage/' . $product->pdf_brochure) }}" target="_blank" class="flex-1 flex items-center justify-center gap-2 text-sm font-bold text-primary hover:text-secondary transition uppercase tracking-wide py-2">
                                <i class="fas fa-file-pdf text-lg"></i> Download Brochure
                            </a>
                            @endif
                            <a href="{{ route('contact') }}" class="flex-1 flex items-center justify-center gap-2 text-sm font-bold text-gray-600 hover:text-secondary transition uppercase tracking-wide py-2">
                                <i class="fas fa-envelope text-lg"></i> Request Quote
                            </a>
                        </div>
                    </div>
                    
                </div>
            </div>
            

        </div>
    </div>
</div>
@endsection