<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'add'
    ];

    public function parking_detail()
    {
        return $this->hasMany(ParkingDetail::class);
    }
}
