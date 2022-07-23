<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);
        $this->call(VehicleSeeder::class);
        $this->call(ParkingLocationSeeder::class);
        $this->call(SettingSeeder::class);

        $this->call(CheckinSeeder::class);
    }
}
