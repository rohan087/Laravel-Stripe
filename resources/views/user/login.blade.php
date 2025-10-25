<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}"> <!-- Adjust if needed -->
</head>
<body>
    <div class="min-h-screen flex items-center justify-center bg-gray-100">
        <div class="bg-white p-8 rounded shadow-md w-full max-w-md">
            <h1 class="text-2xl font-bold mb-6 text-center">User Login</h1>
            <form action="{{ route('user.login.submit') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" id="email" name="email" value="user@example.com" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                </div>
                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input type="password" id="password" name="password" value="password" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                </div>
                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded">
                    Login
                </button>
            </form>
        </div>
    </div>
</body>
</html>
