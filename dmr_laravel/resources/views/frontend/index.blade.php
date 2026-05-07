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
            <img src="{{ asset('storage/' . $banner->image) }}" alt="{{ $banner->title }}" class="w-full h-auto block">
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

<!-- About Us Summary -->
<section class="py-16 bg-gray-50 border-b border-gray-200">
    <div class="container mx-auto px-4">
        <div class="flex flex-col lg:flex-row items-center gap-12">
            <div class="w-full lg:w-1/2">
                <span class="text-secondary font-bold tracking-widest uppercase text-xs mb-2 block">Our Heritage</span>
                <h2 class="text-3xl font-black text-gray-900 uppercase mb-6">{!! $home_content->about_title ?? 'About <span class="text-primary">DMR Metal</span>' !!}</h2>
                <div class="prose prose-sm text-gray-600 mb-8 font-light leading-relaxed">
                    @if(isset($home_content->about_content) && !empty($home_content->about_content))
                        {!! \Illuminate\Support\Str::words(strip_tags($home_content->about_content), 50, '...') !!}
                    @else
                        <p>At DMR Metal Corporation, we believe that the foundation of any great infrastructure lies in the quality of its materials and tools. Founded with a vision to streamline industrial procurement, we have grown into a trusted partner for manufacturing and construction sectors across the region.</p>
                        <p>Our catalog spans heavy-duty machinery, precision instruments, and top-tier safety gear, all curated to meet rigorous international standards.</p>
                    @endif
                </div>
                <a href="{{ route('about') }}" class="inline-block border-2 border-primary text-primary px-6 py-2.5 rounded font-bold hover:bg-primary hover:text-white transition uppercase tracking-widest text-xs">
                    Read Full Story
                </a>
            </div>
            <div class="w-full lg:w-1/2 relative hidden md:block">
                <div class="absolute inset-0 bg-secondary transform rotate-3 rounded z-0 opacity-10"></div>
                <div class="bg-white border border-gray-200 p-2 rounded shadow-lg relative z-10 aspect-[16/9] flex items-center justify-center overflow-hidden">
                    @if(isset($home_content->about_image) && !empty($home_content->about_image))
                        <img src="{{ asset('storage/' . $home_content->about_image) }}" alt="About DMR Metal" class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full bg-gray-100 flex flex-col items-center justify-center text-gray-400">
                            <i class="fas fa-industry text-6xl mb-4 opacity-50"></i>
                            <span class="font-bold uppercase tracking-widest text-sm opacity-50">Industrial Excellence</span>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

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
