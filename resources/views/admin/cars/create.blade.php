@extends('layouts.app')

@section('title', 'Tambah Mobil Baru')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
    <!-- Header -->
    <div class="mb-8">
        <a href="{{ route('admin.cars.index') }}" class="text-blue-500 hover:text-blue-700 mb-4 inline-block">
            ← Kembali ke List Mobil
        </a>
        <h1 class="text-3xl font-bold text-gray-900">Tambah Mobil Baru</h1>
        <p class="text-gray-600 mt-2">Lengkapi form untuk menambahkan mobil</p>
    </div>

    <div class="bg-white rounded-lg shadow-lg p-8">
        <form action="{{ route('admin.cars.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Brand & Model -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Brand *</label>
                    <input 
                        type="text" 
                        name="brand" 
                        value="{{ old('brand') }}" 
                        required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('brand') border-red-500 @enderror"
                        placeholder="Toyota, Honda, dll"
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
                        value="{{ old('model') }}" 
                        required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('model') border-red-500 @enderror"
                        placeholder="Avanza, Jazz, dll"
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
                        value="{{ old('year', date('Y')) }}" 
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
                        value="{{ old('license_plate') }}" 
                        required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('license_plate') border-red-500 @enderror"
                        placeholder="B 1234 ABC"
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
                        value="{{ old('color') }}" 
                        required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('color') border-red-500 @enderror"
                        placeholder="Putih, Hitam, dll"
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
                        <option value="">Pilih...</option>
                        @for($i = 2; $i <= 12; $i++)
                            <option value="{{ $i }}" {{ old('seats') == $i ? 'selected' : '' }}>{{ $i }} kursi</option>
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
                        <option value="">Pilih...</option>
                        <option value="manual" {{ old('transmission') == 'manual' ? 'selected' : '' }}>Manual</option>
                        <option value="automatic" {{ old('transmission') == 'automatic' ? 'selected' : '' }}>Automatic</option>
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
                        <option value="">Pilih...</option>
                        <option value="bensin" {{ old('fuel_type') == 'bensin' ? 'selected' : '' }}>Bensin</option>
                        <option value="diesel" {{ old('fuel_type') == 'diesel' ? 'selected' : '' }}>Diesel</option>
                        <option value="electric" {{ old('fuel_type') == 'electric' ? 'selected' : '' }}>Electric</option>
                    </select>
                    @error('fuel_type')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Price -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">Harga Sewa per Hari (Rp) *</label>
                <input 
                    type="number" 
                    name="price_per_day" 
                    value="{{ old('price_per_day') }}" 
                    required
                    min="0"
                    step="1000"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('price_per_day') border-red-500 @enderror"
                    placeholder="300000"
                >
                @error('price_per_day')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Features -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">Fitur (pisahkan dengan koma)</label>
                <input 
                    type="text" 
                    name="features" 
                    value="{{ old('features') }}" 
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="AC, Audio System, Power Steering, Airbag"
                >
                <p class="mt-1 text-sm text-gray-500">Contoh: AC, GPS, Bluetooth, Airbag</p>
            </div>

            <!-- Description -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
                <textarea 
                    name="description" 
                    rows="4"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="Deskripsi mobil..."
                >{{ old('description') }}</textarea>
            </div>

            <!-- Images -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">Foto Mobil</label>
                <input 
                    type="file" 
                    name="images[]" 
                    multiple
                    accept="image/*"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                >
                <p class="mt-1 text-sm text-gray-500">Upload beberapa foto (max 2MB per foto)</p>
            </div>

            <!-- Submit Buttons -->
            <div class="flex gap-4">
                <button 
                    type="submit" 
                    class="flex-1 bg-blue-500 text-white px-6 py-3 rounded-lg hover:bg-blue-600 transition font-medium"
                >
                    Simpan Mobil
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