@extends('layouts.app')

@section('title', 'Detail Order')

@section('content')
<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
    <!-- Header -->
    <div class="mb-8">
        <a href="{{ route('driver.dashboard') }}" class="text-blue-500 hover:text-blue-700 mb-4 inline-block">
            ← Kembali ke Dashboard
        </a>
        <div class="flex justify-between items-start">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Detail Order</h1>
                <p class="text-gray-600 mt-2">Order #{{ $order->order_number }}</p>
            </div>
            <span class="px-4 py-2 rounded-full text-sm font-medium
                @if($order->status === 'completed') bg-green-100 text-green-800
                @elseif($order->status === 'ongoing') bg-blue-100 text-blue-800
                @elseif($order->status === 'confirmed') bg-green-100 text-green-800
                @elseif($order->status === 'pending') bg-yellow-100 text-yellow-800
                @else bg-red-100 text-red-800
                @endif">
                {{ ucfirst($order->status) }}
            </span>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Customer Info -->
            <div class="bg-white rounded-lg shadow-lg p-6">
                <h2 class="text-xl font-semibold mb-4">Informasi Customer</h2>
                <div class="flex items-start gap-4">
                    <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center">
                        <span class="text-2xl">👤</span>
                    </div>
                    <div class="flex-1">
                        <h3 class="text-lg font-bold">{{ $order->customer->name ?? 'N/A' }}</h3>
                        <div class="mt-2 space-y-1 text-sm text-gray-600">
                            <p>📧 {{ $order->customer->email ?? 'N/A' }}</p>
                            <p>📱 {{ $order->customer->phone ?? 'N/A' }}</p>
                            <p>📍 {{ $order->customer->address ?? 'N/A' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Car Info -->
            <div class="bg-white rounded-lg shadow-lg p-6">
                <h2 class="text-xl font-semibold mb-4">Mobil yang Disewa</h2>
                <div class="flex gap-4">
                    @if($order->car->images && count($order->car->images) > 0)
                        <img src="{{ $order->car->images[0] }}" alt="{{ $order->car->full_name }}" class="w-32 h-32 object-cover rounded-lg">
                    @endif
                    <div class="flex-1">
                        <h3 class="text-lg font-bold text-gray-900">{{ $order->car->full_name ?? 'N/A' }}</h3>
                        <div class="mt-2 grid grid-cols-2 gap-2 text-sm text-gray-600">
                            <p>Plat: {{ $order->car->license_plate ?? 'N/A' }}</p>
                            <p>Warna: {{ $order->car->color ?? 'N/A' }}</p>
                            <p>Transmisi: {{ ucfirst($order->car->transmission ?? 'N/A') }}</p>
                            <p>Kursi: {{ $order->car->seats ?? 'N/A' }} seats</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Rental Period -->
            <div class="bg-white rounded-lg shadow-lg p-6">
                <h2 class="text-xl font-semibold mb-4">Detail Sewa</h2>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p class="text-sm text-gray-600">Tanggal Mulai</p>
                        <p class="font-semibold">{{ $order->start_date->format('d M Y, H:i') }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Tanggal Selesai</p>
                        <p class="font-semibold">{{ $order->end_date->format('d M Y, H:i') }}</p>
                    </div>
                    <div class="col-span-2">
                        <p class="text-sm text-gray-600">Total Durasi</p>
                        <p class="font-semibold text-lg">{{ $order->total_days }} hari</p>
                    </div>
                </div>

                @if($order->status === 'ongoing')
                <div class="mt-4 p-4 bg-blue-50 rounded-lg">
                    <p class="text-sm text-blue-800">⏱️ Sisa Waktu</p>
                    <p class="text-2xl font-bold text-blue-600 mt-1">{{ $order->remaining_time }}</p>
                </div>
                @endif
            </div>

            <!-- Location Info -->
            <div class="bg-white rounded-lg shadow-lg p-6">
                <h2 class="text-xl font-semibold mb-4">Lokasi Pengantaran</h2>
                <div class="space-y-4">
                    <div class="flex items-start gap-3">
                        <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0">
                            <span class="text-green-600 font-bold">A</span>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Lokasi Pengambilan</p>
                            <p class="font-medium">{{ $order->pickup_location }}</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-3">
                        <div class="w-8 h-8 bg-red-100 rounded-full flex items-center justify-center flex-shrink-0">
                            <span class="text-red-600 font-bold">B</span>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Lokasi Pengembalian</p>
                            <p class="font-medium">{{ $order->return_location }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Notes -->
            @if($order->notes)
            <div class="bg-white rounded-lg shadow-lg p-6">
                <h2 class="text-xl font-semibold mb-4">Catatan Customer</h2>
                <div class="bg-gray-50 rounded-lg p-4">
                    <p class="text-gray-700">{{ $order->notes }}</p>
                </div>
            </div>
            @endif
        </div>

        <!-- Sidebar -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-lg shadow-lg p-6 sticky top-4 space-y-6">
                <!-- Payment Info -->
                <div>
                    <h3 class="font-semibold mb-3">Informasi Pembayaran</h3>
                    <div class="space-y-2 text-sm">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Harga/hari</span>
                            <span>Rp {{ number_format($order->price_per_day, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Durasi</span>
                            <span>{{ $order->total_days }} hari</span>
                        </div>
                        <div class="border-t pt-2 flex justify-between font-semibold text-base">
                            <span>Total</span>
                            <span class="text-blue-600">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
                        </div>
                    </div>
                    
                    <div class="mt-3">
                        <span class="px-3 py-1 rounded-full text-xs
                            @if($order->payment_status === 'paid') bg-green-100 text-green-800
                            @else bg-yellow-100 text-yellow-800
                            @endif">
                            Payment: {{ ucfirst($order->payment_status) }}
                        </span>
                    </div>
                </div>

                <!-- Driver Commission (Example) -->
                @if($order->status === 'completed')
                <div class="bg-green-50 border border-green-200 rounded-lg p-4">
                    <p class="text-sm text-green-800 mb-1">Komisi Driver (10%)</p>
                    <p class="text-2xl font-bold text-green-600">
                        Rp {{ number_format($order->total_price * 0.1, 0, ',', '.') }}
                    </p>
                </div>
                @endif

                <!-- Actions -->
                @if($order->status === 'pending' && !$order->driver_confirmed)
                <div class="space-y-2">
                    <form action="{{ route('driver.orders.confirm', $order->_id) }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full bg-green-500 text-white px-4 py-3 rounded-lg hover:bg-green-600 transition font-semibold">
                            ✓ Terima Order
                        </button>
                    </form>
                    <form action="{{ route('driver.orders.reject', $order->_id) }}" method="POST" onsubmit="return confirm('Yakin ingin menolak order ini?')">
                        @csrf
                        <button type="submit" class="w-full bg-red-500 text-white px-4 py-3 rounded-lg hover:bg-red-600 transition font-semibold">
                            ✗ Tolak Order
                        </button>
                    </form>
                </div>
                @endif

                @if($order->driver_confirmed)
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                    <p class="text-sm text-blue-800 text-center">
                        ✓ Anda telah mengkonfirmasi order ini
                    </p>
                </div>
                @endif

                <!-- Contact Customer -->
                <div class="border-t pt-4">
                    <p class="text-sm text-gray-600 mb-2">Butuh hubungi customer?</p>
                    <a href="tel:{{ $order->customer->phone ?? '' }}" class="block w-full bg-blue-500 text-white text-center px-4 py-2 rounded-lg hover:bg-blue-600 transition">
                        📱 Hubungi Customer
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection