<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CarController extends Controller
{
    // List semua mobil
    public function index()
    {
        $cars = Car::orderBy('created_at', 'desc')->paginate(12);
        return view('admin.cars.index', compact('cars'));
    }

    // Form tambah mobil
    public function create()
    {
        return view('admin.cars.create');
    }

    // Simpan mobil baru
    public function store(Request $request)
    {
        $request->validate([
            'brand' => 'required|string|max:100',
            'model' => 'required|string|max:100',
            'year' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'license_plate' => 'required|string|unique:cars,license_plate',
            'color' => 'required|string|max:50',
            'seats' => 'required|integer|min:2|max:12',
            'transmission' => 'required|in:manual,automatic',
            'fuel_type' => 'required|in:bensin,diesel,electric',
            'price_per_day' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'images.*' => 'nullable|image|max:2048', // max 2MB
        ]);

        $data = $request->except('images');
        $data['status'] = 'available';
        $data['features'] = $request->features ? explode(',', $request->features) : [];

        // Upload images (untuk saat ini bisa menggunakan URL atau upload real)
        if ($request->hasFile('images')) {
            $images = [];
            foreach ($request->file('images') as $image) {
                $path = $image->store('cars', 'public');
                $images[] = Storage::url($path);
            }
            $data['images'] = $images;
        } else {
            // Dummy image jika tidak ada upload
            $data['images'] = ['https://via.placeholder.com/400x300?text=No+Image'];
        }

        // Set default location (Jakarta Pusat)
        $data['current_location'] = [
            'latitude' => -6.2088,
            'longitude' => 106.8456,
            'address' => 'Jakarta Pusat',
        ];

        Car::create($data);

        return redirect()->route('admin.cars.index')
            ->with('success', 'Mobil berhasil ditambahkan!');
    }

    // Form edit mobil
    public function edit($id)
    {
        $car = Car::findOrFail($id);
        return view('admin.cars.edit', compact('car'));
    }

    // Update mobil
    public function update(Request $request, $id)
    {
        $car = Car::findOrFail($id);

        $request->validate([
            'brand' => 'required|string|max:100',
            'model' => 'required|string|max:100',
            'year' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'license_plate' => 'required|string|unique:cars,license_plate,' . $id,
            'color' => 'required|string|max:50',
            'seats' => 'required|integer|min:2|max:12',
            'transmission' => 'required|in:manual,automatic',
            'fuel_type' => 'required|in:bensin,diesel,electric',
            'price_per_day' => 'required|numeric|min:0',
            'status' => 'required|in:available,rented,maintenance',
            'description' => 'nullable|string',
            'images.*' => 'nullable|image|max:2048',
        ]);

        $data = $request->except('images');
        $data['features'] = $request->features ? explode(',', $request->features) : [];

        // Upload new images if provided
        if ($request->hasFile('images')) {
            $images = [];
            foreach ($request->file('images') as $image) {
                $path = $image->store('cars', 'public');
                $images[] = Storage::url($path);
            }
            $data['images'] = $images;
        }

        $car->update($data);

        return redirect()->route('admin.cars.index')
            ->with('success', 'Mobil berhasil diupdate!');
    }

    // Hapus mobil
    public function destroy($id)
    {
        $car = Car::findOrFail($id);
        
        // Cek apakah mobil sedang disewa
        if ($car->activeOrder) {
            return redirect()->route('admin.cars.index')
                ->with('error', 'Mobil tidak dapat dihapus karena sedang disewa!');
        }

        $car->delete();

        return redirect()->route('admin.cars.index')
            ->with('success', 'Mobil berhasil dihapus!');
    }

    // Detail mobil
    public function show($id)
    {
        $car = Car::with('orders.customer')->findOrFail($id);
        return view('admin.cars.show', compact('car'));
    }
}