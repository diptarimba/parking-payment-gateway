<?php

namespace App\Http\Controllers;

use App\Models\ParkingDetail;
use App\Models\ParkingTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $totalParking = ParkingTransaction::where('user_id', Auth::user()->id)->count();
        $totalLocation = ParkingDetail::whereHas('parking_transaction', function($query){
            $query->where('user_id', Auth::user()->id);
        })->groupBy('parking_location_id')->count();
        return view('pages.home.index', compact('totalParking', 'totalLocation'));
    }
}
