<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            CarSeeder::class,
        ]);

        echo "\n🎉 Database seeding completed successfully!\n\n";
        echo "=== LOGIN CREDENTIALS ===\n";
        echo "Admin:\n";
        echo "  Email: admin@rental.com\n";
        echo "  Password: password123\n\n";
        echo "Driver:\n";
        echo "  Email: driver1@rental.com\n";
        echo "  Password: password123\n\n";
        echo "Customer:\n";
        echo "  Email: customer1@gmail.com\n";
        echo "  Password: password123\n";
        echo "========================\n";
    }
}
