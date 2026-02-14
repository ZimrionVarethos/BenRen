<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Car;

class CarSeeder extends Seeder
{
    public function run()
    {
        $cars = [
            [
                'brand' => 'Toyota',
                'model' => 'Avanza',
                'year' => 2022,
                'license_plate' => 'B 1234 ABC',
                'color' => 'Silver',
                'seats' => 7,
                'transmission' => 'manual',
                'fuel_type' => 'bensin',
                'price_per_day' => 350000,
                'status' => 'available',
                'images' => [
                    'https://images.unsplash.com/photo-1583121274602-3e2820c69888',
                    'https://images.unsplash.com/photo-1552519507-da3b142c6e3d',
                ],
                'features' => ['AC', 'Audio System', 'Power Steering', 'Airbag'],
                'description' => 'Mobil keluarga yang nyaman dan irit bahan bakar',
                'current_location' => [
                    'latitude' => -6.2088,
                    'longitude' => 106.8456,
                    'address' => 'Jakarta Pusat',
                ],
            ],
            [
                'brand' => 'Honda',
                'model' => 'Jazz',
                'year' => 2023,
                'license_plate' => 'B 5678 DEF',
                'color' => 'White',
                'seats' => 5,
                'transmission' => 'automatic',
                'fuel_type' => 'bensin',
                'price_per_day' => 400000,
                'status' => 'available',
                'images' => [
                    'https://images.unsplash.com/photo-1590362891991-f776e747a588',
                ],
                'features' => ['AC', 'Audio System', 'Power Steering', 'Airbag', 'Parking Sensor'],
                'description' => 'City car yang lincah dan efisien',
                'current_location' => [
                    'latitude' => -6.1751,
                    'longitude' => 106.8650,
                    'address' => 'Jakarta Timur',
                ],
            ],
            [
                'brand' => 'Mitsubishi',
                'model' => 'Pajero Sport',
                'year' => 2021,
                'license_plate' => 'B 9012 GHI',
                'color' => 'Black',
                'seats' => 7,
                'transmission' => 'automatic',
                'fuel_type' => 'diesel',
                'price_per_day' => 800000,
                'status' => 'available',
                'images' => [
                    'https://images.unsplash.com/photo-1533473359331-0135ef1b58bf',
                ],
                'features' => ['AC', 'Audio System', 'Power Steering', 'Airbag', 'Cruise Control', '4WD', 'Leather Seats'],
                'description' => 'SUV tangguh untuk perjalanan jarak jauh',
                'current_location' => [
                    'latitude' => -6.2297,
                    'longitude' => 106.6894,
                    'address' => 'Jakarta Barat',
                ],
            ],
            [
                'brand' => 'Suzuki',
                'model' => 'Ertiga',
                'year' => 2022,
                'license_plate' => 'B 3456 JKL',
                'color' => 'Blue',
                'seats' => 7,
                'transmission' => 'manual',
                'fuel_type' => 'bensin',
                'price_per_day' => 320000,
                'status' => 'available',
                'images' => [
                    'https://images.unsplash.com/photo-1552519507-da3b142c6e3d',
                ],
                'features' => ['AC', 'Audio System', 'Power Steering'],
                'description' => 'MPV ekonomis untuk keluarga',
                'current_location' => [
                    'latitude' => -6.2615,
                    'longitude' => 106.7810,
                    'address' => 'Jakarta Selatan',
                ],
            ],
            [
                'brand' => 'Daihatsu',
                'model' => 'Xenia',
                'year' => 2023,
                'license_plate' => 'B 7890 MNO',
                'color' => 'Gray',
                'seats' => 7,
                'transmission' => 'manual',
                'fuel_type' => 'bensin',
                'price_per_day' => 300000,
                'status' => 'available',
                'images' => [
                    'https://images.unsplash.com/photo-1583121274602-3e2820c69888',
                ],
                'features' => ['AC', 'Audio System', 'Power Steering'],
                'description' => 'Mobil keluarga yang terjangkau',
                'current_location' => [
                    'latitude' => -6.1944,
                    'longitude' => 106.8229,
                    'address' => 'Jakarta Pusat',
                ],
            ],
        ];

        foreach ($cars as $car) {
            Car::create($car);
        }

        echo "✅ Cars seeded successfully! Total: " . count($cars) . " mobil\n";
    }
}