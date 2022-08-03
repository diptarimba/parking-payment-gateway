<?php

namespace Database\Seeders;

use App\Models\ParkingLocation;
use App\Models\ParkingSlot;
use App\Models\Vehicle;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ParkingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dataVehicle = Vehicle::pluck('id');
        $dataParkingLocation = ParkingLocation::pluck('id');

        $data = [];
        foreach($dataParkingLocation as $each){
            foreach($dataVehicle as $eachVehicle){
                $data[] = [
                    'parking_location_id' => $each,
                    'vehicle_id' => $eachVehicle,
                    'slot' => 100
                ];
            }
        }

        ParkingSlot::insert($data);
    }
}
