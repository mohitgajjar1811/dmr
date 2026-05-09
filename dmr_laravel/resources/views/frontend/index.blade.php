@extends('layouts.frontend')

@section('title', 'Home | Virja Industries - Premium Industrial Solutions')

@section('content')
    <!-- Hero Section / Slider -->
    @if($banners->count() > 0)
        <div x-data="{ activeSlide: 0, slides: {{ $banners->count() }}, timer: null }"
            x-init="timer = setInterval(() => { activeSlide = activeSlide === slides - 1 ? 0 : activeSlide + 1 }, 6000)"
            class="relative w-full overflow-hidden group bg-gray-900 aspect-[16/7] md:aspect-[21/9] lg:aspect-[21/7]">

            @foreach($banners as $index => $banner)
                <div x-show="activeSlide === {{ $index }}" class="absolute inset-0"
                    x-transition:enter="transition ease-in-out duration-[1200ms]"
                    x-transition:enter-start="transform translate-x-full" x-transition:enter-end="transform translate-x-0"
                    x-transition:leave="transition ease-in-out duration-[1200ms]" x-transition:leave-start="transform translate-x-0"
                    x-transition:leave-end="transform -translate-x-full">

                    <div class="absolute inset-0 overflow-hidden">
                        <img src="{{ asset('storage/' . $banner->image) }}" alt="{{ $banner->title }}"
                            class="w-full h-full object-cover transition-transform duration-[1200ms] ease-in-out"
                            :class="activeSlide === {{ $index }} ? 'scale-100 translate-x-0' : 'scale-110 translate-x-12'">
                        <div class="absolute inset-0 bg-gradient-to-r from-black/60 via-black/20 to-transparent"></div>
                    </div>
                </div>
            @endforeach

            @if($banners->count() > 1)
                <!-- Indicators -->
                <div class="absolute bottom-6 left-1/2 -translate-x-1/2 flex space-x-2 z-20">
                    @foreach($banners as $index => $banner)
                        <button @click="clearInterval(timer); activeSlide = {{ $index }}"
                            class="h-1.5 rounded-full transition-all duration-500 ease-out"
                            :class="activeSlide === {{ $index }} ? 'bg-secondary w-8' : 'bg-white/40 hover:bg-white/70 w-2'"></button>
                    @endforeach
                </div>

                <!-- Navigation Arrows -->
                <div class="absolute bottom-6 right-6 md:right-12 flex space-x-2 z-20">
                    <button @click="clearInterval(timer); activeSlide = activeSlide === 0 ? slides - 1 : activeSlide - 1"
                        class="w-10 h-10 md:w-12 md:h-12 flex items-center justify-center bg-black/30 hover:bg-secondary text-white transition-all duration-300 rounded-sm backdrop-blur-md group">
                        <i class="fas fa-arrow-left group-hover:-translate-x-1 transition-transform"></i>
                    </button>
                    <button @click="clearInterval(timer); activeSlide = activeSlide === slides - 1 ? 0 : activeSlide + 1"
                        class="w-10 h-10 md:w-12 md:h-12 flex items-center justify-center bg-black/30 hover:bg-secondary text-white transition-all duration-300 rounded-sm backdrop-blur-md group">
                        <i class="fas fa-arrow-right group-hover:translate-x-1 transition-transform"></i>
                    </button>
                </div>
            @endif
        </div>
    @else
        <section class="bg-gray-900 py-32 text-center text-white relative overflow-hidden">
            <div class="absolute inset-0 bg-pattern opacity-10"></div>
            <div class="container mx-auto px-4 relative z-10">
                <h1 class="text-5xl md:text-7xl font-black mb-6 uppercase tracking-tight">
                    {!! $home_content->hero_fallback_title ?? 'Industrial <span class="text-secondary">Excellence</span>' !!}
                </h1>
                <p class="text-xl text-gray-400 mb-10 max-w-2xl mx-auto font-light">
                    {!! $home_content->hero_fallback_text ?? 'Premium tools, machinery, and safety equipment for professional applications.' !!}
                </p>
                <a href="{{ route('products') }}"
                    class="bg-white text-gray-900 px-8 py-3 rounded font-bold hover:bg-secondary hover:text-white transition uppercase tracking-widest text-sm">View
                    Catalog</a>
            </div>
        </section>
    @endif

    <!-- About Us Summary -->
    <section class="py-16 bg-gray-50 border-b border-gray-200">
        <div class="container mx-auto px-4">
            <div class="flex flex-col lg:flex-row items-center gap-8">
                <div class="w-full lg:w-1/2 lg:pl-48">
                    <h2 class="text-3xl font-black text-gray-900 uppercase mb-4 leading-tight">
                        {!! $home_content->about_title ?? 'Welcome to <span class="text-primary">DMR Metal</span>' !!}
                    </h2>
                    <!-- Skewed Blue Industrial Bar -->
                    <div class="flex items-center gap-1.5 mb-10">
                        <div class="h-2 w-20 bg-primary -skew-x-12 shadow-sm"></div>
                        <div class="h-2 w-6 bg-primary/40 -skew-x-12"></div>
                        <div class="h-2 w-2 bg-secondary -skew-x-12"></div>
                    </div>
                    <div class="prose prose-sm text-gray-600 mb-8 font-light leading-relaxed">
                        @if(isset($home_content->about_content) && !empty($home_content->about_content))
                            {!! $home_content->about_content !!}
                        @else
                            <p>At DMR Metal Corporation, we believe that the foundation of any great infrastructure lies in the
                                quality of its materials and tools. Founded with a vision to streamline industrial procurement,
                                we have grown into a trusted partner for manufacturing and construction sectors across the
                                region.</p>
                            <p>Our catalog spans heavy-duty machinery, precision instruments, and top-tier safety gear, all
                                curated to meet rigorous international standards.</p>
                        @endif
                    </div>
                    <a href="{{ route('about') }}"
                        class="inline-block border-2 border-primary text-primary px-6 py-2.5 rounded font-bold hover:bg-primary hover:text-white transition uppercase tracking-widest text-xs">
                        More About Us
                    </a>
                </div>
                <div class="w-full lg:w-1/2 relative flex items-center justify-center lg:justify-center py-12">
                    <!-- Exact Composition Container -->
                    <div class="relative w-full max-w-[550px] aspect-[4/3] md:h-[400px]">

                        <!-- Back Image: Grayscale Pipes -->
                        <div
                            class="absolute bottom-0 right-0 w-[85%] md:w-[470px] h-[75%] md:h-[300px] grayscale shadow-lg overflow-hidden z-0 border-[8px] border-white">
                            @php
                                $back_img = $home_content->about_image_2 ? asset('storage/' . $home_content->about_image_2) : asset('user/images/metal-pipes.jpg');
                            @endphp
                            <img src="{{ $back_img }}" alt="Metal Pipes" class="w-full h-full object-cover">
                        </div>

                        <!-- Front Image: Steel Plate / Logo Overlap -->
                        <div
                            class="absolute top-0 left-0 w-[70%] md:w-[390px] h-[60%] md:h-[250px] z-10 border-[8px] border-white shadow-2xl overflow-hidden transform translate-x-4 translate-y-4 md:translate-x-0 md:translate-y-0">
                            @php
                                $front_img = $home_content->about_image_1 ? asset('storage/' . $home_content->about_image_1) : asset('user/images/royal-front.jpg');
                            @endphp
                            <img src="{{ $front_img }}" alt="Steel Plate" class="w-full h-full object-cover">
                        </div>

                        <!-- Decorative shadow element to enhance overlap depth -->
                        <div
                            class="absolute top-[8px] left-[8px] w-[70%] md:w-[390px] h-[60%] md:h-[250px] bg-black/5 -z-10 blur-md">
                        </div>
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
                    <span class="text-secondary font-bold tracking-widest uppercase text-xs">Top Picks</span>
                    <h2 class="text-3xl font-black text-gray-900 uppercase mt-1">Our Products</h2>
                </div>
                <a href="{{ route('products') }}"
                    class="text-gray-500 hover:text-secondary font-bold text-sm uppercase tracking-wide hidden md:block">
                    View All <i class="fas fa-arrow-right ml-1"></i>
                </a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                @forelse($featured_products as $product)
                    <div
                        class="group bg-white rounded border border-gray-100 hover:border-gray-300 hover:shadow-xl transition-all duration-300 flex flex-col relative">
                        <div class="h-64 overflow-hidden p-6 relative bg-gray-50 flex items-center justify-center">
                            @if($product->main_image)
                                <img src="{{ asset('storage/' . $product->main_image) }}" alt="{{ $product->name }}"
                                    class="max-w-full max-h-full object-contain group-hover:scale-110 transition duration-500">
                            @else
                                <i class="fas fa-box text-gray-300 text-4xl"></i>
                            @endif
                        </div>
                        <div class="p-5 flex-grow flex flex-col">
                            <h3
                                class="font-bold text-gray-900 mb-2 leading-snug group-hover:text-secondary transition-colors line-clamp-2 min-h-[2.5rem]">
                                <a href="{{ route('product.detail', $product->slug) }}">{{ $product->name }}</a>
                            </h3>
                            <div class="mt-auto">
                                <a href="{{ route('product.detail', $product->slug) }}"
                                    class="block w-full text-center border border-gray-200 text-gray-700 font-bold py-2 rounded text-sm hover:bg-primary hover:text-white transition uppercase tracking-wide">
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
@endsection