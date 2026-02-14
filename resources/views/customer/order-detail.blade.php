@extends('layouts.app')

@section('title', 'Detail Pesanan')

@section('content')
<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
    <!-- Header -->
    <div class="mb-8">
        <a href="{{ route('customer.dashboard') }}" class="text-blue-500 hover:text-blue-700 mb-4 inline-block">
            ← Kembali ke Dashboard
        </a>
        <div class="flex justify-between items-start">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Detail Pesanan</h1>
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

    @if(session('success'))
        <div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Car Info -->
            <div class="bg-white rounded-lg shadow-lg p-6">
                <h2 class="text-xl font-semibold mb-4">Informasi Mobil</h2>
                <div class="flex gap-4">
                    @if($order->car->images && count($order->car->images) > 0)
                        <img src="{{ $order->car->images[0] }}" alt="{{ $order->car->full_name }}" class="w-32 h-32 object-cover rounded-lg">
                    @endif
                    <div class="flex-1">
                        <h3 class="text-lg font-bold text-gray-900">{{ $order->car->full_name ?? 'N/A' }}</h3>
                        <div class="mt-2 space-y-1 text-sm text-gray-600">
                            <p>Plat: {{ $order->car->license_plate ?? 'N/A' }}</p>
                            <p>Warna: {{ $order->car->color ?? 'N/A' }}</p>
                            <p>Transmisi: {{ ucfirst($order->car->transmission ?? 'N/A') }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Rental Period -->
            <div class="bg-white rounded-lg shadow-lg p-6">
                <h2 class="text-xl font-semibold mb-4">Periode Sewa</h2>
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
                        <p class="font-semibold">{{ $order->total_days }} hari</p>
                    </div>
                </div>

                @if($order->status === 'ongoing')
                <div class="mt-4 p-4 bg-blue-50 rounded-lg">
                    <p class="text-sm text-blue-800">⏱️ Sisa Waktu Sewa</p>
                    <p class="text-2xl font-bold text-blue-600 mt-1">{{ $order->remaining_time }}</p>
                </div>
                @endif
            </div>

            <!-- Location Info -->
            <div class="bg-white rounded-lg shadow-lg p-6">
                <h2 class="text-xl font-semibold mb-4">Lokasi</h2>
                <div class="space-y-3">
                    <div>
                        <p class="text-sm text-gray-600">Lokasi Pengambilan</p>
                        <p class="font-medium">{{ $order->pickup_location }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Lokasi Pengembalian</p>
                        <p class="font-medium">{{ $order->return_location }}</p>
                    </div>
                </div>
            </div>

            <!-- Driver Info -->
            @if($order->driver)
            <div class="bg-white rounded-lg shadow-lg p-6">
                <h2 class="text-xl font-semibold mb-4">Informasi Driver</h2>
                <div class="flex items-center gap-4">
                    <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center">
                        <span class="text-2xl">👤</span>
                    </div>
                    <div>
                        <p class="font-semibold text-lg">{{ $order->driver->name }}</p>
                        <p class="text-sm text-gray-600">{{ $order->driver->phone }}</p>
                        @if($order->driver_confirmed)
                        <span class="inline-block mt-1 px-2 py-1 bg-green-100 text-green-800 text-xs rounded">
                            ✓ Dikonfirmasi
                        </span>
                        @endif
                    </div>
                </div>
            </div>
            @else
            <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                <p class="text-yellow-800">Menunggu driver dikonfirmasi oleh sistem...</p>
            </div>
            @endif

            <!-- Notes -->
            @if($order->notes)
            <div class="bg-white rounded-lg shadow-lg p-6">
                <h2 class="text-xl font-semibold mb-4">Catatan</h2>
                <p class="text-gray-700">{{ $order->notes }}</p>
            </div>
            @endif
        </div>

        <!-- Sidebar -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-lg shadow-lg p-6 sticky top-4 space-y-6">
                <!-- Payment Info -->
                <div>
                    <h3 class="font-semibold mb-3">Pembayaran</h3>
                    <div class="space-y-2 text-sm">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Harga/hari</span>
                            <span>Rp {{ number_format($order->price_per_day, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Durasi</span>
                            <span>{{ $order->total_days }} hari</span>
                        </div>
                        <div class="border-t pt-2 flex justify-between font-semibold">
                            <span>Total</span>
                            <span class="text-blue-600">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
                        </div>
                    </div>
                    
                    <div class="mt-3">
                        <span class="px-3 py-1 rounded-full text-xs
                            @if($order->payment_status === 'paid') bg-green-100 text-green-800
                            @else bg-yellow-100 text-yellow-800
                            @endif">
                            {{ ucfirst($order->payment_status) }}
                        </span>
                    </div>
                </div>

                <!-- Actions -->
                <div class="space-y-2">
                    @if($order->canBeCancelled())
                    <form action="{{ route('customer.orders.cancel', $order->_id) }}" method="POST" onsubmit="return confirm('Yakin ingin membatalkan pesanan ini?')">
                        @csrf
                        <input type="hidden" name="reason" value="Dibatalkan oleh customer">
                        <button type="submit" class="w-full bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition">
                            Batalkan Pesanan
                        </button>
                    </form>
                    @endif

                    @if($order->payment_status === 'unpaid')
                    <a href="{{ route('customer.payment', $order->_id) }}" class="block w-full bg-blue-500 text-white text-center px-4 py-2 rounded-lg hover:bg-blue-600 transition">
                        Bayar Sekarang
                    </a>
                    @endif
                </div>

                <!-- Contact Support -->
                <div class="border-t pt-4">
                    <p class="text-sm text-gray-600 mb-2">Butuh bantuan?</p>
                    <a href="#" class="text-blue-500 hover:text-blue-700 text-sm font-medium">
                        Hubungi Customer Service
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection