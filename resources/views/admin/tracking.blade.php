@extends('layouts.app')

@section('title', 'Tracking Mobil Real-Time')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Tracking Mobil Real-Time</h1>
        <p class="text-gray-600 mt-2">Monitor lokasi semua mobil (Dummy/Statis)</p>
    </div>

    <!-- Info Banner -->
    <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 mb-6">
        <div class="flex items-start">
            <svg class="w-5 h-5 text-yellow-600 mt-0.5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
            </svg>
            <div>
                <h3 class="text-sm font-medium text-yellow-800">Tracking Dummy/Statis</h3>
                <p class="text-sm text-yellow-700 mt-1">
                    Fitur ini saat ini menggunakan data statis. Untuk implementasi GPS real-time, lihat dokumentasi integrasi di 
                    <span class="font-semibold">03-DATABASE-PAYMENT-INTEGRATION.md</span>
                </p>
            </div>
        </div>
    </div>

    <!-- Map Placeholder -->
    <div class="bg-white rounded-lg shadow-lg p-8 mb-6">
        <div class="bg-gray-100 rounded-lg h-96 flex items-center justify-center">
            <div class="text-center">
                <svg class="mx-auto h-24 w-24 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"></path>
                </svg>
                <h3 class="mt-4 text-lg font-medium text-gray-900">Map Placeholder</h3>
                <p class="mt-2 text-gray-600">Integrasi dengan Google Maps/Mapbox akan ditampilkan di sini</p>
                <p class="mt-1 text-sm text-gray-500">Lihat dokumentasi untuk implementasi GPS real-time</p>
            </div>
        </div>
    </div>

    <!-- Cars List with Location -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($trackingData as $data)
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="p-6">
                <!-- Car Info -->
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <h3 class="text-lg font-bold text-gray-900">{{ $data['car']->full_name }}</h3>
                        <p class="text-sm text-gray-600">{{ $data['car']->license_plate }}</p>
                    </div>
                    <span class="px-3 py-1 text-xs rounded-full
                        @if($data['car']->status === 'available') bg-green-100 text-green-800
                        @elseif($data['car']->status === 'rented') bg-blue-100 text-blue-800
                        @else bg-yellow-100 text-yellow-800
                        @endif">
                        {{ ucfirst($data['car']->status) }}
                    </span>
                </div>

                <!-- Location Info -->
                <div class="space-y-3 mb-4">
                    <div class="flex items-start">
                        <svg class="w-5 h-5 text-gray-400 mr-2 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path>
                        </svg>
                        <div class="flex-1">
                            <p class="text-sm font-medium text-gray-900">Lokasi</p>
                            <p class="text-sm text-gray-600">{{ $data['location']['address'] }}</p>
                            <p class="text-xs text-gray-500 mt-1">
                                Lat: {{ number_format($data['location']['latitude'], 4) }}, 
                                Lng: {{ number_format($data['location']['longitude'], 4) }}
                            </p>
                        </div>
                    </div>

                    <div class="flex items-center justify-between text-sm">
                        <span class="text-gray-600">Kecepatan (Dummy):</span>
                        <span class="font-medium text-gray-900">{{ $data['speed'] }} km/h</span>
                    </div>

                    <div class="flex items-center justify-between text-sm">
                        <span class="text-gray-600">Update Terakhir:</span>
                        <span class="font-medium text-gray-900">{{ $data['last_update']->diffForHumans() }}</span>
                    </div>
                </div>

                <!-- Order Info (if rented) -->
                @if($data['car']->status === 'rented' && $data['car']->activeOrder)
                <div class="border-t pt-4">
                    <p class="text-sm font-medium text-gray-900 mb-2">Disewa oleh:</p>
                    <div class="bg-blue-50 rounded-lg p-3">
                        <p class="text-sm font-medium text-blue-900">
                            {{ $data['car']->activeOrder->customer->name ?? 'N/A' }}
                        </p>
                        <p class="text-xs text-blue-700 mt-1">
                            Order: {{ $data['car']->activeOrder->order_number }}
                        </p>
                    </div>
                </div>
                @endif

                <!-- Action Button -->
                <div class="mt-4">
                    <button 
                        class="w-full bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition"
                        onclick="alert('Akan membuka detail lokasi di map untuk {{ $data['car']->full_name }}')"
                    >
                        📍 Lihat di Map
                    </button>
                </div>
            </div>
        </div>
        @empty
        <div class="col-span-3 bg-white rounded-lg shadow p-12 text-center">
            <svg class="mx-auto h-16 w-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"></path>
            </svg>
            <h3 class="mt-4 text-xl font-medium text-gray-900">Belum Ada Data Tracking</h3>
            <p class="mt-2 text-gray-600">Tambahkan mobil untuk memulai tracking</p>
        </div>
        @endforelse
    </div>

    <!-- Integration Guide -->
    <div class="mt-8 bg-blue-50 border border-blue-200 rounded-lg p-6">
        <h3 class="text-lg font-semibold text-blue-900 mb-3">💡 Cara Implementasi GPS Real-Time</h3>
        <div class="space-y-2 text-sm text-blue-800">
            <p>1. Pasang GPS device di setiap mobil</p>
            <p>2. GPS device mengirim koordinat ke server via API</p>
            <p>3. Update data `current_location` di database MongoDB</p>
            <p>4. Integrasi dengan Google Maps API atau Mapbox</p>
            <p>5. Tampilkan marker mobil di map dengan koordinat real-time</p>
        </div>
        <div class="mt-4">
            <a href="#" class="text-blue-600 hover:text-blue-800 font-medium">
                📚 Baca dokumentasi lengkap di 03-DATABASE-PAYMENT-INTEGRATION.md
            </a>
        </div>
    </div>
</div>
@endsection