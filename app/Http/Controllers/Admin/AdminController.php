<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\Order;
use App\Models\User;
use App\Models\Payment;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Dashboard Admin
    public function dashboard()
    {
        $stats = [
            'total_cars' => Car::count(),
            'available_cars' => Car::where('status', 'available')->count(),
            'total_orders' => Order::count(),
            'active_orders' => Order::whereIn('status', ['pending', 'confirmed', 'ongoing'])->count(),
            'completed_orders' => Order::where('status', 'completed')->count(),
            'total_revenue' => Payment::where('status', 'success')->sum('amount') ?? 0,
            'pending_payments' => Payment::where('status', 'pending')->count(),
            'total_customers' => User::where('role', 'customer')->count(),
            'total_drivers' => User::where('role', 'driver')->count(),
        ];

        // Data untuk chart - pemesanan per bulan (MongoDB compatible)
        // Untuk saat ini kita skip chart data, atau bisa pakai raw aggregation
        $monthlyOrders = collect([]); // Empty collection untuk sementara

        // Pesanan terbaru
        $recentOrders = Order::with(['customer', 'car'])
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        // Mobil yang sedang disewa
        $activeRentals = Order::with(['customer', 'car', 'driver'])
            ->whereIn('status', ['confirmed', 'ongoing'])
            ->get();

        return view('admin.dashboard', compact('stats', 'monthlyOrders', 'recentOrders', 'activeRentals'));
    }

    // Halaman untuk tracking mobil (dummy/statis untuk saat ini)
    public function tracking()
    {
        $cars = Car::with('activeOrder.customer')->get();
        
        // Dummy data untuk real-time tracking
        // Nanti akan diganti dengan API GPS real-time
        $trackingData = $cars->map(function ($car) {
            return [
                'car' => $car,
                'location' => $car->current_location ?? [
                    'latitude' => -6.2088,
                    'longitude' => 106.8456,
                    'address' => 'Jakarta',
                ],
                'speed' => rand(0, 80), // km/h (dummy)
                'last_update' => now()->subMinutes(rand(1, 30)),
            ];
        });

        return view('admin.tracking', compact('trackingData'));
    }

    // Data pembelian/revenue
    public function sales()
    {
        $payments = Payment::with('order.customer')
            ->where('status', 'success')
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        $totalRevenue = Payment::where('status', 'success')->sum('amount') ?? 0;
        
        // Monthly revenue - MongoDB compatible menggunakan whereBetween
        $startOfMonth = now()->startOfMonth();
        $endOfMonth = now()->endOfMonth();
        
        $monthlyRevenue = Payment::where('status', 'success')
            ->whereBetween('created_at', [$startOfMonth, $endOfMonth])
            ->sum('amount') ?? 0;

        return view('admin.sales', compact('payments', 'totalRevenue', 'monthlyRevenue'));
    }

    // History peminjaman
    public function orderHistory()
    {
        $orders = Order::with(['customer', 'car', 'driver'])
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('admin.order-history', compact('orders'));
    }

    // Detail order
    public function showOrder($id)
    {
        $order = Order::with(['customer', 'car', 'driver', 'payment'])
            ->findOrFail($id);

        return view('admin.order-detail', compact('order'));
    }
}