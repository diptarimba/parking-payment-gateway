<?php

namespace App\Http\Controllers;

use App\Models\ParkingTransaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Midtrans\Snap;
use Midtrans\Transaction;
use Ramsey\Uuid\Uuid;

class ParkingTransactionController extends Controller
{
    public function checkin(Request $request)
    {
        // buat validasi front-end
        if($request->ajax()){
            $check = ParkingTransaction::whereHas('parking_detail', function($query) use ($request){
                $query->where('code', $request->code);
            })->whereNull('check_out')->first();

            $data = $check == null ? ['result' => 'not found'] : ['result' => 'exist'];

            return response()->json($data);
        }

        //Validasi udah checkin atau belum
        $isCheckIn = ParkingTransaction::when(Auth::guard('web')->check() !== null, function($query){
            $query->where('user_id', Auth::guard('web')->user()->id);
            $query->whereNull('check_out');
        })->first();

        // Kalau checkin di redirect ke checkout
        if($isCheckIn !== null){
            return redirect()->route('checkout.index')->with('error', 'Silahkan check out terlebih dahulu!');;
        }

        // generate code baru checkin
        $exists = 1;
        while($exists){
            $code = Uuid::uuid4();
            $check = ParkingTransaction::whereHas('parking_detail', function($query) use ($code){
                $query->where('code', $code);
            })->first();
            $exists = $check == null ? 0 : 1;
        }

        $user = Auth::guard('web')->user()->id;
        return view('pages.checkin.index', compact('code', 'user'));
    }

    public function checkin_post(Request $request)
    {
        if($request->ajax()){
            try {
                $transaction = ParkingTransaction::create([
                    'check_in' => Carbon::now()->format('Y-m-d H:i:s'),
                    'user_id' => $request->user_id
                ]);
                $transaction->parking_detail->create([
                    'code' => $request->code,
                    'vehicle_id' => $request->vehicle_id
                ]);
                return response()->json(['status' => 'success', 'msg' => 'Success Checkin']);
            }catch(\Throwable $e){
                return response()->json(['status' => 'error', 'msg' => $e->getMessage()]);
            }
        }
    }

    public function checkout(Request $request)
    {
        $parking = ParkingTransaction::with(
                'user',
                'parking_detail.vehicle',
                'parking_detail.parking_location',
                'parking_detail.payment_transaction'
            )
            ->whereUserId(Auth::user()->id)
            ->whereNull('check_out')
            ->first();

        if($request->ajax()){

            if($parking == null){
                return response()->json(['result' => 'paid']);
            }

            // Memanggil controller perhitungan biaya yang perlu dibayar
            $cost = $this->generateCost($request, $parking);

            if(isset($request->checkout_type))
            {
                // Memanggil controller generator snap token midtrans
                return $this->generateSnapToken($cost, $parking);
            }
            return response()->json(['cost' => $cost]);
        }

        if($parking == null){
            return redirect()->route('checkin.index')->with('error', 'Silahkan check in terlebih dahulu!');
        }

        // $parking = ParkingTransaction::with('parking_detail.vehicle')->whereUserId(Auth::user()->id)->whereNull('check_out')->first();
        $check_in = Carbon::parse($parking->check_in)->format('d F Y H:i:s A');
        return view('pages.checkout.index', compact('parking', 'check_in'));
    }

    // Menghitung biaya yang perlu dibayar
    public function generateCost(Request $request, $parking)
    {
        // Waktu Checkin convert ke format package Carbon
        $check_in = Carbon::parse($parking->check_in);
        // Generate waktu transaksi checkout dengan format package carbon
        $check_now = Carbon::now();
        // Calculate selisih jam masuk dan keluar
        $hoursSpend = $check_now->diffInHours($check_in);
        // Calculate cost
        $cost = $parking->parking_detail->first()->vehicle->price + ($hoursSpend * $parking->parking_detail->first()->vehicle->add);

        // Kembalikan data kepada pemanggil
        return $cost;
    }

    public function generateSnapToken($cost = null, $parking = null )
    {
        // redeclare code
        $code = $parking->parking_detail->code;

        $params = array(
            'transaction_details' => array(
                'order_id' => $code,
                'gross_amount' => $cost,
            ),
            'customer_details' => array(
                'first_name' => $parking->user->name,
                'email' => $parking->user->email,
            ),
        );
        // Generate new token
        $snapToken = Snap::getSnapToken($params);
        // Save token
        $parking->parking_detail->payment_transaction()->updateOrCreate([
            'amount' => $cost,
            'order_id' => $code,
        ]);

        return response()->json(['token' => $snapToken]);
    }
}
