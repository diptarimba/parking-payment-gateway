<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ParkingTransaction;
use Illuminate\Http\Request;

class IotController extends Controller
{
    public function receiver(Request $request)
    {
        try{
            $this->validate($request, [
                'parking_type' => 'required'
            ]);

            $type = $request->parking_type;

            switch ($type)
            {
                case $type == 'checkin':
                    $this->validate($request,[
                        'timestamp' => 'required',
                        'user_id' => 'required',
                        'vehicle_id' => 'required',
                        'parking_location_id' => 'required',
                        'code' => 'required'
                    ]);

                    $parkingCheckin = ParkingTransaction::create([
                        'check_in' => $request->timestamp,
                        'user_id' => $request->user_id
                    ]);

                    $parkingCheckin->parking_detail()->create([
                        'vehicle_id' => $request->vehicle_id,
                        'parking_location_id' => $request->parking_location_id,
                        'code' => $request->code
                    ]);
                    return response()->json(['status' => 'Check-in Success']);
                    break;
                case $type == 'checkout':
                    $this->validate($request, [
                        'timestamp' => 'required',
                        'user_id' => 'required',
                        'code' => 'required'
                    ]);
                    $parkingCheckout = ParkingTransaction::with('parking_detail')
                    ->whereHas('parking_detail', function($query) use ($request){
                        $query->where('code', $request->code);
                    })
                    ->where('user_id', $request->user_id)->first();
                    $parkingCheckout->parking_detail()->update([
                        'exit_gate_open' => $request->timestamp
                    ]);
                    return response()->json(['status' => 'Check-out Success']);
                    break;
            }
        }
        catch(\Throwable $e){
            // return response()->json($e->getMessage());
            return response()->json($request->toArray());
        }
    }
}
