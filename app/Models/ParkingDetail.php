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
        'payment_id'
    ];

    public function parking_transaction()
    {
        return $this->belongsTo(ParkingTransaction::class, 'parking_transaction_id');
    }
}
