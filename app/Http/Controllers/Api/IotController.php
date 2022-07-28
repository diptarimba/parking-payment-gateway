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

                    $parkingCheck = ParkingTransaction::with('parking_detail')
                    ->whereHas('parking_detail', function($query) use ($request){
                        $query->where('code', $request->code);
                    })
                    ->where('user_id', $request->user_id)
                    ->first();

                    if($parkingCheck !== null){
                        $parkingCheckin = ParkingTransaction::create([
                            'check_in' => $parkingCheck->check_out,
                            'user_id' => $parkingCheck->user_id
                        ]);

                        $parkingCheckin->parking_detail()->create([
                            'vehicle_id' => $parkingCheck->parking_detail->vehicle_id,
                            'parking_location_id' => $parkingCheck->parking_detail->parking_location_id,
                            'code' => $parkingCheck->parking_detail->code
                        ]);
                    }else{
                        $parkingCheckin = ParkingTransaction::create([
                            'check_in' => $request->timestamp,
                            'user_id' => $request->user_id
                        ]);

                        $parkingCheckin->parking_detail()->create([
                            'vehicle_id' => $request->vehicle_id,
                            'parking_location_id' => $request->parking_location_id,
                            'code' => $request->code
                        ]);
                    }
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
                    ->where('user_id', $request->user_id)->get();
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
