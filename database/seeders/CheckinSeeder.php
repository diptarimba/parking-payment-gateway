<?php

namespace Database\Seeders;

use App\Models\ParkingTransaction;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Ramsey\Uuid\Uuid;

class CheckinSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Check In
        // {"parking_type":"checkin","timestamp":"2022-07-29 01:00:00","user_id":1,"vehicle_id":1,"parking_location_id":1,"code":"98375e52-221d-4732-b662-eb9b696e668a"}

        // Check Out
        // {"parking_type":"checkout","timestamp":"2022-07-29 02:59:00","user_id":1,"code":"c245e483-18b9-41dc-bf18-01d6d5ddb151"}

        $parkingCheckin = ParkingTransaction::create([
            //'check_in' => Carbon::now()->subHours(rand(1,10))->format('Y-m-d H:i:s'),
            'check_in' => Carbon::now()->format('Y-m-d H:i:s'),
            'user_id' => 101
        ]);

        $parkingCheckin->parking_detail()->create([
            'vehicle_id' => 1,
            'parking_location_id' => 1,
            'code' => Uuid::uuid4()
        ]);
    }
}
