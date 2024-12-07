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
            $imu = new Imu();
            $imu->x = rand(0, 100);
            $imu->y = rand(0, 100);
            $imu->z = rand(0, 100);
            $imu->location = 'Location ' . $i;
            $imu->lat = rand(0, 100);
            $imu->lon = rand(0, 100);
            $imu->alt = rand(0, 100);
            $imu->status = 'Status ' . $i;
            $imu->description = 'Description ' . $i;
            $imu->save();
        }
    }
}
