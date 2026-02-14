@extends('layouts.app')

@section('title', 'Driver Dashboard')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Dashboard Driver</h1>
        <p class="text-gray-600 mt-2">Selamat datang, {{ Auth::user()->name }}</p>
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

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm">Order Pending</p>
                    <p class="text-3xl font-bold text-yellow-600">{{ $stats['pending_count'] }}</p>
                </div>
                <div class="bg-yellow-100 p-3 rounded-full">
                    <svg class="w-8 h-8 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm">Order Aktif</p>
                    <p class="text-3xl font-bold text-blue-600">{{ $stats['active_count'] }}</p>
                </div>
                <div class="bg-blue-100 p-3 rounded-full">
                    <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm">Order Selesai</p>
                    <p class="text-3xl font-bold text-green-600">{{ $stats['total_completed'] }}</p>
                </div>
                <div class="bg-green-100 p-3 rounded-full">
                    <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm">Total Penghasilan</p>
                    <p class="text-2xl font-bold text-purple-600">Rp {{ number_format($stats['total_earnings'], 0, ',', '.') }}</p>
                </div>
                <div class="bg-purple-100 p-3 rounded-full">
                    <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Pending Orders (Menunggu Konfirmasi) -->
    @if($pendingOrders->count() > 0)
    <div class="mb-8">
        <h2 class="text-2xl font-bold mb-4 flex items-center">
            <span class="bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full text-sm mr-3">
                {{ $pendingOrders->count() }}
            </span>
            Order Menunggu Konfirmasi
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @foreach($pendingOrders as $order)
            <div class="bg-white rounded-lg shadow-lg overflow-hidden border-l-4 border-yellow-500">
                <div class="p-6">
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <p class="text-sm text-gray-500">Order #{{ $order->order_number }}</p>
                            <h3 class="text-xl font-bold mt-1">{{ $order->car->full_name ?? 'N/A' }}</h3>
                        </div>
                        <span class="px-3 py-1 text-xs rounded-full bg-yellow-100 text-yellow-800">
                            Pending
                        </span>
                    </div>

                    <div class="space-y-2 text-sm mb-4">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Customer:</span>
                            <span class="font-medium">{{ $order->customer->name ?? 'N/A' }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Tanggal:</span>
                            <span class="font-medium">{{ $order->start_date->format('d M Y') }} - {{ $order->end_date->format('d M Y') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Lokasi Pickup:</span>
                            <span class="font-medium">{{ $order->pickup_location }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Total:</span>
                            <span class="font-bold text-primary">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
                        </div>
                    </div>

                    <div class="flex space-x-2">
                        <form action="{{ route('driver.orders.confirm', $order->_id) }}" method="POST" class="flex-1">
                            @csrf
                            <button type="submit" class="w-full bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition">
                                ✓ Terima Order
                            </button>
                        </form>
                        <form action="{{ route('driver.orders.reject', $order->_id) }}" method="POST" class="flex-1">
                            @csrf
                            <button type="submit" class="w-full bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition" 
                                    onclick="return confirm('Yakin ingin menolak order ini?')">
                                ✗ Tolak
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif

    <!-- Active Orders (Sudah Dikonfirmasi) -->
    @if($activeOrders->count() > 0)
    <div class="mb-8">
        <h2 class="text-2xl font-bold mb-4 flex items-center">
            <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm mr-3">
                {{ $activeOrders->count() }}
            </span>
            Order Aktif
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @foreach($activeOrders as $order)
            <div class="bg-white rounded-lg shadow-lg overflow-hidden border-l-4 border-blue-500">
                <div class="p-6">
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <p class="text-sm text-gray-500">Order #{{ $order->order_number }}</p>
                            <h3 class="text-xl font-bold mt-1">{{ $order->car->full_name ?? 'N/A' }}</h3>
                        </div>
                        <span class="px-3 py-1 text-xs rounded-full 
                            @if($order->status === 'ongoing') bg-blue-100 text-blue-800
                            @else bg-green-100 text-green-800
                            @endif">
                            {{ ucfirst($order->status) }}
                        </span>
                    </div>

                    <div class="space-y-2 text-sm mb-4">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Customer:</span>
                            <span class="font-medium">{{ $order->customer->name ?? 'N/A' }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Telepon:</span>
                            <span class="font-medium">{{ $order->customer->phone ?? 'N/A' }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Tanggal:</span>
                            <span class="font-medium">{{ $order->start_date->format('d M Y') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Lokasi:</span>
                            <span class="font-medium">{{ $order->pickup_location }}</span>
                        </div>
                        @if($order->status === 'ongoing')
                        <div class="flex justify-between border-t pt-2 mt-2">
                            <span class="text-gray-600">⏱️ Sisa Waktu:</span>
                            <span class="font-bold text-blue-600">{{ $order->remaining_time }}</span>
                        </div>
                        @endif
                    </div>

                    <a href="{{ route('driver.orders.show', $order->_id) }}" class="block text-center bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
                        Lihat Detail
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif

    <!-- Completed Orders History -->
    @if($completedOrders->count() > 0)
    <div>
        <h2 class="text-2xl font-bold mb-4">Riwayat Order Selesai</h2>
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Order</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Mobil</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Customer</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($completedOrders as $order)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                            <a href="{{ route('driver.orders.show', $order->_id) }}" class="text-primary hover:underline">
                                {{ $order->order_number }}
                            </a>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $order->car->full_name ?? 'N/A' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $order->customer->name ?? 'N/A' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                            {{ $order->start_date->format('d M Y') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 py-1 text-xs rounded-full
                                @if($order->status === 'completed') bg-green-100 text-green-800
                                @else bg-red-100 text-red-800
                                @endif">
                                {{ ucfirst($order->status) }}
                            </span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif

    <!-- Empty State -->
    @if($pendingOrders->count() == 0 && $activeOrders->count() == 0 && $completedOrders->count() == 0)
    <div class="bg-white rounded-lg shadow p-12 text-center">
        <svg class="mx-auto h-16 w-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
        </svg>
        <h3 class="mt-4 text-xl font-medium text-gray-900">Belum Ada Order</h3>
        <p class="mt-2 text-gray-600">Order akan muncul di sini ketika ada customer yang memesan mobil</p>
    </div>
    @endif
</div>
@endsection