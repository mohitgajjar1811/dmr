@extends('layouts.frontend')

@section('title', 'About Us | DMR Metal Corporation')

@section('content')
<!-- Hero Section -->
<section class="relative py-24 bg-primary overflow-hidden">
    <div class="absolute inset-0 bg-pattern opacity-10"></div>
    <div class="container mx-auto px-4 relative z-10 text-center">
        <h1 class="text-4xl md:text-6xl font-black text-white uppercase tracking-tight mb-4">About <span class="text-secondary">DMR Metal</span></h1>
        <div class="h-1.5 w-24 bg-secondary mx-auto rounded-full mb-6"></div>
        <p class="text-xl text-gray-300 max-w-3xl mx-auto font-light leading-relaxed">
            Delivering excellence in industrial machinery, premium metal products, and safety solutions since our inception.
        </p>
    </div>
</section>

<!-- Our Story Section -->
<section class="py-20 bg-white">
    <div class="container mx-auto px-4">
        <div class="flex flex-col lg:flex-row items-center gap-16">
            
            <div class="w-full lg:w-1/2 relative">
                <div class="absolute -inset-4 bg-gray-100 rounded-2xl transform rotate-3 -z-10"></div>
                <div class="bg-gray-200 aspect-[4/3] rounded-2xl overflow-hidden shadow-2xl relative flex items-center justify-center border border-gray-100">
                    <i class="fas fa-industry text-9xl text-gray-300 opacity-50"></i>
                    <div class="absolute inset-0 bg-gradient-to-t from-gray-900/60 to-transparent flex items-end p-8">
                        <h3 class="text-white font-bold text-2xl uppercase tracking-widest">Our Heritage</h3>
                    </div>
                </div>
            </div>
            
            <div class="w-full lg:w-1/2">
                <h4 class="text-secondary font-bold tracking-widest uppercase text-sm mb-2">Our Story</h4>
                <h2 class="text-4xl font-black text-gray-900 uppercase tracking-tight mb-6">Pioneering Industrial <span class="text-primary">Innovation</span></h2>
                
                <div class="prose prose-lg text-gray-600">
                    <p class="mb-6">
                        At DMR Metal Corporation, we believe that the foundation of any great infrastructure lies in the quality of its materials and tools. Founded with a vision to streamline industrial procurement, we have grown into a trusted partner for manufacturing and construction sectors across the region.
                    </p>
                    <p class="mb-6">
                        Our journey began with a simple commitment: providing uncompromised quality without the premium hassle. Today, our catalog spans heavy-duty machinery, precision instruments, and top-tier safety gear, all curated to meet rigorous international standards.
                    </p>
                    <p class="font-bold text-gray-800 border-l-4 border-secondary pl-4 italic">
                        "We don't just supply equipment; we supply the reliability that builds tomorrow's world."
                    </p>
                </div>
            </div>
            
        </div>
    </div>
</section>

<!-- Stats / Features -->
<section class="py-16 bg-gray-900 border-t-4 border-secondary">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
            <div class="p-6">
                <i class="fas fa-globe-asia text-4xl text-secondary mb-4"></i>
                <div class="text-4xl font-black text-white mb-2">15+</div>
                <div class="text-sm text-gray-400 font-bold uppercase tracking-widest">Countries Served</div>
            </div>
            <div class="p-6">
                <i class="fas fa-boxes text-4xl text-secondary mb-4"></i>
                <div class="text-4xl font-black text-white mb-2">5k+</div>
                <div class="text-sm text-gray-400 font-bold uppercase tracking-widest">Products</div>
            </div>
            <div class="p-6">
                <i class="fas fa-users text-4xl text-secondary mb-4"></i>
                <div class="text-4xl font-black text-white mb-2">10k+</div>
                <div class="text-sm text-gray-400 font-bold uppercase tracking-widest">Happy Clients</div>
            </div>
            <div class="p-6">
                <i class="fas fa-award text-4xl text-secondary mb-4"></i>
                <div class="text-4xl font-black text-white mb-2">100%</div>
                <div class="text-sm text-gray-400 font-bold uppercase tracking-widest">Quality Assured</div>
            </div>
        </div>
    </div>
</section>

<!-- Core Values -->
<section class="py-20 bg-gray-50">
    <div class="container mx-auto px-4 text-center">
        <h4 class="text-secondary font-bold tracking-widest uppercase text-sm mb-2">Why Choose Us</h4>
        <h2 class="text-4xl font-black text-gray-900 uppercase tracking-tight mb-16">Our Core <span class="text-primary">Values</span></h2>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
            <!-- Value 1 -->
            <div class="bg-white p-10 rounded-2xl shadow-lg border border-gray-100 hover:-translate-y-2 transition-transform duration-300">
                <div class="w-16 h-16 bg-primary rounded-xl flex items-center justify-center mx-auto mb-6 transform -rotate-3 shadow-md">
                    <i class="fas fa-shield-alt text-2xl text-white"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900 uppercase tracking-wide mb-4">Uncompromising Quality</h3>
                <p class="text-gray-600 leading-relaxed">
                    Every product in our inventory undergoes strict quality checks to ensure it meets our high standards before it reaches your site.
                </p>
            </div>
            
            <!-- Value 2 -->
            <div class="bg-white p-10 rounded-2xl shadow-lg border border-gray-100 hover:-translate-y-2 transition-transform duration-300 relative overflow-hidden">
                <div class="absolute top-0 right-0 w-24 h-24 bg-secondary opacity-5 rounded-bl-full"></div>
                <div class="w-16 h-16 bg-secondary rounded-xl flex items-center justify-center mx-auto mb-6 transform rotate-3 shadow-md relative z-10">
                    <i class="fas fa-handshake text-2xl text-white"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900 uppercase tracking-wide mb-4 relative z-10">Client Partnership</h3>
                <p class="text-gray-600 leading-relaxed relative z-10">
                    We view our clients as partners. Your success is our success, and we go the extra mile to provide tailored solutions.
                </p>
            </div>
            
            <!-- Value 3 -->
            <div class="bg-white p-10 rounded-2xl shadow-lg border border-gray-100 hover:-translate-y-2 transition-transform duration-300">
                <div class="w-16 h-16 bg-primary rounded-xl flex items-center justify-center mx-auto mb-6 transform -rotate-3 shadow-md">
                    <i class="fas fa-bolt text-2xl text-white"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900 uppercase tracking-wide mb-4">Fast & Reliable</h3>
                <p class="text-gray-600 leading-relaxed">
                    In the industrial world, time is money. Our optimized logistics network ensures your critical supplies arrive exactly when needed.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="py-16 bg-secondary text-white text-center">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl font-black uppercase tracking-wide mb-6">Ready to upgrade your equipment?</h2>
        <a href="{{ route('products') }}" class="inline-block bg-white text-gray-900 px-8 py-3 rounded-lg font-bold shadow-xl hover:bg-gray-100 hover:scale-105 transition-all duration-300 uppercase tracking-widest text-sm">
            Explore Our Catalog
        </a>
    </div>
</section>
@endsection
