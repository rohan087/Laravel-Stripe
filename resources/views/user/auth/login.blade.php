@extends('layouts.app')

@section('content')
    <div class="max-w-md mx-auto bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        <h2 class="text-2xl font-bold mb-6">User Login</h2>
        @if ($errors->any())
            <div class="bg-red-100 text-red-800 p-4 rounded mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form method="POST" action="{{ route('user.login.submit') }}">
            @csrf
            <div class="mb-4">
                <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email:</label>
                <input type="email" name="email" id="email" value="user@example.com" 
                       class="shadow appearance-none border border-gray-300 rounded w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                       required>
            </div>
            <div class="mb-4">
                <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Password:</label>
                <input type="password" name="password" id="password" value="password" 
                       class="shadow appearance-none border border-gray-300 rounded w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                       required>
            </div>
            <div class="flex items-center justify-between">
                <button type="submit" 
                        class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Login
                </button>
            </div>
        </form>
        <p class="mt-4 text-gray-600 text-sm">
            <strong>Demo Login Details:</strong><br>
            Email: <code>user@example.com</code><br>
            Password: <code>password</code>
        </p>
    </div>
@endsection
