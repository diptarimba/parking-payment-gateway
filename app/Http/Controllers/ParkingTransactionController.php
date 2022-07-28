<?php

namespace App\Http\Controllers;

use App\Models\ParkingTransaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Midtrans\CoreApi;
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

        $user = Auth::guard('web')->user()->id;

        // Check Gate Sudah Terbuka Atau Belum
        $parkingCheck = ParkingTransaction::with('parking_detail')
            ->whereHas('parking_detail', function($query){
                $query->whereNull('exit_gate_open');
            })->where('user_id', $user)
            ->first();

        if($parkingCheck == null){
            // generate code baru checkin
            $exists = 1;
            while($exists){
                $code = Uuid::uuid4();
                $check = ParkingTransaction::whereHas('parking_detail', function($query) use ($code){
                    $query->where('code', $code);
                })->first();
                $exists = $check == null ? 0 : 1;
            }
        }else{
            // Menggunakan Code Lama, karena orangnya belum keluar
            $code = $parkingCheck->parking_detail->code;
        }


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

            if(isset($request->parking_type))
            {
                // Memanggil controller generator snap token midtrans
                return $this->getQRCode($cost, $parking);
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
        // Add price to the parking time
        $add = $parking->parking_detail->vehicle->add;

        // Calculate cost
        $parkingCheck4Cost = ParkingTransaction::with('parking_detail', function($query) use ($parking){
            $query->where('code', $parking->parking_detail->code);
        })->where('user_id', $parking->user_id)->count();

        if($parkingCheck4Cost == 1){
            $cost = $parking->parking_detail->vehicle->price + ($hoursSpend * $add);
        }else{
            $cost = $hoursSpend == 0? 1 * $add : $hoursSpend * $add;
        }

        // Kembalikan data kepada pemanggil
        return $cost;
    }

    public function getQRCode($cost = null, $parking = null )
    {
        // redeclare code
        $code = $parking->parking_detail->code;
        $payment = $parking->parking_detail->payment_transaction;
        $status = $payment->status ?? null;
        $amount = $payment->amount ?? null;

        Log::info('cost ' . $cost );
        Log::info('amount ' . $amount);

        if($status == 'pending' && $cost == $amount)
        {
            return response()->json([
                'result' => 'pending',
                'data' => []
            ]);
        }
        elseif ($status == 'pending' && $cost !== $amount)
        {
            Transaction::cancel($code);
        }

        $params = array(
            'transaction_details' => array(
                'order_id' => $code,
                'gross_amount' => $cost,
            ),
            'customer_details' => array(
                'first_name' => $parking->user->name,
                'email' => $parking->user->email,
            ),
            'payment_type' => 'gopay',
            'gopay' => array(
                'enable_callback' =>  true,
                'callback_url' =>  route('history.index')
            )
        );
        // Generate Request
        $response = CoreApi::charge($params);
        Log::info(json_encode($response));
        // Save token
        $parking->parking_detail->payment_transaction()->updateOrCreate([
            'amount' => $cost,
            'order_id' => $code,
        ]);

        return response()->json([
            'result' => 'created',
            'data' => [
                'qr_code' => $response->actions[0]->url,
                'gopay' => $response->actions[1]->url
            ]
        ]);
    }
}
