@extends('layouts.app')

@section('title', 'Pembayaran')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Pembayaran</h1>
        <p class="text-gray-600 mt-2">Selesaikan pembayaran untuk order #{{ $order->order_number }}</p>
    </div>

    <!-- Dummy Payment Info -->
    <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 mb-6">
        <div class="flex items-start">
            <svg class="w-5 h-5 text-yellow-600 mt-0.5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
            </svg>
            <div>
                <h3 class="text-sm font-medium text-yellow-800">Payment Gateway Dummy</h3>
                <p class="text-sm text-yellow-700 mt-1">
                    Sistem pembayaran saat ini menggunakan dummy/simulasi. Klik "Bayar Sekarang" untuk simulasi pembayaran sukses.
                    Untuk integrasi real dengan Midtrans/Xendit, lihat dokumentasi di <span class="font-semibold">03-DATABASE-PAYMENT-INTEGRATION.md</span>
                </p>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Payment Form -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-lg shadow-lg p-8">
                <h2 class="text-xl font-semibold mb-6">Pilih Metode Pembayaran</h2>

                <form action="{{ route('customer.payment.process', $order->_id) }}" method="POST">
                    @csrf

                    <!-- Payment Methods -->
                    <div class="space-y-4 mb-6">
                        <!-- Bank Transfer -->
                        <label class="flex items-center p-4 border-2 border-gray-200 rounded-lg cursor-pointer hover:border-blue-500 transition">
                            <input type="radio" name="payment_method" value="bank_transfer" checked class="mr-4">
                            <div class="flex-1">
                                <div class="flex items-center">
                                    <span class="text-lg font-medium">🏦 Transfer Bank</span>
                                </div>
                                <p class="text-sm text-gray-600 mt-1">BCA, Mandiri, BNI, BRI</p>
                            </div>
                        </label>

                        <!-- E-Wallet -->
                        <label class="flex items-center p-4 border-2 border-gray-200 rounded-lg cursor-pointer hover:border-blue-500 transition">
                            <input type="radio" name="payment_method" value="e-wallet" class="mr-4">
                            <div class="flex-1">
                                <div class="flex items-center">
                                    <span class="text-lg font-medium">💳 E-Wallet</span>
                                </div>
                                <p class="text-sm text-gray-600 mt-1">GoPay, OVO, DANA, LinkAja</p>
                            </div>
                        </label>

                        <!-- Credit Card -->
                        <label class="flex items-center p-4 border-2 border-gray-200 rounded-lg cursor-pointer hover:border-blue-500 transition">
                            <input type="radio" name="payment_method" value="credit_card" class="mr-4">
                            <div class="flex-1">
                                <div class="flex items-center">
                                    <span class="text-lg font-medium">💳 Kartu Kredit/Debit</span>
                                </div>
                                <p class="text-sm text-gray-600 mt-1">Visa, Mastercard, JCB</p>
                            </div>
                        </label>
                    </div>

                    <!-- Submit Button -->
                    <button 
                        type="submit" 
                        class="w-full bg-blue-500 text-white px-6 py-4 rounded-lg hover:bg-blue-600 transition font-semibold text-lg"
                    >
                        Bayar Sekarang (Dummy)
                    </button>

                    <p class="text-center text-sm text-gray-500 mt-4">
                        Dengan melanjutkan, Anda menyetujui syarat dan ketentuan kami
                    </p>
                </form>
            </div>
        </div>

        <!-- Order Summary -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-lg shadow-lg p-6 sticky top-4">
                <h3 class="text-lg font-semibold mb-4">Ringkasan Pesanan</h3>
                
                <div class="space-y-3 text-sm mb-4">
                    <div>
                        <p class="text-gray-600 text-xs">Order Number</p>
                        <p class="font-medium">{{ $order->order_number }}</p>
                    </div>
                    
                    <div>
                        <p class="text-gray-600 text-xs">Mobil</p>
                        <p class="font-medium">{{ $order->car->full_name ?? 'N/A' }}</p>
                    </div>

                    <div>
                        <p class="text-gray-600 text-xs">Tanggal Sewa</p>
                        <p class="font-medium">
                            {{ $order->start_date->format('d M Y') }} - {{ $order->end_date->format('d M Y') }}
                        </p>
                        <p class="text-gray-600 text-xs mt-1">{{ $order->total_days }} hari</p>
                    </div>

                    <div>
                        <p class="text-gray-600 text-xs">Lokasi Pengambilan</p>
                        <p class="font-medium text-sm">{{ $order->pickup_location }}</p>
                    </div>
                </div>

                <div class="border-t pt-4 mb-4">
                    <div class="space-y-2 text-sm">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Harga per Hari</span>
                            <span>Rp {{ number_format($order->price_per_day, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Jumlah Hari</span>
                            <span>{{ $order->total_days }} hari</span>
                        </div>
                    </div>
                </div>

                <div class="border-t pt-4">
                    <div class="flex justify-between items-center mb-2">
                        <span class="text-lg font-semibold">Total Pembayaran</span>
                    </div>
                    <div class="text-3xl font-bold text-blue-600">
                        Rp {{ number_format($order->total_price, 0, ',', '.') }}
                    </div>
                </div>

                <div class="mt-6 p-4 bg-blue-50 rounded-lg">
                    <p class="text-xs text-blue-800">
                        💡 Pembayaran akan dikonfirmasi otomatis (dummy). Untuk integrasi payment gateway real, lihat dokumentasi.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection