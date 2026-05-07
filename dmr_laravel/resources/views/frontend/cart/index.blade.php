@extends('layouts.frontend')

@section('title', 'Your Cart | DMR Metal Corporation')

@section('content')
<div class="bg-gray-50 py-12 min-h-screen">
    <div class="container mx-auto px-4">
        
        <div class="mb-10">
            <h1 class="text-3xl md:text-4xl font-black text-gray-900 uppercase tracking-tight">Shopping <span class="text-secondary">Cart</span></h1>
            <p class="text-gray-500 mt-2">Review your selected items before proceeding to checkout.</p>
        </div>

        @if(session('success'))
            <div class="bg-green-50 text-green-700 p-4 rounded-xl mb-8 border-l-4 border-green-500 shadow-sm flex items-center">
                <i class="fas fa-check-circle mr-3 text-lg"></i> {{ session('success') }}
            </div>
        @endif

        @if(count($cart) > 0)
            <div class="flex flex-col lg:flex-row gap-8">
                <!-- Cart Items -->
                <div class="w-full lg:w-2/3">
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                        <div class="hidden md:grid grid-cols-12 gap-4 p-6 bg-gray-50 border-b border-gray-100 text-xs font-bold text-gray-500 uppercase tracking-widest">
                            <div class="col-span-6">Product Details</div>
                            <div class="col-span-3 text-center">Quantity</div>
                            <div class="col-span-3 text-right">Action</div>
                        </div>
                        
                        <div class="divide-y divide-gray-100">
                            @foreach($cart as $id => $details)
                                <div class="p-6 flex flex-col md:grid md:grid-cols-12 gap-6 items-center hover:bg-gray-50/50 transition-colors">
                                    
                                    <!-- Product Details -->
                                    <div class="col-span-6 flex items-center gap-6 w-full">
                                        <div class="w-24 h-24 bg-gray-100 rounded-xl flex-shrink-0 flex items-center justify-center p-2">
                                            @if($details['image'])
                                                <img src="{{ asset('storage/' . $details['image']) }}" alt="{{ $details['name'] }}" class="max-w-full max-h-full object-contain">
                                            @else
                                                <i class="fas fa-image text-gray-300 text-3xl"></i>
                                            @endif
                                        </div>
                                        <div class="flex-grow">
                                            <h3 class="font-bold text-gray-900 text-lg leading-tight mb-1">
                                                <a href="{{ route('product.detail', $details['slug'] ?? '') }}" class="hover:text-secondary transition">{{ $details['name'] }}</a>
                                            </h3>
                                            <p class="text-xs font-bold text-gray-400 uppercase tracking-widest">SKU: DMR-{{ str_pad($id, 4, '0', STR_PAD_LEFT) }}</p>
                                        </div>
                                    </div>
                                    
                                    <!-- Quantity -->
                                    <div class="col-span-3 w-full md:w-auto flex justify-center">
                                        <form action="{{ route('cart.update') }}" method="POST" class="flex items-center bg-white border border-gray-300 rounded-lg h-12 w-32 shadow-sm">
                                            @csrf
                                            @method('patch')
                                            <input type="hidden" name="id" value="{{ $id }}">
                                            <button type="button" onclick="this.parentNode.querySelector('input[type=number]').stepDown(); this.parentNode.submit();" class="px-3 text-gray-500 hover:text-secondary transition font-bold text-lg h-full">-</button>
                                            <input type="number" name="quantity" value="{{ $details['quantity'] }}" min="1" class="w-full text-center font-bold focus:outline-none text-gray-800 bg-transparent" onchange="this.form.submit()">
                                            <button type="button" onclick="this.parentNode.querySelector('input[type=number]').stepUp(); this.parentNode.submit();" class="px-3 text-gray-500 hover:text-secondary transition font-bold text-lg h-full">+</button>
                                        </form>
                                    </div>
                                    
                                    <!-- Remove Action -->
                                    <div class="col-span-3 w-full md:w-auto flex justify-end">
                                        <form action="{{ route('cart.remove') }}" method="POST">
                                            @csrf
                                            @method('delete')
                                            <input type="hidden" name="id" value="{{ $id }}">
                                            <button type="submit" class="text-red-500 hover:text-red-700 bg-red-50 hover:bg-red-100 p-3 rounded-full transition-colors" title="Remove from Cart">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Order Summary -->
                <div class="w-full lg:w-1/3">
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 sticky top-24">
                        <h3 class="font-bold text-gray-900 mb-6 uppercase tracking-widest text-lg border-b border-gray-100 pb-4">Order Summary</h3>
                        
                        <div class="space-y-4 mb-8">
                            <div class="flex justify-between text-gray-600">
                                <span>Total Items</span>
                                <span class="font-bold">{{ array_sum(array_column($cart, 'quantity')) }}</span>
                            </div>
                        </div>
                        
                        <div class="border-t border-gray-100 pt-6 mb-8">
                            <p class="text-sm text-gray-500 mb-4 italic">Note: As an industrial supplier, our pricing varies based on bulk requirements and customization. Please proceed to request a formal quotation.</p>
                        </div>
                        
                        <a href="{{ route('checkout') }}" class="w-full bg-secondary text-white font-bold py-4 px-6 rounded-xl hover:bg-red-700 transition shadow-lg shadow-red-500/30 flex items-center justify-center gap-3 uppercase tracking-widest text-sm group">
                            <span>Request Quote</span>
                            <i class="fas fa-arrow-right group-hover:translate-x-1 transition-transform"></i>
                        </a>
                        
                        <div class="mt-4 text-center">
                            <a href="{{ route('products') }}" class="text-sm font-bold text-gray-500 hover:text-primary transition uppercase tracking-wider">
                                <i class="fas fa-arrow-left mr-1"></i> Continue Shopping
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <!-- Empty Cart -->
            <div class="bg-white p-16 rounded-2xl shadow-sm border border-gray-100 text-center flex flex-col items-center justify-center min-h-[500px]">
                <div class="w-32 h-32 bg-gray-50 rounded-full flex items-center justify-center mb-8 relative">
                    <i class="fas fa-shopping-cart text-5xl text-gray-300"></i>
                    <div class="absolute -bottom-2 -right-2 bg-secondary text-white w-10 h-10 rounded-full flex items-center justify-center font-bold text-xl shadow-lg border-4 border-white">0</div>
                </div>
                <h3 class="text-3xl font-black text-gray-900 mb-4 uppercase tracking-tight">Your cart is empty</h3>
                <p class="text-gray-500 mb-8 max-w-md text-lg">Looks like you haven't added any industrial equipment to your cart yet.</p>
                <a href="{{ route('products') }}" class="bg-secondary text-white px-8 py-4 rounded-xl font-bold hover:bg-red-700 transition shadow-lg shadow-red-500/30 uppercase tracking-widest text-sm">
                    Browse Catalog
                </a>
            </div>
        @endif
        
    </div>
</div>
@endsection
