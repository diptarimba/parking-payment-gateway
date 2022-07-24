<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParkingTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'check_in',
        'check_out',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function parking_detail()
    {
        return $this->hasOne(ParkingDetail::class);
    }

    public function payment_transaction()
    {
        return $this->parking_detail()->payment_transaction();
    }
}
