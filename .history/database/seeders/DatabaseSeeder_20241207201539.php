<?php

namespace Database\Seeders;

use App\Models\Imu;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        for ($i = 0; $i < 10; $i++) {
            Imu::create(
                [
                    'x' => rand(0, 100),
                    'y' => rand(0, 100),
                    'z' => rand(0, 100),
                    'location' => 'Location ' . $i,
                    'latitude' => rand(0, 100),
                    'longitude' => rand(0, 100),
                    'altitude' => rand(0, 100),
                    'status' => 'Status ' . $i,
                    'description' => 'Description ' . $i,
                ]
                );
        }
    }
}
