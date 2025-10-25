<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 font-sans antialiased">
    <div class="min-h-screen flex flex-col">
        <nav class="bg-white shadow-md">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16 items-center">
                    <div class="flex items-center">
                        <a href="{{ route('home') }}" class="text-2xl font-bold text-blue-600">
                            {{ config('app.name', 'Laravel') }}
                        </a>
                    </div>
                    <div class="flex items-center space-x-4">
                        @auth
                            @if(auth()->user()->hasRole('admin'))
                                <a href="{{ route('admin.dashboard') }}"
                                   class="text-gray-700 hover:text-blue-600 font-medium">
                                    Admin Dashboard
                                </a>
                            @else
                                <a href="{{ route('user.index') }}"
                                   class="text-gray-700 hover:text-blue-600 font-medium">
                                    User Dashboard
                                </a>
                            @endif
                            <form method="POST" action="{{ route('logout') }}" class="inline">
                                @csrf
                                <button type="submit" class="text-gray-700 hover:text-red-600 font-medium">
                                    Logout
                                </button>
                            </form>
                        @endauth
                    </div>
                </div>
            </div>
        </nav>

        <main class="flex-grow py-8">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                @yield('content')
            </div>
        </main>

        <footer class="bg-gray-800 text-white py-4">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <p>&copy; {{ date('Y') }} Laravel Stripe Demo. All rights reserved.</p>
            </div>
        </footer>
    </div>
</body>
</html>