@extends('layouts.app')

@section('title', 'Edit Mobil')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
    <!-- Header -->
    <div class="mb-8">
        <a href="{{ route('admin.cars.index') }}" class="text-blue-500 hover:text-blue-700 mb-4 inline-block">
            ← Kembali ke List Mobil
        </a>
        <h1 class="text-3xl font-bold text-gray-900">Edit Mobil</h1>
        <p class="text-gray-600 mt-2">{{ $car->full_name }}</p>
    </div>

    <div class="bg-white rounded-lg shadow-lg p-8">
        <form action="{{ route('admin.cars.update', $car->_id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Brand & Model -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Brand *</label>
                    <input 
                        type="text" 
                        name="brand" 
                        value="{{ old('brand', $car->brand) }}" 
                        required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('brand') border-red-500 @enderror"
                    >
                    @error('brand')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Model *</label>
                    <input 
                        type="text" 
                        name="model" 
                        value="{{ old('model', $car->model) }}" 
                        required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('model') border-red-500 @enderror"
                    >
                    @error('model')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Year & License Plate -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Tahun *</label>
                    <input 
                        type="number" 
                        name="year" 
                        value="{{ old('year', $car->year) }}" 
                        required
                        min="1900"
                        max="{{ date('Y') + 1 }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('year') border-red-500 @enderror"
                    >
                    @error('year')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Plat Nomor *</label>
                    <input 
                        type="text" 
                        name="license_plate" 
                        value="{{ old('license_plate', $car->license_plate) }}" 
                        required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('license_plate') border-red-500 @enderror"
                    >
                    @error('license_plate')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Color & Seats -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Warna *</label>
                    <input 
                        type="text" 
                        name="color" 
                        value="{{ old('color', $car->color) }}" 
                        required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('color') border-red-500 @enderror"
                    >
                    @error('color')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Jumlah Kursi *</label>
                    <select 
                        name="seats" 
                        required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('seats') border-red-500 @enderror"
                    >
                        @for($i = 2; $i <= 12; $i++)
                            <option value="{{ $i }}" {{ old('seats', $car->seats) == $i ? 'selected' : '' }}>{{ $i }} kursi</option>
                        @endfor
                    </select>
                    @error('seats')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Transmission & Fuel Type -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Transmisi *</label>
                    <select 
                        name="transmission" 
                        required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('transmission') border-red-500 @enderror"
                    >
                        <option value="manual" {{ old('transmission', $car->transmission) == 'manual' ? 'selected' : '' }}>Manual</option>
                        <option value="automatic" {{ old('transmission', $car->transmission) == 'automatic' ? 'selected' : '' }}>Automatic</option>
                    </select>
                    @error('transmission')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Bahan Bakar *</label>
                    <select 
                        name="fuel_type" 
                        required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('fuel_type') border-red-500 @enderror"
                    >
                        <option value="bensin" {{ old('fuel_type', $car->fuel_type) == 'bensin' ? 'selected' : '' }}>Bensin</option>
                        <option value="diesel" {{ old('fuel_type', $car->fuel_type) == 'diesel' ? 'selected' : '' }}>Diesel</option>
                        <option value="electric" {{ old('fuel_type', $car->fuel_type) == 'electric' ? 'selected' : '' }}>Electric</option>
                    </select>
                    @error('fuel_type')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Status & Price -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Status *</label>
                    <select 
                        name="status" 
                        required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('status') border-red-500 @enderror"
                    >
                        <option value="available" {{ old('status', $car->status) == 'available' ? 'selected' : '' }}>Available</option>
                        <option value="rented" {{ old('status', $car->status) == 'rented' ? 'selected' : '' }}>Rented</option>
                        <option value="maintenance" {{ old('status', $car->status) == 'maintenance' ? 'selected' : '' }}>Maintenance</option>
                    </select>
                    @error('status')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Harga Sewa per Hari (Rp) *</label>
                    <input 
                        type="number" 
                        name="price_per_day" 
                        value="{{ old('price_per_day', $car->price_per_day) }}" 
                        required
                        min="0"
                        step="1000"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('price_per_day') border-red-500 @enderror"
                    >
                    @error('price_per_day')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Features -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">Fitur (pisahkan dengan koma)</label>
                <input 
                    type="text" 
                    name="features" 
                    value="{{ old('features', is_array($car->features) ? implode(', ', $car->features) : '') }}" 
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                >
            </div>

            <!-- Description -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
                <textarea 
                    name="description" 
                    rows="4"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                >{{ old('description', $car->description) }}</textarea>
            </div>

            <!-- Current Images -->
            @if($car->images && count($car->images) > 0)
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">Foto Saat Ini</label>
                <div class="grid grid-cols-3 gap-4">
                    @foreach($car->images as $image)
                    <img src="{{ $image }}" alt="Car" class="w-full h-32 object-cover rounded-lg">
                    @endforeach
                </div>
            </div>
            @endif

            <!-- New Images -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">Upload Foto Baru (Opsional)</label>
                <input 
                    type="file" 
                    name="images[]" 
                    multiple
                    accept="image/*"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                >
                <p class="mt-1 text-sm text-gray-500">Upload foto baru akan mengganti foto lama</p>
            </div>

            <!-- Submit Buttons -->
            <div class="flex gap-4">
                <button 
                    type="submit" 
                    class="flex-1 bg-blue-500 text-white px-6 py-3 rounded-lg hover:bg-blue-600 transition font-medium"
                >
                    Update Mobil
                </button>
                <a 
                    href="{{ route('admin.cars.index') }}" 
                    class="flex-1 bg-gray-300 text-gray-700 px-6 py-3 rounded-lg hover:bg-gray-400 transition font-medium text-center"
                >
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection