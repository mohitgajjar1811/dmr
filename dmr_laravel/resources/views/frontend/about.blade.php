@extends('layouts.frontend')

@section('title', 'About Us | DMR Metal Corporation')

@section('content')
    <!-- Hero Section -->
    <section class="relative py-20 bg-primary overflow-hidden">
        <div class="absolute inset-0 bg-pattern opacity-10"></div>
        <div class="container mx-auto px-4 relative z-10 text-center">
            <h1 class="text-4xl md:text-5xl font-black text-white uppercase tracking-tight mb-4">About <span
                    class="text-secondary">DMR Metal</span></h1>
            <div class="h-1 w-20 bg-secondary mx-auto rounded-full mb-6"></div>
            <p class="text-lg text-gray-300 max-w-2xl mx-auto font-light leading-relaxed">
                Delivering excellence in industrial machinery and metal solutions.
            </p>
        </div>
    </section>

    <!-- Main Content Section: Neat & Clean -->
    <section class="py-20 bg-white relative">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto">



                <!-- The Story -->
                <div class="mb-20">
                    <span class="text-secondary font-bold tracking-[0.3em] uppercase text-xs mb-3 block text-center">
                        {{ $about_content->subtitle ?? 'Our Story' }}
                    </span>
                    <h2 class="text-3xl md:text-4xl font-black text-gray-900 uppercase tracking-tight mb-10 text-center">
                        {!! $about_content->title ?? 'Pioneering Industrial Innovation' !!}
                    </h2>

                    <div class="prose prose-lg text-gray-600 max-w-none font-light leading-relaxed mb-12 text-justify">
                        @if($about_content && $about_content->content)
                            {!! $about_content->content !!}
                        @else
                            <p>At DMR Metal Corporation, we believe that the foundation of any great infrastructure lies in the
                                quality of its materials and tools. Founded with a vision to streamline industrial procurement,
                                we have grown into a trusted partner for manufacturing and construction sectors across the
                                region.</p>
                            <p>Our journey began with a simple commitment: providing uncompromised quality without the premium
                                hassle. Today, our catalog spans heavy-duty machinery, precision instruments, and top-tier
                                safety gear, all curated to meet rigorous international standards.</p>
                        @endif
                    </div>

                    @if($about_content && $about_content->quote)
                        <div class="py-8 px-10 bg-gray-50 border-l-4 border-primary rounded-r-xl italic mb-16">
                            <p class="text-xl font-bold text-gray-800 leading-relaxed">
                                "{{ $about_content->quote }}"
                            </p>
                        </div>
                    @endif
                </div>



            </div>
        </div>
    </section>

    <!-- Stylish & Clean CTA Section -->
    <section class="py-14 bg-primary border-t border-gray-800 relative mb-32">

        <div class="container mx-auto px-4 text-center">
            <h2 class="text-xl md:text-2xl font-bold text-white max-w-5xl mx-auto leading-relaxed">
                {{ $about_content->cta_title ?? 'Ready to upgrade your equipment?' }}
            </h2>
        </div>
    </section>
@endsection