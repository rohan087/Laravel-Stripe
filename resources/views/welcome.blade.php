<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel Stripe Demo</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 font-sans antialiased">
    <div class="min-h-screen flex flex-col justify-center items-center">
        <header class="text-center mb-8">
            <h1 class="text-5xl font-extrabold text-gray-800">Welcome to Laravel Stripe Demo</h1>
            <p class="text-lg text-gray-600 mt-4">
                A corporate-themed demo application showcasing Stripe integration with Laravel.
            </p>
        </header>
        <div class="flex space-x-6">
            <a href="{{ route('user.login') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-6 rounded-lg shadow-md">
                User Login
            </a>
            <a href="{{ route('admin.login') }}" class="bg-green-600 hover:bg-green-700 text-white font-semibold py-3 px-6 rounded-lg shadow-md">
                Admin Login
            </a>
        </div>
    </div>
</body>
</html>