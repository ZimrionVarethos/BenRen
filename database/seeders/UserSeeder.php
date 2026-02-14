<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Admin
        User::create([
            'name' => 'Admin Rental',
            'email' => 'admin@rental.com',
            'password' => Hash::make('password123'),
            'phone' => '081234567890',
            'address' => 'Jakarta, Indonesia',
            'role' => 'admin',
            'is_active' => true,
        ]);

        // Driver 1
        User::create([
            'name' => 'Budi Santoso',
            'email' => 'driver1@rental.com',
            'password' => Hash::make('password123'),
            'phone' => '081234567891',
            'address' => 'Jakarta Selatan',
            'role' => 'driver',
            'driver_license' => 'A-123456789',
            'is_active' => true,
        ]);

        // Driver 2
        User::create([
            'name' => 'Ahmad Hidayat',
            'email' => 'driver2@rental.com',
            'password' => Hash::make('password123'),
            'phone' => '081234567892',
            'address' => 'Jakarta Barat',
            'role' => 'driver',
            'driver_license' => 'A-987654321',
            'is_active' => true,
        ]);

        // Customer 1
        User::create([
            'name' => 'Siti Nurhaliza',
            'email' => 'customer1@gmail.com',
            'password' => Hash::make('password123'),
            'phone' => '081234567893',
            'address' => 'Tangerang',
            'role' => 'customer',
            'is_active' => true,
        ]);

        // Customer 2
        User::create([
            'name' => 'Andi Wijaya',
            'email' => 'customer2@gmail.com',
            'password' => Hash::make('password123'),
            'phone' => '081234567894',
            'address' => 'Bekasi',
            'role' => 'customer',
            'is_active' => true,
        ]);

        echo "✅ Users seeded successfully!\n";
        echo "📧 Admin: admin@rental.com | Password: password123\n";
        echo "📧 Driver: driver1@rental.com | Password: password123\n";
        echo "📧 Customer: customer1@gmail.com | Password: password123\n";
    }
}