<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParkingDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'parking_transaction_id',
        'code',
        'vehicle_id',
        'parking_location_id',
        'exp_code',
        'posted'
    ];

    public function parking_transaction()
    {
        return $this->belongsTo(ParkingTransaction::class, 'parking_transaction_id');
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class, 'vehicle_id');
    }

    public function parking_location()
    {
        return $this->belongsTo(ParkingLocation::class, 'parking_location_id');
    }

    public function payment_transaction()
    {
        return $this->hasOne(PaymentTransaction::class);
    }
}
