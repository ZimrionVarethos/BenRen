@extends('layouts.app')

@section('title', 'Customer Dashboard')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Dashboard</h1>
        <p class="text-gray-600 mt-2">Selamat datang, {{ Auth::user()->name }}</p>
    </div>

    @if(session('success'))
        <div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm">Pesanan Aktif</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $stats['active_orders'] }}</p>
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
                    <p class="text-gray-500 text-sm">Total Pesanan</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $stats['total_orders'] }}</p>
                </div>
                <div class="bg-green-100 p-3 rounded-full">
                    <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm">Total Pengeluaran</p>
                    <p class="text-2xl font-bold text-gray-900">Rp {{ number_format($stats['total_spent'], 0, ',', '.') }}</p>
                </div>
                <div class="bg-purple-100 p-3 rounded-full">
                    <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Action -->
    <div class="mb-8">
        <a href="{{ route('customer.cars') }}" class="inline-block bg-primary text-white px-8 py-4 rounded-lg text-lg font-semibold hover:bg-blue-700 transition shadow-lg">
            🚗 Sewa Mobil Sekarang
        </a>
    </div>

    <!-- Active Orders -->
    @if($activeOrders->count() > 0)
    <div class="mb-8">
        <h2 class="text-2xl font-bold mb-4">Pesanan Aktif</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @foreach($activeOrders as $order)
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <div class="p-6">
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <p class="text-sm text-gray-500">Order #{{ $order->order_number }}</p>
                            <h3 class="text-xl font-bold mt-1">{{ $order->car->full_name ?? 'N/A' }}</h3>
                        </div>
                        <span class="px-3 py-1 text-xs rounded-full
                            @if($order->status === 'ongoing') bg-blue-100 text-blue-800
                            @elseif($order->status === 'confirmed') bg-green-100 text-green-800
                            @else bg-yellow-100 text-yellow-800
                            @endif">
                            {{ ucfirst($order->status) }}
                        </span>
                    </div>

                    @if($order->car->images && count($order->car->images) > 0)
                    <img src="{{ $order->car->images[0] }}" alt="Car" class="w-full h-48 object-cover rounded-lg mb-4">
                    @endif

                    <div class="space-y-2 text-sm">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Tanggal Mulai:</span>
                            <span class="font-medium">{{ $order->start_date->format('d M Y') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Tanggal Selesai:</span>
                            <span class="font-medium">{{ $order->end_date->format('d M Y') }}</span>
                        </div>
                        @if($order->status === 'ongoing')
                        <div class="flex justify-between border-t pt-2 mt-2">
                            <span class="text-gray-600">⏱️ Sisa Waktu:</span>
                            <span class="font-bold text-blue-600">{{ $order->remaining_time }}</span>
                        </div>
                        @endif
                        @if($order->driver)
                        <div class="flex justify-between">
                            <span class="text-gray-600">Driver:</span>
                            <span class="font-medium">{{ $order->driver->name }}</span>
                        </div>
                        @endif
                    </div>

                    <div class="mt-4 pt-4 border-t flex justify-between items-center">
                        <div>
                            <p class="text-sm text-gray-600">Total Harga</p>
                            <p class="text-xl font-bold text-primary">Rp {{ number_format($order->total_price, 0, ',', '.') }}</p>
                        </div>
                        <a href="{{ route('customer.orders.show', $order->_id) }}" class="btn-primary">
                            Detail
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif

    <!-- Order History -->
    @if($orderHistory->count() > 0)
    <div>
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-2xl font-bold">Riwayat Pesanan</h2>
            <a href="{{ route('customer.orders.history') }}" class="text-primary hover:text-blue-700">
                Lihat Semua →
            </a>
        </div>
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Order</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Mobil</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Total</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($orderHistory as $order)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                            <a href="{{ route('customer.orders.show', $order->_id) }}" class="text-primary hover:underline">
                                {{ $order->order_number }}
                            </a>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $order->car->full_name ?? 'N/A' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                            {{ $order->start_date->format('d M Y') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            Rp {{ number_format($order->total_price, 0, ',', '.') }}
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

    @if($activeOrders->count() == 0 && $orderHistory->count() == 0)
    <div class="bg-white rounded-lg shadow p-12 text-center">
        <svg class="mx-auto h-16 w-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
        </svg>
        <h3 class="mt-4 text-xl font-medium text-gray-900">Belum Ada Pesanan</h3>
        <p class="mt-2 text-gray-600">Mulai sewa mobil untuk perjalanan Anda!</p>
        <a href="{{ route('customer.cars') }}" class="mt-6 inline-block btn-primary">
            Browse Mobil
        </a>
    </div>
    @endif
</div>
@endsection