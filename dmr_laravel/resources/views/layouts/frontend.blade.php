<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', $company_info->name ?? 'Virja Industries')</title>
    <!-- Tailwind CSS (CDN for development) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#1a365d', /* Navy Blue */
                        secondary: '#c53030', /* Industrial Red */
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                        tech: ['Rajdhani', 'sans-serif'],
                        modern: ['Outfit', 'sans-serif'],
                    },
                    keyframes: {
                        marquee: {
                            '0%': { transform: 'translateX(0)' },
                            '100%': { transform: 'translateX(-50%)' },
                        }
                    },
                    animation: {
                        marquee: 'marquee 30s linear infinite',
                    }
                }
            }
        }
    </script>
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700;900&family=Outfit:wght@400;500;700&family=Rajdhani:wght@500;600;700&display=swap"
        rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        [x-cloak] {
            display: none !important;
        }

        .text-shadow-md {
            text-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .bg-pattern {
            background-image: radial-gradient(#ffffff 1px, transparent 1px);
            background-size: 20px 20px;
        }
    </style>
</head>

<body class="flex flex-col min-h-screen bg-gray-50 text-gray-800 overflow-x-hidden"
    x-data="{ cartCount: {{ $cart_items_count ?? 0 }}, cartAnimating: false }"
    @updated-cart.window="cartCount = $event.detail.count; cartAnimating = true; setTimeout(() => cartAnimating = false, 300)">

    <!-- Top Bar -->
    <div class="bg-primary text-white py-2 border-b border-gray-800">
        <div class="container mx-auto px-4 flex justify-between items-center text-[10px] md:text-xs relative">
            <!-- Left: Email & Location -->
            <div class="flex items-center gap-6">
                <a href="https://mail.google.com/mail/?view=cm&fs=1&to={{ $company_info->email ?? 'info@virjaautomation.com' }}"
                    target="_blank" class="flex items-center gap-2 hover:text-secondary transition text-white">
                    <i class="fas fa-envelope text-secondary"></i>
                    <span class="font-medium tracking-wide">{{ $company_info->email ?? 'info@virjaautomation.com' }}</span>
                </a>
                <a href="https://www.google.com/maps/search/?api=1&query={{ urlencode($company_info->address ?? 'Pune, India') }}"
                    target="_blank"
                    class="hidden md:flex items-center gap-2 text-white hover:text-secondary transition">
                    <i class="fas fa-map-marker-alt text-secondary"></i>
                    <span class="font-medium tracking-wide">Pune, India</span>
                </a>
            </div>

            <!-- Center: Company Name -->
            <div class="absolute left-1/2 -translate-x-1/2 text-white font-tech font-bold tracking-wider sm:tracking-widest uppercase text-[8px] sm:text-xs md:text-sm whitespace-nowrap">
                DMR Metal Corporation
            </div>

            <!-- Right: Social Media -->
            <div class="flex items-center gap-4">
                <div class="flex gap-4">
                    @if($company_info->facebook ?? false)
                        <a href="{{ $company_info->facebook }}" target="_blank" class="hover:text-secondary transition text-white"><i class="fab fa-facebook-f"></i></a>
                    @endif
                    @if($company_info->linkedin ?? false)
                        <a href="{{ $company_info->linkedin }}" target="_blank" class="hover:text-secondary transition text-white"><i class="fab fa-linkedin-in"></i></a>
                    @endif
                    @if($company_info->instagram ?? false)
                        <a href="{{ $company_info->instagram }}" target="_blank" class="hover:text-secondary transition text-white"><i class="fab fa-instagram"></i></a>
                    @endif
                    @if(!($company_info->facebook ?? false) && !($company_info->linkedin ?? false))
                        <a href="#" class="hover:text-secondary transition text-white"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="hover:text-secondary transition text-white"><i class="fab fa-linkedin-in"></i></a>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Header -->
    <header class="bg-white shadow-md relative z-50 sticky top-0" x-data="{ mobileMenuOpen: false }">
        <div class="container mx-auto px-4 py-3 flex justify-between items-center">
            <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                @if($company_info->logo ?? false)
                    <img src="{{ asset('storage/' . $company_info->logo) }}" alt="Logo" class="h-10 w-auto">
                @else
                    <img src="{{ asset('img/virja_logo.png') }}" alt="Logo" class="h-10 w-auto">
                @endif
            </a>

            <!-- Search Bar -->
            <div class="hidden md:block flex-1 max-w-2xl mx-4 lg:mx-8">
                <form action="{{ route('products') }}" method="GET" class="flex w-full relative group">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-search text-gray-400 group-focus-within:text-primary"></i>
                    </div>
                    <input type="text" name="q" placeholder="Search products..."
                        class="w-full border-2 border-gray-100 bg-gray-50 rounded-md pl-10 pr-4 py-2.5 focus:border-primary text-sm font-medium">
                    <button type="submit" class="absolute right-1 top-1 bottom-1 bg-white text-primary font-bold px-4 rounded border border-gray-100">Find</button>
                </form>
            </div>

            <div class="flex items-center gap-6">
                <div class="hidden xl:block text-right">
                    <div class="text-[0.6rem] text-gray-400 font-bold uppercase tracking-wider">Sales Support</div>
                    <a href="tel:{{ $company_info->phone ?? '+911234567890' }}" class="block text-sm font-black text-gray-800">{{ $company_info->phone ?? '+91 123 456 7890' }}</a>
                </div>
                <a href="#" class="bg-secondary text-white px-4 py-2.5 rounded shadow-lg font-bold text-sm flex items-center relative">
                    <i class="fas fa-shopping-cart"></i>
                    <span class="hidden md:ml-2 md:inline">Cart</span>
                    <span x-text="cartCount" class="absolute -top-2 -right-2 bg-gray-900 border-2 border-white text-white rounded-full w-5 h-5 flex items-center justify-center text-[10px] font-black"></span>
                </a>
            </div>
        </div>

        <!-- Desktop Nav -->
        <nav class="bg-primary text-white hidden md:block">
            <div class="container mx-auto px-4">
                <ul class="flex">
                    <li><a href="{{ route('home') }}" class="block py-3 px-6 text-sm font-bold uppercase hover:bg-white hover:text-primary transition">Home</a></li>
                    <li><a href="{{ route('products') }}" class="block py-3 px-6 text-sm font-bold uppercase hover:bg-white hover:text-primary transition">Products</a></li>
                    <li><a href="{{ route('admin.brand.list') }}" class="block py-3 px-6 text-sm font-bold uppercase hover:bg-white hover:text-primary transition">Brands</a></li>
                    <li><a href="{{ route('about') }}" class="block py-3 px-6 text-sm font-bold uppercase hover:bg-white hover:text-primary transition">About Us</a></li>
                </ul>
            </div>
        </nav>
    </header>

    <!-- Main Content -->
    <main class="flex-grow">
        @if(session('success'))
            <div class="container mx-auto px-4 mt-4">
                <div class="bg-green-100 text-green-700 p-4 rounded border-l-4 border-green-500 flex justify-between">
                    <span>{{ session('success') }}</span>
                </div>
            </div>
        @endif
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-300 pt-10 pb-6 border-t-4 border-secondary">
        <div class="container mx-auto px-4 grid grid-cols-1 md:grid-cols-4 gap-8">
            <div>
                <h3 class="text-white text-lg font-bold mb-4 uppercase">{{ $company_info->name ?? 'Virja Industries' }}</h3>
                <p class="text-sm text-gray-400 leading-relaxed">{{ $company_info->footer_description ?? 'Leading supplier of industrial safety gear.' }}</p>
            </div>
            <div>
                <h3 class="text-white text-lg font-bold mb-4 uppercase">Quick Links</h3>
                <ul class="space-y-2 text-sm">
                    <li><a href="{{ route('products') }}" class="hover:text-secondary">Products</a></li>
                    <li><a href="{{ route('about') }}" class="hover:text-secondary">About Us</a></li>
                </ul>
            </div>
            <div>
                <h3 class="text-white text-lg font-bold mb-4 uppercase">Contact</h3>
                <ul class="space-y-4 text-sm">
                    <li><i class="fas fa-map-marker-alt text-secondary mr-3"></i> {{ $company_info->address ?? 'Pune, India' }}</li>
                    <li><i class="fas fa-phone text-secondary mr-3"></i> {{ $company_info->phone ?? '+91 123 456 7890' }}</li>
                </ul>
            </div>
            <div>
                <h3 class="text-white text-lg font-bold mb-4 uppercase">Newsletter</h3>
                <form action="#" method="POST" class="flex flex-col space-y-2">
                    @csrf
                    <input type="email" name="email" placeholder="Email address" class="px-4 py-2.5 rounded bg-gray-800 border border-gray-700 text-white">
                    <button type="submit" class="bg-secondary text-white py-2.5 rounded font-bold hover:bg-red-700">Subscribe</button>
                </form>
            </div>
        </div>
    </footer>
</body>
</html>
