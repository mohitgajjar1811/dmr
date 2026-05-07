<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login | DMR Metal Corporation</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700;900&display=swap');
        body { font-family: 'Inter', sans-serif; background-color: #f3f4f6; }
        .bg-pattern { background-image: radial-gradient(#cbd5e1 1px, transparent 1px); background-size: 20px 20px; }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center bg-gray-100 relative overflow-hidden">
    <!-- Decorative background elements -->
    <div class="absolute inset-0 bg-pattern opacity-50 z-0"></div>
    <div class="absolute top-0 right-0 -mt-20 -mr-20 w-96 h-96 bg-red-600 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob z-0"></div>
    <div class="absolute bottom-0 left-0 -mb-20 -ml-20 w-96 h-96 bg-blue-900 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob animation-delay-2000 z-0"></div>

    <div class="relative z-10 w-full max-w-md p-8">
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
            <!-- Header -->
            <div class="bg-gray-900 px-8 py-10 text-center relative overflow-hidden">
                <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-red-600 to-red-400"></div>
                <h1 class="text-3xl font-black text-white uppercase tracking-wider mb-2">Admin <span class="text-red-500">Panel</span></h1>
                <p class="text-sm text-gray-400 font-medium">Secure Access Portal</p>
            </div>

            <!-- Form -->
            <div class="p-8">
                @if(session('error'))
                    <div class="bg-red-50 text-red-700 p-4 rounded-lg mb-6 text-sm font-bold border-l-4 border-red-500 flex items-center">
                        <i class="fas fa-exclamation-circle mr-2"></i> {{ session('error') }}
                    </div>
                @endif
                
                @if ($errors->any())
                    <div class="bg-red-50 text-red-700 p-4 rounded-lg mb-6 text-sm font-bold border-l-4 border-red-500 flex flex-col justify-center">
                        @foreach ($errors->all() as $error)
                            <span><i class="fas fa-exclamation-circle mr-2"></i> {{ $error }}</span>
                        @endforeach
                    </div>
                @endif

                <form method="POST" action="{{ route('admin.login.post') }}">
                    @csrf
                    <div class="mb-6">
                        <label for="username" class="block text-xs font-bold text-gray-500 uppercase tracking-widest mb-2">Username or Email</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-user text-gray-400"></i>
                            </div>
                            <input type="text" id="username" name="username" required value="{{ old('username') }}"
                                class="w-full bg-gray-50 border border-gray-200 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block pl-10 p-3 outline-none transition-all" placeholder="admin">
                        </div>
                    </div>

                    <div class="mb-8">
                        <div class="flex justify-between items-center mb-2">
                            <label for="password" class="block text-xs font-bold text-gray-500 uppercase tracking-widest">Password</label>
                        </div>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-lock text-gray-400"></i>
                            </div>
                            <input type="password" id="password" name="password" required
                                class="w-full bg-gray-50 border border-gray-200 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block pl-10 p-3 outline-none transition-all" placeholder="••••••••">
                        </div>
                    </div>

                    <div class="flex items-center justify-between mb-8">
                        <label class="flex items-center text-sm">
                            <input type="checkbox" name="remember" class="w-4 h-4 text-red-600 bg-gray-100 border-gray-300 rounded focus:ring-red-500">
                            <span class="ml-2 font-medium text-gray-600">Remember me</span>
                        </label>
                    </div>

                    <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white font-bold py-3 px-4 rounded-lg shadow-lg shadow-red-500/30 transition-all transform hover:-translate-y-0.5 flex items-center justify-center gap-2 uppercase tracking-wider text-sm">
                        <span>Sign In</span>
                        <i class="fas fa-arrow-right"></i>
                    </button>
                </form>
            </div>
            
            <div class="bg-gray-50 p-4 border-t border-gray-100 text-center">
                <a href="{{ route('home') }}" class="text-xs font-bold text-gray-500 hover:text-gray-900 uppercase tracking-widest transition-colors">
                    <i class="fas fa-arrow-left mr-1"></i> Return to Main Site
                </a>
            </div>
        </div>
        
        <div class="mt-6 text-center">
            <p class="text-xs text-gray-400 font-medium"> DMR Metal Corporation &copy; {{ date('Y') }}. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
