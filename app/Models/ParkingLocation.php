<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParkingLocation extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description', 'latitude', 'longitude', 'image', 'location_code'
    ];

    public function parking_detail()
    {
        return $this->hasMany(ParkingDetail::class);
    }
}
