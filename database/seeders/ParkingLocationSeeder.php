<?php

namespace Database\Seeders;

use App\Models\ParkingLocation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class ParkingLocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ParkingLocation::factory()->count(4)->state(
            new Sequence(
                ['image' => '/storage/placeholder/location/tsmMajapahit.jpg', 'name' => 'Transmart Majapahit'],
                ['image' => '/storage/placeholder/location/paragon.jpg', 'name' => 'Paragon Mall'],
                ['image' => '/storage/placeholder/location/javamall.jpg', 'name' => 'Java Supermall'],
                ['image' => '/storage/placeholder/location/lawangsewu.jpg', 'name' => 'Lawang Sewu'],
            )
        )->create();
    }
}
