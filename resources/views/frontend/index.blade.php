@extends('layouts.frontend')

@section('title', 'Home | Virja Industries - Premium Industrial Solutions')

@section('content')
<!-- Hero Section / Slider -->
@if($banners->count() > 0)
<div x-data="{ activeSlide: 0, slides: {{ $banners->count() }}, timer: null }"
    x-init="timer = setInterval(() => { activeSlide = activeSlide === slides - 1 ? 0 : activeSlide + 1 }, 6000)"
    class="relative w-full overflow-hidden group bg-gray-100">

    <img src="{{ asset('storage/' . $banners->first()->image) }}" class="w-full h-auto invisible pointer-events-none block" aria-hidden="true" alt="">

    @foreach($banners as $index => $banner)
    <div x-show="activeSlide === {{ $index }}"
        class="absolute inset-0 transition-opacity duration-700 ease-in-out" x-transition:enter="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="opacity-100" x-transition:leave-end="opacity-0">

        <div class="absolute inset-0">
            <img src="{{ asset('storage/' . $banner->image) }}" alt="{{ $banner->title }}" class="w-full h-full object-cover object-center">
            <div class="absolute inset-0 bg-gradient-to-r from-gray-900/90 via-gray-900/60 to-transparent pointer-events-none"></div>
        </div>

        <div class="absolute inset-0 flex items-center">
            <div class="container mx-auto px-6 md:px-12 relative z-10">
                <div class="max-w-2xl border-l-4 border-secondary pl-6 md:pl-8 overflow-hidden">
                    <h2 class="text-2xl sm:text-2xl md:text-5xl font-bold text-white uppercase tracking-tight mb-2 md:mb-4 drop-shadow-md leading-tight">
                        {{ $banner->title }}
                    </h2>

                    @if($banner->btn_link)
                    <div>
                        <a href="{{ $banner->btn_link }}" class="inline-block bg-secondary text-white px-4 py-2 md:px-8 md:py-3 rounded text-xs md:text-sm font-bold uppercase tracking-wider hover:bg-red-700 transition shadow-lg">
                            {{ $banner->btn_text ?? 'View Products' }}
                        </a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @endforeach

    @if($banners->count() > 1)
    <div class="absolute bottom-4 md:bottom-8 right-4 md:right-8 flex space-x-1 md:space-x-2 z-20">
        <button @click="clearInterval(timer); activeSlide = activeSlide === 0 ? slides - 1 : activeSlide - 1"
            class="w-6 h-6 md:w-10 md:h-10 flex items-center justify-center bg-gray-800/80 text-white hover:bg-secondary transition rounded text-xs md:text-base">
            <i class="fas fa-chevron-left"></i>
        </button>
        <button @click="clearInterval(timer); activeSlide = activeSlide === slides - 1 ? 0 : activeSlide + 1"
            class="w-6 h-6 md:w-10 md:h-10 flex items-center justify-center bg-gray-800/80 text-white hover:bg-secondary transition rounded text-xs md:text-base">
            <i class="fas fa-chevron-right"></i>
        </button>
    </div>
    @endif
</div>
@else
<section class="bg-gray-900 py-32 text-center text-white relative overflow-hidden">
    <div class="absolute inset-0 bg-pattern opacity-10"></div>
    <div class="container mx-auto px-4 relative z-10">
        <h1 class="text-5xl md:text-7xl font-black mb-6 uppercase tracking-tight">{!! $home_content->hero_fallback_title ?? 'Industrial <span class="text-secondary">Excellence</span>' !!}</h1>
        <p class="text-xl text-gray-400 mb-10 max-w-2xl mx-auto font-light">{!! $home_content->hero_fallback_text ?? 'Premium tools, machinery, and safety equipment for professional applications.' !!}</p>
        <a href="{{ route('products') }}" class="bg-white text-gray-900 px-8 py-3 rounded font-bold hover:bg-secondary hover:text-white transition uppercase tracking-widest text-sm">View Catalog</a>
    </div>
</section>
@endif

<!-- Features Strip -->
@if($home_content->features_section_enabled ?? true)
<div class="bg-primary text-white py-12 border-b border-gray-800">
    <div class="container mx-auto px-4 grid grid-cols-1 md:grid-cols-4 gap-8 text-center md:text-left">
        @forelse($features as $feature)
        <div class="flex items-center justify-center md:justify-start gap-4 p-4 border border-gray-700 bg-gray-800 bg-opacity-50 rounded hover:border-secondary transition cursor-default">
            <i class="{{ $feature->icon }} text-secondary text-3xl"></i>
            <div>
                <h4 class="font-bold uppercase text-sm">{{ $feature->title }}</h4>
                <p class="text-xs text-gray-400">{{ $feature->subtitle }}</p>
            </div>
        </div>
        @empty
        <div class="flex items-center justify-center md:justify-start gap-4 p-4 border border-gray-700 bg-gray-800 bg-opacity-50 rounded hover:border-secondary transition cursor-default">
            <i class="fas fa-shipping-fast text-secondary text-3xl"></i>
            <div>
                <h4 class="font-bold uppercase text-sm">Fast Delivery</h4>
                <p class="text-xs text-gray-400">Nationwide Shipping</p>
            </div>
        </div>
        @endforelse
    </div>
</div>
@endif

<!-- Featured Products -->
<section class="py-20 bg-white">
    <div class="container mx-auto px-4">
        <div class="flex justify-between items-end mb-12 border-b border-gray-200 pb-4">
            <div>
                <span class="text-secondary font-bold tracking-widest uppercase text-xs">{{ $home_content->featured_products_subtitle ?? 'Top Picks' }}</span>
                <h2 class="text-3xl font-black text-gray-900 uppercase mt-1">{{ $home_content->featured_products_title ?? 'Featured Products' }}</h2>
            </div>
            <a href="{{ route('products') }}" class="text-gray-500 hover:text-secondary font-bold text-sm uppercase tracking-wide hidden md:block">
                View All <i class="fas fa-arrow-right ml-1"></i>
            </a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            @forelse($featured_products as $product)
            <div class="group bg-white rounded border border-gray-100 hover:border-gray-300 hover:shadow-xl transition-all duration-300 flex flex-col relative">
                <div class="h-64 overflow-hidden p-6 relative bg-gray-50 flex items-center justify-center">
                    <img src="{{ asset('storage/' . $product->main_image) }}" alt="{{ $product->name }}" class="max-w-full max-h-full object-contain group-hover:scale-110 transition duration-500">
                </div>
                <div class="p-5 flex-grow flex flex-col">
                    <h3 class="font-bold text-gray-900 mb-2 leading-snug group-hover:text-secondary transition-colors line-clamp-2 min-h-[2.5rem]">
                        <a href="{{ route('product.detail', $product->slug) }}">{{ $product->name }}</a>
                    </h3>
                    <div class="mt-auto">
                        <a href="{{ route('product.detail', $product->slug) }}" class="block w-full text-center border border-gray-200 text-gray-700 font-bold py-2 rounded text-sm hover:bg-primary hover:text-white transition uppercase tracking-wide">
                            View Details
                        </a>
                    </div>
                </div>
            </div>
            @empty
            <p class="col-span-4 text-center text-gray-500">No products found.</p>
            @endforelse
        </div>
    </div>
</section>

<!-- Brand Showcase -->
<section class="py-16 bg-gray-50 border-t border-gray-200 overflow-hidden">
    <div class="container mx-auto px-4 text-center">
        <h2 class="text-lg font-bold text-gray-400 uppercase tracking-[0.3em] mb-10">{{ $home_content->brands_title ?? 'Trusted By Industry Leaders' }}</h2>
        <div class="flex overflow-hidden relative">
            <div class="flex gap-12 animate-marquee whitespace-nowrap px-6">
                @foreach($brands as $brand)
                <a href="{{ route('products', ['brand' => $brand->id]) }}" class="w-32 h-20 flex-shrink-0 flex items-center justify-center opacity-60 hover:opacity-100 transition grayscale hover:grayscale-0 duration-300">
                    @if($brand->logo)
                        <img src="{{ asset('storage/' . $brand->logo) }}" alt="{{ $brand->name }}" class="max-w-full max-h-full object-contain">
                    @else
                        <span class="font-black text-xl text-gray-300 uppercase">{{ $brand->name }}</span>
                    @endif
                </a>
                @endforeach
            </div>
        </div>
    </div>
</section>

<!-- Banner / CTA -->
<section class="relative py-24 bg-primary text-white overflow-hidden">
    <div class="absolute inset-0 bg-gray-900 opacity-50 z-0"></div>
    <div class="container mx-auto px-4 relative z-10 text-center">
        <h2 class="text-4xl md:text-5xl font-black mb-6 leading-tight">{{ $home_content->cta_title ?? 'Ready to Optimize Your Production?' }}</h2>
        <div class="text-gray-300 mb-10 max-w-2xl mx-auto text-xl font-light">{!! $home_content->cta_text ?? 'Get custom quotes, technical specifications, and bulk pricing.' !!}</div>
        <div class="flex justify-center">
            <a href="#" class="bg-secondary text-white px-10 py-4 rounded font-bold hover:bg-white hover:text-secondary transition shadow-2xl uppercase tracking-widest text-sm">
                {{ $home_content->cta_btn_text ?? 'Request a Quote' }}
            </a>
        </div>
    </div>
</section>
@endsection
