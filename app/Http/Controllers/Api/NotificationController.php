<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PaymentTransaction;
use App\Models\Setting;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class NotificationController extends Controller
{
    // Menyimpan data konfirmasi dari midtrans
    public function index(Request $request){
        $payment = PaymentTransaction::
            with('parking_detail', 'parking_detail.parking_transaction')
            ->whereOrderId($request->order_id);
        $updatePayment = $payment
            ->update([
                'status' => $request->transaction_status,
                'transaction_time' => $request->transaction_time,
                'payment_type' => $request->payment_type
            ]);
        if($request->transaction_status == 'settlement'){
            $checkout_time = Carbon::now();
            $payment->first()->parking_detail->parking_transaction()->update([
                'check_out' => $checkout_time
            ]);
            $payment->first()->parking_detail()->update([
                'exp_code' => $checkout_time->addMinutes(Setting::findOrFail(1)->value)
            ]);
            if(config('dashboard.url') !== ''){
                $this->sendToDashboard($request->order_id);
            }
        }
    }

    // Mengiriim data ke API Dashboard (Parking History)
    public function sendToDashboard($order_id)
    {
        $parking = PaymentTransaction::with('parking_detail', 'parking_detail.payment_transaction', 'parking_detail.vehicle')->
        whereOrderId($order_id)->first();

        $response = Http::post(config('dashboard.url'), [
            'parking_location_id' => $parking->parking_detail->parking_location_id,
            'code' => $parking->parking_detail->code,
            'vehicle' => $parking->parking_detail->vehicle->name,
            'amount' => $parking->amount,
            'check_in' => $parking->parking_detail->parking_transaction->check_in,
            'check_out' => $parking->parking_detail->parking_transaction->check_in,
            'payment_status' => $parking->status,
            'payment_type' => $parking->payment_type
        ]);

        $message = json_decode($response)->message;
        if($message == 'success')
        {
            $parking->parking_detail->parking_transaction()->update([
                'posted' => 1
            ]);
        }
    }
}
