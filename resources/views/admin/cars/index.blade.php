@extends('layouts.app')

@section('title', 'Manajemen Mobil')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <!-- Header -->
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Manajemen Mobil</h1>
            <p class="text-gray-600 mt-2">Kelola data mobil rental</p>
        </div>
        <a href="{{ route('admin.cars.create') }}" class="bg-blue-500 text-white px-6 py-3 rounded-lg hover:bg-blue-600 transition shadow-lg">
            ➕ Tambah Mobil
        </a>
    </div>

    @if(session('success'))
        <div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="mb-6 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg">
            {{ session('error') }}
        </div>
    @endif

    <!-- Filter & Search -->
    <div class="bg-white rounded-lg shadow p-4 mb-6">
        <form method="GET" action="{{ route('admin.cars.index') }}" class="flex gap-4">
            <input 
                type="text" 
                name="search" 
                placeholder="Cari brand atau model..." 
                value="{{ request('search') }}"
                class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
            >
            <select name="status" class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="">Semua Status</option>
                <option value="available" {{ request('status') == 'available' ? 'selected' : '' }}>Available</option>
                <option value="rented" {{ request('status') == 'rented' ? 'selected' : '' }}>Rented</option>
                <option value="maintenance" {{ request('status') == 'maintenance' ? 'selected' : '' }}>Maintenance</option>
            </select>
            <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600">
                Cari
            </button>
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
                    <span class="text-gray-400 text-4xl">🚗</span>
                </div>
            @endif

            <!-- Car Info -->
            <div class="p-6">
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <h3 class="text-xl font-bold text-gray-900">{{ $car->full_name }}</h3>
                        <p class="text-gray-600 text-sm">{{ $car->license_plate }}</p>
                    </div>
                    <span class="px-3 py-1 text-xs rounded-full
                        @if($car->status === 'available') bg-green-100 text-green-800
                        @elseif($car->status === 'rented') bg-blue-100 text-blue-800
                        @else bg-yellow-100 text-yellow-800
                        @endif">
                        {{ ucfirst($car->status) }}
                    </span>
                </div>

                <div class="space-y-2 text-sm mb-4">
                    <div class="flex justify-between">
                        <span class="text-gray-600">Warna:</span>
                        <span class="font-medium">{{ $car->color }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Kursi:</span>
                        <span class="font-medium">{{ $car->seats }} seats</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Transmisi:</span>
                        <span class="font-medium">{{ ucfirst($car->transmission) }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Bahan Bakar:</span>
                        <span class="font-medium">{{ ucfirst($car->fuel_type) }}</span>
                    </div>
                </div>

                <div class="border-t pt-4 mb-4">
                    <p class="text-2xl font-bold text-blue-600">
                        Rp {{ number_format($car->price_per_day, 0, ',', '.') }}
                        <span class="text-sm text-gray-600 font-normal">/hari</span>
                    </p>
                </div>

                <!-- Actions -->
                <div class="flex gap-2">
                    <a href="{{ route('admin.cars.show', $car->_id) }}" class="flex-1 bg-blue-500 text-white text-center px-4 py-2 rounded-lg hover:bg-blue-600 transition">
                        Detail
                    </a>
                    <a href="{{ route('admin.cars.edit', $car->_id) }}" class="flex-1 bg-yellow-500 text-white text-center px-4 py-2 rounded-lg hover:bg-yellow-600 transition">
                        Edit
                    </a>
                    <form action="{{ route('admin.cars.destroy', $car->_id) }}" method="POST" class="flex-1" onsubmit="return confirm('Yakin ingin menghapus mobil ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition">
                            Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @empty
        <div class="col-span-3 bg-white rounded-lg shadow p-12 text-center">
            <svg class="mx-auto h-16 w-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
            </svg>
            <h3 class="mt-4 text-xl font-medium text-gray-900">Belum Ada Mobil</h3>
            <p class="mt-2 text-gray-600">Tambahkan mobil pertama Anda untuk memulai</p>
            <a href="{{ route('admin.cars.create') }}" class="mt-6 inline-block bg-blue-500 text-white px-6 py-3 rounded-lg hover:bg-blue-600">
                Tambah Mobil
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