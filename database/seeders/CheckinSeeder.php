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
        $parkingCheckin = ParkingTransaction::create([
            'check_in' => Carbon::now()->subHours(rand(1,10))->format('Y-m-d H:i:s'),
            'user_id' => 1
        ]);

        $parkingCheckin->parking_detail()->create([
            'vehicle_id' => 1,
            'parking_location_id' => 2,
            'code' => Uuid::uuid4()
        ]);
    }
}
