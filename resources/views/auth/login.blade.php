@extends('layouts.app')

@section('title', 'Login - Rental Mobil')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-50 to-blue-100 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8">
        <div>
            <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
                🚗 Rental Mobil
            </h2>
            <p class="mt-2 text-center text-sm text-gray-600">
                Silakan login ke akun Anda
            </p>
        </div>

        <div class="bg-white rounded-lg shadow-xl p-8">
            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
                    {{ session('error') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                        Email
                    </label>
                    <input 
                        id="email" 
                        name="email" 
                        type="email" 
                        required 
                        value="{{ old('email') }}"
                        class="input-field @error('email') border-red-500 @enderror"
                        placeholder="email@example.com"
                    >
                    @error('email')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                        Password
                    </label>
                    <input 
                        id="password" 
                        name="password" 
                        type="password" 
                        required 
                        class="input-field @error('password') border-red-500 @enderror"
                        placeholder="Masukkan password"
                    >
                    @error('password')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input 
                            id="remember" 
                            name="remember" 
                            type="checkbox" 
                            class="h-4 w-4 text-primary focus:ring-primary border-gray-300 rounded"
                        >
                        <label for="remember" class="ml-2 block text-sm text-gray-900">
                            Ingat saya
                        </label>
                    </div>
                </div>

                <div>
                    <button type="submit" class="w-full btn-primary py-3 text-lg">
                        Login
                    </button>
                </div>
            </form>

            <div class="mt-6">
                <p class="text-center text-sm text-gray-600">
                    Belum punya akun?
                    <a href="{{ route('register') }}" class="font-medium text-primary hover:text-blue-700">
                        Daftar sekarang
                    </a>
                </p>
            </div>

            <!-- Demo Accounts -->
            <div class="mt-8 pt-6 border-t border-gray-200">
                <p class="text-xs text-gray-500 text-center mb-3">Demo Accounts:</p>
                <div class="space-y-2 text-xs text-gray-600">
                    <div class="bg-gray-50 p-2 rounded">
                        <strong>Admin:</strong> admin@rental.com | password123
                    </div>
                    <div class="bg-gray-50 p-2 rounded">
                        <strong>Driver:</strong> driver1@rental.com | password123
                    </div>
                    <div class="bg-gray-50 p-2 rounded">
                        <strong>Customer:</strong> customer1@gmail.com | password123
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection