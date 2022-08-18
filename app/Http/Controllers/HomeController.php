<?php

namespace App\Http\Controllers;

use App\Models\ParkingDetail;
use App\Models\ParkingLocation;
use App\Models\ParkingTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()){
            if($request->location_name !== null){
                $dataSlot = ParkingLocation::with('parking_slot')->whereName($request->location_name)->first();
                if($dataSlot == null){
                    return response()->json(['slot' => [], 'parking_location' => []]);
                }

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

            return response()->json(['slot' => $dataSlot->toArray(), 'parking_location' => $dataParking]);
        }
        $parkingLocation = ParkingLocation::pluck('name');
        $totalParking = ParkingTransaction::where('user_id', Auth::user()->id)->count();
        $totalLocation = ParkingDetail::select('parking_location_id')->whereHas('parking_transaction', function($query){
            $query->where('user_id', Auth::user()->id);
        })->groupBy('parking_location_id')->get()->count();
        return view('pages.home.index', compact('totalParking', 'totalLocation', 'parkingLocation'));
    }
}
