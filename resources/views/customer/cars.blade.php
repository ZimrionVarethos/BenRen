@extends('layouts.app')

@section('title', 'Browse Mobil')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Browse Mobil</h1>
        <p class="text-gray-600 mt-2">Temukan mobil yang sesuai untuk perjalanan Anda</p>
    </div>

    <!-- Filter & Search -->
    <div class="bg-white rounded-lg shadow p-6 mb-8">
        <form method="GET" action="{{ route('customer.cars') }}" class="space-y-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <!-- Search -->
                <div class="md:col-span-2">
                    <input 
                        type="text" 
                        name="search" 
                        placeholder="Cari brand atau model..." 
                        value="{{ request('search') }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    >
                </div>

                <!-- Transmission Filter -->
                <div>
                    <select name="transmission" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Semua Transmisi</option>
                        <option value="manual" {{ request('transmission') == 'manual' ? 'selected' : '' }}>Manual</option>
                        <option value="automatic" {{ request('transmission') == 'automatic' ? 'selected' : '' }}>Automatic</option>
                    </select>
                </div>

                <!-- Fuel Type Filter -->
                <div>
                    <select name="fuel_type" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Semua Bahan Bakar</option>
                        <option value="bensin" {{ request('fuel_type') == 'bensin' ? 'selected' : '' }}>Bensin</option>
                        <option value="diesel" {{ request('fuel_type') == 'diesel' ? 'selected' : '' }}>Diesel</option>
                        <option value="electric" {{ request('fuel_type') == 'electric' ? 'selected' : '' }}>Electric</option>
                    </select>
                </div>
            </div>

            <!-- Price Range -->
            <div class="flex items-center gap-4">
                <label class="text-sm font-medium text-gray-700">Harga Maksimal:</label>
                <input 
                    type="number" 
                    name="max_price" 
                    placeholder="500000" 
                    value="{{ request('max_price') }}"
                    class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                >
                <button type="submit" class="bg-blue-500 text-white px-8 py-2 rounded-lg hover:bg-blue-600 transition">
                    Cari
                </button>
                <a href="{{ route('customer.cars') }}" class="text-gray-600 hover:text-gray-800">
                    Reset
                </a>
            </div>
        </form>
    </div>

    <!-- Cars Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($cars as $car)
        <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition">
            <!-- Car Image -->
            @if($car->images && count($car->images) > 0)
                <img src="{{ $car->images[0] }}" alt="{{ $car->full_name }}" class="w-full h-48 object-cover">
            @else
                <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                    <span class="text-gray-400 text-5xl">🚗</span>
                </div>
            @endif

            <!-- Car Info -->
            <div class="p-6">
                <div class="mb-4">
                    <h3 class="text-xl font-bold text-gray-900">{{ $car->full_name }}</h3>
                    <p class="text-gray-600 text-sm">{{ $car->color }} • {{ $car->license_plate }}</p>
                </div>

                <!-- Specs -->
                <div class="grid grid-cols-2 gap-3 mb-4 text-sm">
                    <div class="flex items-center text-gray-600">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                        {{ $car->seats }} seats
                    </div>
                    <div class="flex items-center text-gray-600">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                        {{ ucfirst($car->transmission) }}
                    </div>
                    <div class="flex items-center text-gray-600">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                        </svg>
                        {{ ucfirst($car->fuel_type) }}
                    </div>
                    <div class="flex items-center text-gray-600">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        {{ $car->year }}
                    </div>
                </div>

                <!-- Features -->
                @if($car->features && count($car->features) > 0)
                <div class="mb-4">
                    <div class="flex flex-wrap gap-2">
                        @foreach(array_slice($car->features, 0, 3) as $feature)
                        <span class="px-2 py-1 bg-blue-50 text-blue-700 text-xs rounded">{{ $feature }}</span>
                        @endforeach
                        @if(count($car->features) > 3)
                        <span class="px-2 py-1 bg-gray-100 text-gray-600 text-xs rounded">+{{ count($car->features) - 3 }} more</span>
                        @endif
                    </div>
                </div>
                @endif

                <!-- Price & Action -->
                <div class="border-t pt-4">
                    <div class="flex justify-between items-center mb-4">
                        <div>
                            <p class="text-2xl font-bold text-blue-600">
                                Rp {{ number_format($car->price_per_day, 0, ',', '.') }}
                            </p>
                            <p class="text-sm text-gray-600">per hari</p>
                        </div>
                    </div>
                    <div class="flex gap-2">
                        <a href="{{ route('customer.cars.show', $car->_id) }}" class="flex-1 bg-gray-200 text-gray-700 text-center px-4 py-2 rounded-lg hover:bg-gray-300 transition">
                            Detail
                        </a>
                        <a href="{{ route('customer.booking.form', $car->_id) }}" class="flex-1 bg-blue-500 text-white text-center px-4 py-2 rounded-lg hover:bg-blue-600 transition">
                            Sewa Sekarang
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-span-3 bg-white rounded-lg shadow p-12 text-center">
            <svg class="mx-auto h-16 w-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <h3 class="mt-4 text-xl font-medium text-gray-900">Tidak Ada Mobil Tersedia</h3>
            <p class="mt-2 text-gray-600">Coba ubah filter pencarian Anda</p>
            <a href="{{ route('customer.cars') }}" class="mt-4 inline-block text-blue-500 hover:text-blue-700">
                Reset Filter
            </a>
        </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($cars->hasPages())
    <div class="mt-8">
        {{ $cars->links() }}
    </div>
    @endif
</div>
@endsection