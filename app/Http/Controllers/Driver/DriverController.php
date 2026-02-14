<?php

namespace App\Http\Controllers\Driver;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DriverController extends Controller
{
    // Dashboard Driver
    public function dashboard()
    {
        $driver = Auth::user();

        // Pesanan yang menunggu konfirmasi driver
        $pendingOrders = Order::with(['customer', 'car'])
            ->where(function($query) {
                $query->where('status', 'pending')
                      ->whereNull('driver_id');
            })
            ->orWhere(function($query) use ($driver) {
                $query->where('driver_id', $driver->_id)
                      ->where('driver_confirmed', false);
            })
            ->orderBy('created_at', 'desc')
            ->get();

        // Pesanan yang sudah dikonfirmasi driver
        $activeOrders = Order::with(['customer', 'car'])
            ->where('driver_id', $driver->_id)
            ->where('driver_confirmed', true)
            ->whereIn('status', ['confirmed', 'ongoing'])
            ->orderBy('created_at', 'desc')
            ->get();

        // History pesanan yang sudah selesai
        $completedOrders = Order::with(['customer', 'car'])
            ->where('driver_id', $driver->_id)
            ->whereIn('status', ['completed', 'cancelled'])
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        // Statistik driver
        $stats = [
            'pending_count' => $pendingOrders->count(),
            'active_count' => $activeOrders->count(),
            'total_completed' => Order::where('driver_id', $driver->_id)
                ->where('status', 'completed')->count(),
            'total_earnings' => Order::where('driver_id', $driver->_id)
                ->where('status', 'completed')->sum('total_price') * 0.1, // Asumsi driver dapat 10%
        ];

        return view('driver.dashboard', compact('pendingOrders', 'activeOrders', 'completedOrders', 'stats'));
    }

    // Konfirmasi menerima order
    public function confirmOrder(Request $request, $orderId)
    {
        $driver = Auth::user();
        $order = Order::findOrFail($orderId);

        // Validasi: order harus pending dan belum ada driver
        if ($order->status !== 'pending' || ($order->driver_id && $order->driver_id != $driver->_id)) {
            return redirect()->back()
                ->with('error', 'Order tidak dapat dikonfirmasi!');
        }

        // Update order
        $order->update([
            'driver_id' => $driver->_id,
            'driver_confirmed' => true,
            'status' => 'confirmed',
        ]);

        // Kirim notifikasi ke admin
        Notification::create([
            'user_id' => $this->getAdminId(),
            'type' => 'driver_confirmed',
            'title' => 'Driver Mengkonfirmasi Order',
            'message' => "Driver {$driver->name} telah mengkonfirmasi order {$order->order_number}",
            'data' => [
                'order_id' => $order->_id,
                'driver_id' => $driver->_id,
            ],
            'action_url' => route('admin.orders.show', $order->_id),
        ]);

        // Kirim notifikasi ke customer
        Notification::create([
            'user_id' => $order->customer_id,
            'type' => 'driver_confirmed',
            'title' => 'Driver Ditemukan!',
            'message' => "Driver {$driver->name} akan mengantarkan mobil pesanan Anda",
            'data' => [
                'order_id' => $order->_id,
                'driver_id' => $driver->_id,
            ],
            'action_url' => route('customer.orders.show', $order->_id),
        ]);

        return redirect()->route('driver.dashboard')
            ->with('success', 'Order berhasil dikonfirmasi!');
    }

    // Tolak order
    public function rejectOrder($orderId)
    {
        $driver = Auth::user();
        $order = Order::findOrFail($orderId);

        if ($order->driver_id == $driver->_id && !$order->driver_confirmed) {
            $order->update([
                'driver_id' => null,
            ]);

            return redirect()->route('driver.dashboard')
                ->with('success', 'Order ditolak.');
        }

        return redirect()->back()
            ->with('error', 'Tidak dapat menolak order ini!');
    }

    // Detail order
    public function showOrder($orderId)
    {
        $driver = Auth::user();
        $order = Order::with(['customer', 'car', 'payment'])
            ->where('driver_id', $driver->_id)
            ->findOrFail($orderId);

        return view('driver.order-detail', compact('order'));
    }

    // Helper: Get Admin ID
    private function getAdminId()
    {
        $admin = \App\Models\User::where('role', 'admin')->first();
        return $admin ? $admin->_id : null;
    }
}