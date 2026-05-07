@extends('layouts.frontend')

@section('title', 'Contact Us | ' . ($company_info->name ?? 'Virja Industries'))

@section('content')
<!-- Hero Section -->
<section class="relative py-20 bg-primary overflow-hidden">
    <div class="absolute inset-0 bg-pattern opacity-10"></div>
    <div class="container mx-auto px-4 relative z-10 text-center">
        <h1 class="text-4xl md:text-5xl font-black text-white uppercase tracking-tight mb-4">Contact <span class="text-secondary">Us</span></h1>
        <div class="h-1 w-20 bg-secondary mx-auto rounded mb-6"></div>
        <p class="text-lg text-gray-300 max-w-2xl mx-auto font-light">
            We are here to help. Reach out to us for any inquiries, quotes, or support.
        </p>
    </div>
</section>

<!-- Contact Info & Form Section -->
<section class="py-16 bg-gray-50 relative">
    <div class="container mx-auto px-4">
        <div class="max-w-5xl mx-auto bg-white rounded-2xl shadow-2xl overflow-hidden flex flex-col md:flex-row -mt-24 relative z-20 border border-gray-100">
            
            <!-- Contact Information Sidebar -->
            <div class="bg-gray-900 text-white w-full md:w-2/5 p-10 flex flex-col justify-between">
                <div>
                    <h3 class="text-2xl font-bold mb-6 uppercase tracking-wide">Get In Touch</h3>
                    <p class="text-gray-400 text-sm mb-10 leading-relaxed">
                        Fill out the form and our team will get back to you within 24 hours.
                    </p>
                    
                    <div class="space-y-8">
                        <div class="flex items-start">
                            <i class="fas fa-map-marker-alt mt-1 text-secondary text-xl w-8"></i>
                            <div>
                                <h4 class="font-bold text-sm uppercase tracking-wider text-gray-300 mb-1">Head Office</h4>
                                <p class="text-gray-400 text-sm leading-relaxed">{{ $company_info->address ?? 'Pune, Maharashtra, India' }}</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start">
                            <i class="fas fa-phone-alt mt-1 text-secondary text-xl w-8"></i>
                            <div>
                                <h4 class="font-bold text-sm uppercase tracking-wider text-gray-300 mb-1">Phone</h4>
                                <a href="tel:{{ $company_info->phone ?? '+911234567890' }}" class="text-gray-400 text-sm hover:text-white transition">{{ $company_info->phone ?? '+91 123 456 7890' }}</a>
                            </div>
                        </div>
                        
                        <div class="flex items-start">
                            <i class="fas fa-envelope mt-1 text-secondary text-xl w-8"></i>
                            <div>
                                <h4 class="font-bold text-sm uppercase tracking-wider text-gray-300 mb-1">Email</h4>
                                <a href="mailto:{{ $company_info->email ?? 'info@virjaautomation.com' }}" class="text-gray-400 text-sm hover:text-white transition">{{ $company_info->email ?? 'info@virjaautomation.com' }}</a>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="mt-12 pt-8 border-t border-gray-800">
                    <h4 class="font-bold text-xs uppercase tracking-widest text-gray-500 mb-4">Follow Us</h4>
                    <div class="flex gap-4">
                        @if($company_info->facebook ?? false)
                            <a href="{{ $company_info->facebook }}" target="_blank" class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center text-gray-400 hover:bg-secondary hover:text-white transition transform hover:-translate-y-1"><i class="fab fa-facebook-f"></i></a>
                        @endif
                        @if($company_info->linkedin ?? false)
                            <a href="{{ $company_info->linkedin }}" target="_blank" class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center text-gray-400 hover:bg-secondary hover:text-white transition transform hover:-translate-y-1"><i class="fab fa-linkedin-in"></i></a>
                        @endif
                        @if($company_info->instagram ?? false)
                            <a href="{{ $company_info->instagram }}" target="_blank" class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center text-gray-400 hover:bg-secondary hover:text-white transition transform hover:-translate-y-1"><i class="fab fa-instagram"></i></a>
                        @endif
                    </div>
                </div>
            </div>
            
            <!-- Contact Form -->
            <div class="w-full md:w-3/5 p-10">
                <h3 class="text-2xl font-bold text-gray-800 mb-6 uppercase tracking-tight">Send us a message</h3>
                
                @if(session('success'))
                    <div class="bg-green-50 text-green-700 p-4 rounded-lg mb-6 text-sm border-l-4 border-green-500">
                        <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
                    </div>
                @endif
                
                <form action="#" method="POST" class="space-y-6">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="name" class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Your Name</label>
                            <input type="text" id="name" name="name" required class="w-full bg-gray-50 border border-gray-200 text-gray-900 text-sm rounded-lg focus:ring-secondary focus:border-secondary block p-3 transition-colors" placeholder="John Doe">
                        </div>
                        <div>
                            <label for="email" class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Your Email</label>
                            <input type="email" id="email" name="email" required class="w-full bg-gray-50 border border-gray-200 text-gray-900 text-sm rounded-lg focus:ring-secondary focus:border-secondary block p-3 transition-colors" placeholder="john@example.com">
                        </div>
                    </div>
                    
                    <div>
                        <label for="subject" class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Subject</label>
                        <input type="text" id="subject" name="subject" required class="w-full bg-gray-50 border border-gray-200 text-gray-900 text-sm rounded-lg focus:ring-secondary focus:border-secondary block p-3 transition-colors" placeholder="How can we help you?">
                    </div>
                    
                    <div>
                        <label for="message" class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Message</label>
                        <textarea id="message" name="message" rows="5" required class="w-full bg-gray-50 border border-gray-200 text-gray-900 text-sm rounded-lg focus:ring-secondary focus:border-secondary block p-3 transition-colors resize-none" placeholder="Write your message here..."></textarea>
                    </div>
                    
                    <button type="submit" class="w-full bg-secondary text-white font-bold py-3 px-6 rounded-lg hover:bg-red-700 transition shadow-lg shadow-red-500/30 uppercase tracking-widest text-sm flex items-center justify-center gap-2 group">
                        <span>Send Message</span>
                        <i class="fas fa-paper-plane group-hover:translate-x-1 transition-transform"></i>
                    </button>
                </form>
            </div>
            
        </div>
    </div>
</section>

<!-- Map Section (Optional Placeholder) -->
<section class="h-96 w-full bg-gray-200 relative">
    <div class="absolute inset-0 flex items-center justify-center bg-gray-100">
        <div class="text-center text-gray-400">
            <i class="fas fa-map-marked-alt text-5xl mb-4 text-gray-300"></i>
            <p class="font-medium">Google Maps Integration Area</p>
        </div>
    </div>
</section>

@endsection
