<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class CustomerController extends Controller
{
    // Dashboard Customer
    public function dashboard()
    {
        $customer = Auth::user();

        // Pesanan yang sedang berjalan
        $activeOrders = Order::with(['car', 'driver'])
            ->where('customer_id', $customer->_id)
            ->whereIn('status', ['pending', 'confirmed', 'ongoing'])
            ->orderBy('created_at', 'desc')
            ->get();

        // Riwayat pesanan
        $orderHistory = Order::with(['car', 'driver'])
            ->where('customer_id', $customer->_id)
            ->whereIn('status', ['completed', 'cancelled'])
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        // Statistik
        $stats = [
            'active_orders' => $activeOrders->count(),
            'total_orders' => Order::where('customer_id', $customer->_id)->count(),
            'total_spent' => Payment::whereHas('order', function($q) use ($customer) {
                $q->where('customer_id', $customer->_id);
            })->where('status', 'success')->sum('amount'),
        ];

        return view('customer.dashboard', compact('activeOrders', 'orderHistory', 'stats'));
    }

    // Halaman browse mobil
    public function browseCars(Request $request)
    {
        $query = Car::where('status', 'available');

        // Filter berdasarkan pencarian
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('brand', 'like', "%{$search}%")
                  ->orWhere('model', 'like', "%{$search}%");
            });
        }

        // Filter transmisi
        if ($request->filled('transmission')) {
            $query->where('transmission', $request->transmission);
        }

        // Filter bahan bakar
        if ($request->filled('fuel_type')) {
            $query->where('fuel_type', $request->fuel_type);
        }

        // Filter harga
        if ($request->filled('max_price')) {
            $query->where('price_per_day', '<=', $request->max_price);
        }

        $cars = $query->orderBy('price_per_day', 'asc')->paginate(12);

        return view('customer.cars', compact('cars'));
    }

    // Detail mobil
    public function showCar($id)
    {
        $car = Car::findOrFail($id);
        return view('customer.car-detail', compact('car'));
    }

    // Form pemesanan
    public function bookingForm($carId)
    {
        $car = Car::findOrFail($carId);

        if (!$car->isAvailable()) {
            return redirect()->route('customer.cars')
                ->with('error', 'Mobil tidak tersedia untuk disewa!');
        }

        return view('customer.booking', compact('car'));
    }

    // Proses pemesanan
    public function storeBooking(Request $request, $carId)
    {
        $customer = Auth::user();
        $car = Car::findOrFail($carId);

        $request->validate([
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after:start_date',
            'pickup_location' => 'required|string',
            'return_location' => 'required|string',
            'notes' => 'nullable|string',
        ]);

        // Hitung total hari dan harga
        $startDate = Carbon::parse($request->start_date);
        $endDate = Carbon::parse($request->end_date);
        $totalDays = $startDate->diffInDays($endDate) + 1;
        $totalPrice = $totalDays * $car->price_per_day;

        // Buat order
        $order = Order::create([
            'order_number' => Order::generateOrderNumber(),
            'customer_id' => $customer->_id,
            'car_id' => $car->_id,
            'start_date' => $startDate,
            'end_date' => $endDate,
            'pickup_location' => $request->pickup_location,
            'return_location' => $request->return_location,
            'total_days' => $totalDays,
            'price_per_day' => $car->price_per_day,
            'total_price' => $totalPrice,
            'status' => 'pending',
            'payment_status' => 'unpaid',
            'driver_confirmed' => false,
            'notes' => $request->notes,
        ]);

        // Update status mobil
        $car->update(['status' => 'rented']);

        // Redirect ke halaman pembayaran
        return redirect()->route('customer.payment', $order->_id)
            ->with('success', 'Pesanan berhasil dibuat! Silakan lakukan pembayaran.');
    }

    // Halaman pembayaran (dummy)
    public function payment($orderId)
    {
        $customer = Auth::user();
        $order = Order::with('car')
            ->where('customer_id', $customer->_id)
            ->findOrFail($orderId);

        if ($order->payment_status === 'paid') {
            return redirect()->route('customer.orders.show', $orderId)
                ->with('info', 'Pesanan ini sudah dibayar.');
        }

        return view('customer.payment', compact('order'));
    }

    // Proses pembayaran (dummy - simulasi)
    public function processPayment(Request $request, $orderId)
    {
        $customer = Auth::user();
        $order = Order::where('customer_id', $customer->_id)->findOrFail($orderId);

        $request->validate([
            'payment_method' => 'required|in:bank_transfer,e-wallet,credit_card',
        ]);

        // Buat payment record (dummy)
        $payment = Payment::create([
            'order_id' => $order->_id,
            'payment_number' => Payment::generatePaymentNumber(),
            'amount' => $order->total_price,
            'payment_method' => $request->payment_method,
            'payment_gateway' => 'dummy', // Nanti bisa diganti Midtrans/Xendit
            'status' => 'success', // Langsung success untuk dummy
            'transaction_id' => 'TRX-' . strtoupper(uniqid()),
            'paid_at' => now(),
            'expired_at' => now()->addDay(),
        ]);

        // Update order
        $order->update([
            'payment_status' => 'paid',
            'status' => 'pending', // Menunggu driver konfirmasi
        ]);

        // Kirim notifikasi ke admin
        Notification::create([
            'user_id' => $this->getAdminId(),
            'type' => 'payment_success',
            'title' => 'Pembayaran Baru',
            'message' => "Pembayaran untuk order {$order->order_number} berhasil",
            'data' => ['order_id' => $order->_id],
            'action_url' => route('admin.orders.show', $order->_id),
        ]);

        return redirect()->route('customer.orders.show', $orderId)
            ->with('success', 'Pembayaran berhasil! Menunggu konfirmasi driver.');
    }

    // Detail order
    public function showOrder($orderId)
    {
        $customer = Auth::user();
        $order = Order::with(['car', 'driver', 'payment'])
            ->where('customer_id', $customer->_id)
            ->findOrFail($orderId);

        return view('customer.order-detail', compact('order'));
    }

    // Riwayat pesanan
    public function orderHistory()
    {
        $customer = Auth::user();
        $orders = Order::with(['car', 'driver', 'payment'])
            ->where('customer_id', $customer->_id)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('customer.order-history', compact('orders'));
    }

    // Batalkan pesanan
    public function cancelOrder(Request $request, $orderId)
    {
        $customer = Auth::user();
        $order = Order::where('customer_id', $customer->_id)->findOrFail($orderId);

        if (!$order->canBeCancelled()) {
            return redirect()->back()
                ->with('error', 'Pesanan tidak dapat dibatalkan!');
        }

        $order->update([
            'status' => 'cancelled',
            'cancellation_reason' => $request->reason,
        ]);

        // Kembalikan status mobil
        $order->car->update(['status' => 'available']);

        return redirect()->route('customer.dashboard')
            ->with('success', 'Pesanan berhasil dibatalkan.');
    }

    // Helper: Get Admin ID
    private function getAdminId()
    {
        $admin = \App\Models\User::where('role', 'admin')->first();
        return $admin ? $admin->_id : null;
    }
}