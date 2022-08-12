<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ParkingTransaction;
use Illuminate\Http\Request;
use Log;

class IotController extends Controller
{
    public function receiver(Request $request)
    {
        try{
            $this->validate($request, [
                'command' => 'required'
            ]);

            $type = $request->command;

            switch ($type)
            {
                case $type == 'checkin' || $type == 'recheckin':

                    $this->validate($request,[
                        'timestamp' => 'required',
                        'vehicle_id' => 'required',
                        'parking_location_id' => 'required',
                        'data.user_id' => 'required',
                        'data.code' => 'required'
                    ]);

                    $parkingCheck = ParkingTransaction::with('parking_detail')
                    ->whereHas('parking_detail', function($query) use ($request){
                        $query->where('code', $request->data['code']);
                    })
                    ->where('user_id', $request->data['user_id'])
                    ->first();

                    Log::info($parkingCheck);

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
                            'user_id' => $request->data['user_id']
                        ]);

                        $parkingCheckin->parking_detail()->create([
                            'vehicle_id' => $request->vehicle_id,
                            'parking_location_id' => $request->parking_location_id,
                            'code' => $request->data['code']
                        ]);
                    }
                    return response()->json(['status' => 'Check-in Success']);
                    break;
                case $type == 'checkout':
                    $this->validate($request, [
                        'timestamp' => 'required',
                        'data.user_id' => 'required',
                        'data.code' => 'required'
                    ]);
                    $parkingCheckout = ParkingTransaction::with('parking_detail')
                    ->whereHas('parking_detail', function($query) use ($request){
                        $query->where('code', $request->data['code']);
                    })
                    ->where('user_id', $request->data['user_id']);
                    $parkingCheckout->parking_detail->update([
                        'exit_gate_open' => $request->timestamp
                    ]);
                    return response()->json(['status' => 'Check-out Success']);
                    break;
            }
        }
        catch(\Throwable $e){
            return response()->json($e->getMessage());
            // return response()->json($request->toArray());
        }
    }
}
