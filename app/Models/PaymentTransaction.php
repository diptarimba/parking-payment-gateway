<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'payment_type',
        'order_id',
        'transaction_time',
        'parking_detail_id',
        'amount',
        'status'
    ];

    public function parking_detail()
    {
        return $this->belongsTo(ParkingDetail::class, 'parking_detail_id');
    }

}
