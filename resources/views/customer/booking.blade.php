@extends('layouts.app')

@section('title', 'Booking Mobil')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
    <!-- Header -->
    <div class="mb-8">
        <a href="{{ route('customer.cars') }}" class="text-blue-500 hover:text-blue-700 mb-4 inline-block">
            ← Kembali ke Browse Mobil
        </a>
        <h1 class="text-3xl font-bold text-gray-900">Booking Mobil</h1>
        <p class="text-gray-600 mt-2">Lengkapi data booking Anda</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Booking Form -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-lg shadow-lg p-8">
                <form action="{{ route('customer.booking.store', $car->_id) }}" method="POST" id="bookingForm">
                    @csrf

                    <!-- Tanggal Mulai -->
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Mulai *</label>
                        <input 
                            type="date" 
                            name="start_date" 
                            value="{{ old('start_date') }}" 
                            required
                            min="{{ date('Y-m-d') }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('start_date') border-red-500 @enderror"
                            onchange="calculateTotal()"
                        >
                        @error('start_date')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Tanggal Selesai -->
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Selesai *</label>
                        <input 
                            type="date" 
                            name="end_date" 
                            value="{{ old('end_date') }}" 
                            required
                            min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('end_date') border-red-500 @enderror"
                            onchange="calculateTotal()"
                        >
                        @error('end_date')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Lokasi Pickup -->
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Lokasi Pengambilan *</label>
                        <input 
                            type="text" 
                            name="pickup_location" 
                            value="{{ old('pickup_location') }}" 
                            required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('pickup_location') border-red-500 @enderror"
                            placeholder="Alamat lengkap pengambilan mobil"
                        >
                        @error('pickup_location')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Lokasi Return -->
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Lokasi Pengembalian *</label>
                        <input 
                            type="text" 
                            name="return_location" 
                            value="{{ old('return_location') }}" 
                            required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('return_location') border-red-500 @enderror"
                            placeholder="Alamat lengkap pengembalian mobil"
                        >
                        @error('return_location')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Catatan -->
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Catatan (Opsional)</label>
                        <textarea 
                            name="notes" 
                            rows="3"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                            placeholder="Catatan tambahan untuk pesanan Anda..."
                        >{{ old('notes') }}</textarea>
                    </div>

                    <!-- Submit Button -->
                    <button 
                        type="submit" 
                        class="w-full bg-blue-500 text-white px-6 py-3 rounded-lg hover:bg-blue-600 transition font-semibold text-lg"
                    >
                        Lanjut ke Pembayaran →
                    </button>
                </form>
            </div>
        </div>

        <!-- Order Summary -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-lg shadow-lg p-6 sticky top-4">
                <h3 class="text-lg font-semibold mb-4">Detail Mobil</h3>
                
                <!-- Car Image -->
                @if($car->images && count($car->images) > 0)
                    <img src="{{ $car->images[0] }}" alt="{{ $car->full_name }}" class="w-full h-40 object-cover rounded-lg mb-4">
                @endif

                <h4 class="font-bold text-gray-900 mb-2">{{ $car->full_name }}</h4>
                
                <div class="space-y-2 text-sm mb-4">
                    <div class="flex justify-between">
                        <span class="text-gray-600">Warna:</span>
                        <span class="font-medium">{{ $car->color }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Transmisi:</span>
                        <span class="font-medium">{{ ucfirst($car->transmission) }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Bahan Bakar:</span>
                        <span class="font-medium">{{ ucfirst($car->fuel_type) }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Kursi:</span>
                        <span class="font-medium">{{ $car->seats }} seats</span>
                    </div>
                </div>

                <div class="border-t pt-4 mb-4">
                    <div class="space-y-2 text-sm">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Harga per Hari:</span>
                            <span class="font-medium">Rp {{ number_format($car->price_per_day, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Jumlah Hari:</span>
                            <span class="font-medium" id="totalDays">-</span>
                        </div>
                    </div>
                </div>

                <div class="border-t pt-4">
                    <div class="flex justify-between items-center">
                        <span class="text-lg font-semibold">Total:</span>
                        <span class="text-2xl font-bold text-blue-600" id="totalPrice">Rp 0</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
function calculateTotal() {
    const startDate = document.querySelector('input[name="start_date"]').value;
    const endDate = document.querySelector('input[name="end_date"]').value;
    const pricePerDay = {{ $car->price_per_day }};
    
    if (startDate && endDate) {
        const start = new Date(startDate);
        const end = new Date(endDate);
        const diffTime = Math.abs(end - start);
        const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)) + 1;
        
        if (diffDays > 0) {
            const total = diffDays * pricePerDay;
            document.getElementById('totalDays').textContent = diffDays + ' hari';
            document.getElementById('totalPrice').textContent = 'Rp ' + total.toLocaleString('id-ID');
        }
    }
}

// Initialize calculation on page load
window.addEventListener('DOMContentLoaded', calculateTotal);
</script>
@endsection