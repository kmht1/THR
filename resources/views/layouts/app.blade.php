<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" 
      dir="{{ in_array(app()->getLocale(), ['ar']) ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>THR - The Hidden Reel</title>
    
    <!-- TailwindCSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <style>
        .line-clamp-3 {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        
        [dir="rtl"] .rtl-flip {
            transform: scaleX(-1);
        }
    </style>
</head>
<body class="bg-gray-900 text-white">
    <!-- Navigation -->
    <nav class="bg-gray-800/90 backdrop-blur-sm sticky top-0 z-50">
        <div class="container mx-auto px-4">
            <div class="flex items-center justify-between h-16">
                <!-- Logo -->
                <a href="{{ route('home') }}" class="text-xl font-bold text-red-600">THR</a>
                
                <!-- Navigation Links -->
                <div class="hidden md:flex space-x-6">
                    <a href="{{ route('home') }}" class="hover:text-red-400">{{ __('Home') }}</a>
                    <a href="{{ route('movies.index') }}" class="hover:text-red-400">{{ __('Movies') }}</a>
                    <a href="{{ route('tv.index') }}" class="hover:text-red-400">{{ __('TV Shows') }}</a>
                    <a href="{{ route('anime.index') }}" class="hover:text-red-400">{{ __('Anime') }}</a>
                </div>
                
                <!-- Search & Auth -->
                <div class="flex items-center space-x-4">
                    <!-- Search Bar -->
                    <livewire:search-bar />
                    
                    <!-- Language Switcher -->
                    <select class="bg-gray-700 text-white px-3 py-1 rounded text-sm">
                        <option value="en">EN</option>
                        <option value="es">ES</option>
                        <option value="fr">FR</option>
                        <option value="ar">AR</option>
                    </select>
                    
                    <!-- Auth Links -->
                    @auth
                        <a href="{{ route('profile') }}" class="hover:text-red-400">{{ __('Profile') }}</a>
                    @else
                        <a href="{{ route('login') }}" class="hover:text-red-400">{{ __('Login') }}</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Page Content -->
    <main>
        {{ $slot }}
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 mt-16 py-8">
        <div class="container mx-auto px-4 text-center text-gray-400">
            <p>&copy; {{ date('Y') }} THR - The Hidden Reel. {{ __('All rights reserved.') }}</p>
            <div class="mt-4 space-x-4">
                <a href="#" class="hover:text-white">{{ __('Privacy Policy') }}</a>
                <a href="#" class="hover:text-white">{{ __('Terms of Service') }}</a>
                <a href="#" class="hover:text-white">{{ __('Contact') }}</a>
            </div>
        </div>
    </footer>
</body>
</html>