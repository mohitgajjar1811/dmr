<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard | DMR Admin')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        ::-webkit-scrollbar {
            width: 5px;
            height: 5px;
        }

        ::-webkit-scrollbar-track {
            background: transparent;
        }

        ::-webkit-scrollbar-thumb {
            background: rgba(156, 163, 175, 0.3);
            border-radius: 20px;
        }

        * {
            scrollbar-width: thin;
            scrollbar-color: rgba(156, 163, 175, 0.3) transparent;
        }
    </style>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.3/dist/cdn.min.js"></script>
    @yield('extra_head')
</head>

<body class="bg-gray-100 text-gray-800 font-sans antialiased" x-data="{ sidebarOpen: false }">
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
            class="fixed inset-y-0 left-0 z-30 w-64 bg-gray-900 text-white flex flex-col shadow-xl transition-transform duration-300 transform md:translate-x-0 md:static md:inset-auto">
            <div class="h-16 flex items-center justify-center border-b border-gray-800">
                <h1 class="text-xl font-bold tracking-wider text-white">DMR <span class="text-red-500">ADMIN</span></h1>
            </div>

            <nav class="flex-1 overflow-y-auto py-4">
                <ul class="space-y-1 px-2">
                    <li>
                        <a href="{{ route('admin.home') }}"
                            class="flex items-center gap-3 px-4 py-3 rounded hover:bg-gray-800 transition {{ request()->routeIs('admin.home') ? 'bg-gray-800 border-l-4 border-red-500' : '' }}">
                            <i class="fas fa-tachometer-alt w-5 text-center"></i>
                            <span class="font-medium">Dashboard</span>
                        </a>
                    </li>
                    <li class="pt-4 pb-2 px-4 text-xs font-bold text-gray-500 uppercase tracking-widest">Catalog</li>
                    <li>
                        <a href="{{ route('admin.product.list') }}"
                            class="flex items-center gap-3 px-4 py-3 rounded hover:bg-gray-800 transition {{ request()->routeIs('admin.product.*') ? 'bg-gray-800 text-white' : 'text-gray-300' }}">
                            <i class="fas fa-box w-5 text-center"></i>
                            <span class="font-medium">Products</span>
                        </a>
                    </li>

                    <li class="pt-4 pb-2 px-4 text-xs font-bold text-gray-500 uppercase tracking-widest">Leads & Contact
                    </li>
                    <li>
                        <a href="{{ route('admin.enquiry.list') }}"
                            class="flex items-center gap-3 px-4 py-3 rounded hover:bg-gray-800 transition {{ request()->routeIs('admin.enquiry.*') ? 'bg-gray-800 text-white' : 'text-gray-300' }}">
                            <i class="fas fa-envelope w-5 text-center"></i>
                            <span class="font-medium">Enquiries</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.newsletter.list') }}"
                            class="flex items-center gap-3 px-4 py-3 rounded hover:bg-gray-800 transition {{ request()->routeIs('admin.newsletter.*') ? 'bg-gray-800 text-white' : 'text-gray-300' }}">
                            <i class="fas fa-paper-plane w-5 text-center"></i>
                            <span class="font-medium">Newsletter</span>
                        </a>
                    </li>

                    <li class="pt-4 pb-2 px-4 text-xs font-bold text-gray-500 uppercase tracking-widest">Frontend
                        Content</li>
                    <li>
                        <a href="{{ route('admin.home.content') }}"
                            class="flex items-center gap-3 px-4 py-3 rounded-lg transition {{ request()->routeIs('admin.home.content') ? 'bg-red-50 text-red-600 font-bold' : 'text-gray-600 hover:bg-gray-50' }}">
                            <i class="fas fa-home w-5"></i>
                            <span class="text-sm">Home Page Content</span>
                        </a>
                        <a href="{{ route('admin.about.content') }}"
                            class="flex items-center gap-3 px-4 py-3 rounded-lg transition {{ request()->routeIs('admin.about.content') ? 'bg-red-50 text-red-600 font-bold' : 'text-gray-600 hover:bg-gray-50' }}">
                            <i class="fas fa-info-circle w-5"></i>
                            <span class="text-sm">About Page Content</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.banner.list') }}"
                            class="flex items-center gap-3 px-4 py-3 rounded hover:bg-gray-800 transition {{ request()->routeIs('admin.banner.*') ? 'bg-gray-800 text-white' : 'text-gray-300' }}">
                            <i class="fas fa-images w-5 text-center"></i>
                            <span class="font-medium">Banners</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.feature.list') }}"
                            class="flex items-center gap-3 px-4 py-3 rounded hover:bg-gray-800 transition {{ request()->routeIs('admin.feature.*') ? 'bg-gray-800 text-white' : 'text-gray-300' }}">
                            <i class="fas fa-star w-5 text-center"></i>
                            <span class="font-medium">Home Features</span>
                        </a>
                    </li>

                    <li class="pt-4 pb-2 px-4 text-xs font-bold text-gray-500 uppercase tracking-widest">Configuration
                    </li>
                    <li>
                        <a href="{{ route('admin.settings.site') }}"
                            class="flex items-center gap-3 px-4 py-3 rounded hover:bg-gray-800 transition {{ request()->routeIs('admin.settings.site') ? 'bg-gray-800 text-white' : 'text-gray-300' }}">
                            <i class="fas fa-cogs w-5 text-center"></i>
                            <span class="font-medium">Site Settings</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.settings.smtp') }}"
                            class="flex items-center gap-3 px-4 py-3 rounded hover:bg-gray-800 transition {{ request()->routeIs('admin.settings.smtp') ? 'bg-gray-800 text-white' : 'text-gray-300' }}">
                            <i class="fas fa-mail-bulk w-5 text-center"></i>
                            <span class="font-medium">SMTP Settings</span>
                        </a>
                    </li>

                </ul>
            </nav>

            <div class="p-4 border-t border-gray-800">
                <form action="{{ route('admin.logout') }}" method="POST">
                    @csrf
                    <button type="submit"
                        class="w-full flex items-center gap-3 px-4 py-2 rounded text-gray-400 hover:text-white hover:bg-red-900/50 transition">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Logout</span>
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <header class="h-16 bg-white shadow-sm flex items-center justify-between px-6 z-10">
                <button @click="sidebarOpen = !sidebarOpen" class="md:hidden text-xl text-gray-500"><i
                        class="fas fa-bars"></i></button>
                <div class="flex items-center gap-4">
                    <span class="text-sm font-medium text-gray-600">Welcome,
                        {{ Auth::user()->username ?? 'Admin' }}</span>
                </div>
            </header>

            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 p-6">
                @if(session('success'))
                    <div class="mb-6 p-4 bg-green-50 border-l-4 border-green-500 text-green-700">{{ session('success') }}
                    </div>
                @endif
                @yield('content')
            </main>
        </div>
    </div>
    @stack('scripts')
</body>

</html>