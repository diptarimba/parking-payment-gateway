<?php

namespace Database\Seeders;

use App\Models\Vehicle;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VehicleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name' => 'Motor',
                'price' => 2000,
                'add' => 1000,
            ],
            [
                'name' => 'Mobil',
                'price' => 3000,
                'add' => 2000
            ]
        ];

        Vehicle::insert($data);
    }
}
