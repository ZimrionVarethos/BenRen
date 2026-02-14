@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Dashboard Admin</h1>
        <p class="text-gray-600 mt-2">Selamat datang, {{ Auth::user()->name }}</p>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm">Total Mobil</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $stats['total_cars'] }}</p>
                </div>
                <div class="bg-blue-100 p-3 rounded-full">
                    <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                    </svg>
                </div>
            </div>
            <p class="text-sm text-green-600 mt-2">{{ $stats['available_cars'] }} tersedia</p>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm">Pesanan Aktif</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $stats['active_orders'] }}</p>
                </div>
                <div class="bg-yellow-100 p-3 rounded-full">
                    <svg class="w-8 h-8 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
            <p class="text-sm text-gray-600 mt-2">dari {{ $stats['total_orders'] }} total</p>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm">Revenue</p>
                    <p class="text-3xl font-bold text-gray-900">Rp {{ number_format($stats['total_revenue'], 0, ',', '.') }}</p>
                </div>
                <div class="bg-green-100 p-3 rounded-full">
                    <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
            <p class="text-sm text-gray-600 mt-2">{{ $stats['completed_orders'] }} selesai</p>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm">Customers</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $stats['total_customers'] }}</p>
                </div>
                <div class="bg-purple-100 p-3 rounded-full">
                    <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                </div>
            </div>
            <p class="text-sm text-gray-600 mt-2">{{ $stats['total_drivers'] }} drivers</p>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <a href="{{ route('admin.cars.create') }}" class="card hover:shadow-lg transition">
            <h3 class="font-semibold text-lg mb-2">➕ Tambah Mobil</h3>
            <p class="text-gray-600 text-sm">Tambahkan mobil baru ke inventory</p>
        </a>

        <a href="{{ route('admin.tracking') }}" class="card hover:shadow-lg transition">
            <h3 class="font-semibold text-lg mb-2">📍 Tracking Mobil</h3>
            <p class="text-gray-600 text-sm">Monitor lokasi mobil real-time</p>
        </a>

        <a href="{{ route('admin.sales') }}" class="card hover:shadow-lg transition">
            <h3 class="font-semibold text-lg mb-2">💰 Data Penjualan</h3>
            <p class="text-gray-600 text-sm">Lihat laporan revenue</p>
        </a>
    </div>

    <!-- Recent Orders & Active Rentals -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Recent Orders -->
        <div class="bg-white rounded-lg shadow">
            <div class="p-6 border-b border-gray-200">
                <h2 class="text-xl font-semibold">Pesanan Terbaru</h2>
            </div>
            <div class="p-6">
                @forelse($recentOrders as $order)
                    <div class="flex items-center justify-between py-3 border-b border-gray-100">
                        <div class="flex-1">
                            <p class="font-medium">{{ $order->order_number }}</p>
                            <p class="text-sm text-gray-600">{{ $order->customer->name ?? 'N/A' }}</p>
                            <p class="text-sm text-gray-500">{{ $order->car->full_name ?? 'N/A' }}</p>
                        </div>
                        <div class="text-right">
                            <span class="px-3 py-1 text-xs rounded-full
                                @if($order->status === 'completed') bg-green-100 text-green-800
                                @elseif($order->status === 'ongoing') bg-blue-100 text-blue-800
                                @elseif($order->status === 'pending') bg-yellow-100 text-yellow-800
                                @else bg-gray-100 text-gray-800
                                @endif">
                                {{ ucfirst($order->status) }}
                            </span>
                            <p class="text-sm text-gray-600 mt-1">Rp {{ number_format($order->total_price, 0, ',', '.') }}</p>
                        </div>
                    </div>
                @empty
                    <p class="text-gray-500 text-center py-4">Belum ada pesanan</p>
                @endforelse
            </div>
        </div>

        <!-- Active Rentals -->
        <div class="bg-white rounded-lg shadow">
            <div class="p-6 border-b border-gray-200">
                <h2 class="text-xl font-semibold">Peminjaman Aktif</h2>
            </div>
            <div class="p-6">
                @forelse($activeRentals as $rental)
                    <div class="flex items-center justify-between py-3 border-b border-gray-100">
                        <div class="flex-1">
                            <p class="font-medium">{{ $rental->car->full_name ?? 'N/A' }}</p>
                            <p class="text-sm text-gray-600">{{ $rental->customer->name ?? 'N/A' }}</p>
                            <p class="text-sm text-gray-500">Driver: {{ $rental->driver->name ?? 'Belum ada' }}</p>
                        </div>
                        <div class="text-right">
                            <p class="text-sm font-medium text-gray-900">{{ $rental->remaining_time ?? 'N/A' }}</p>
                            <p class="text-xs text-gray-500">tersisa</p>
                        </div>
                    </div>
                @empty
                    <p class="text-gray-500 text-center py-4">Tidak ada peminjaman aktif</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection