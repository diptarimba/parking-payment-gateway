<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ParkingLocation;
use App\Models\ParkingTransaction;
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
        Log::info(json_encode($request->toArray()));
        $payment = PaymentTransaction::
            with('parking_detail', 'parking_detail.parking_transaction')
            ->whereOrderId($request->order_id);
        $updatePayment = $payment
            ->update([
                'transaction_id' => $request->transaction_id,
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
            'check_out' => $parking->parking_detail->parking_transaction->check_out,
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

    public function parkingSlot(Request $request)
    {
        if($request->location_name !== null){
            $dataSlot = ParkingLocation::with('parking_slot')->whereName($request->location_name)->first();

            $dataParking = $dataSlot->parking_slot->map(function ($queries) use ($request){
                $parkVehicle = ParkingTransaction::with('parking_detail')->whereHas('parking_detail', function($query) use ($request, $queries){
                        $query->whereHas('parking_location', function($query) use ($request){
                            $query->whereName($request->location_name);
                        });
                        $query->where('vehicle_id', $queries->vehicle_id);
                        $query->whereNull('exit_gate_open');
                    })->groupBy('user_id')->count();
                return [$queries->vehicle_id, $parkVehicle];
            });
        }

        return response()->json(['slot' => $dataSlot->toArray() ?? null, 'parking_location' => $dataParking ?? null]);
    }
}
