<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Rental Mobil')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50">
    <nav class="bg-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="/" class="text-2xl font-bold text-primary">
                        🚗 Rental Mobil
                    </a>
                </div>
                <div class="flex items-center space-x-4">
                    @guest
                        <a href="/login" class="text-gray-700 hover:text-primary">Login</a>
                        <a href="/register" class="btn-primary">Daftar</a>
                    @else
                        <span class="text-gray-700">{{ Auth::user()->name }}</span>
                        <form action="/logout" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="text-gray-700 hover:text-danger">Logout</button>
                        </form>
                    @endguest
                </div>
            </div>
        </div>
    </nav>

    <main class="py-8">
        @yield('content')
    </main>

    <footer class="bg-gray-800 text-white py-6 mt-12">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <p>&copy; 2024 Rental Mobil. All rights reserved.</p>
        </div>
    </footer>

    @yield('scripts')
</body>
</html>