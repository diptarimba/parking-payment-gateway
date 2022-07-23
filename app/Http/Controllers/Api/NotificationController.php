<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PaymentTransaction;
use App\Models\Setting;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class NotificationController extends Controller
{
    public function index(Request $request){
        $payment = PaymentTransaction::
            whereOrderId($request->order_id);
        $updatePayment = $payment
            ->update([
                'status' => $request->transaction_status,
                'transaction_time' => $request->transaction_time,
                'payment_type' => $request->payment_type
            ]);
        if($request->transaction_status == 'settlement'){
            $checkout_time = Carbon::now();
            $payment->first()->parking_detail()->first()->parking_transaction()->update([
                'check_out' => $checkout_time
            ]);
            $payment->first()->parking_detail()->update([
                'exp_code' => $checkout_time->addMinutes(Setting::findOrFail(1)->value)
            ]);
        }
    }
}
