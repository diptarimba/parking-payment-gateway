<?php

namespace App\Http\Controllers;

use App\Models\ParkingTransaction;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Yajra\DataTables\Facades\DataTables;

class ParkingHistoryController extends Controller
{
    public function history(Request $request)
    {
        if($request->ajax())
        {
            $parkingHistory = ParkingTransaction::with('parking_detail')
            ->whereHas('parking_detail.payment_transaction', function($query){
                $query->whereIn('status', ['settlement', 'pending', 'failure']);
            })->whereUserId(Auth::user()->id);
            return DataTables::of($parkingHistory)
                ->addIndexColumn()
                ->addColumn('check_in', function($query){
                    return Carbon::parse($query->check_in)->format('d F Y H:i:s A');
                })
                ->addColumn('check_out', function($query){
                    return $query->check_out ? Carbon::parse($query->check_out)->format('d F Y H:i:s A') : '-';
                })
                ->addColumn('vehicle', function($query){
                    return $query->parking_detail->vehicle->name;
                })
                ->addColumn('cost', function($query){
                    return 'Rp. ' .number_format($query->parking_detail->payment_transaction->amount, 0, ",", ".");
                })
                ->addColumn('action', function($query){
                    return $this->getActionColumn($query);
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('pages.history.index');
    }

    public function detail(Request $request, $code)
    {
        $parkingDetail = ParkingTransaction::with(
            'parking_detail.payment_transaction',
            'parking_detail.parking_location'
        )->whereHas('parking_detail', function($query) use($code){
            $query->where('code', $code);
        })
        ->whereHas('parking_detail.payment_transaction', function($query){
            $query->whereIn('status', ['settlement', 'pending']);
        })->first();

        $payment = $parkingDetail->parking_detail->payment_transaction;
        $transactionTime = $payment->transaction_time;
        $transactionStatus = $payment->status;
        $cost = $payment->amount;

        if (isset($request->print))
        {
            if($request->print == true){
                $pdf = Pdf::loadView('pages.print.index', compact('parkingDetail', 'transactionStatus', 'transactionTime', 'cost'));
                return $pdf->setPaper('a5')->download('invoice.pdf');
            }
        }

        return view('pages.history.detail', compact('parkingDetail', 'transactionStatus', 'transactionTime', 'cost'));
    }

    public function getActionColumn($query)
    {
        $returnData = '';
        $code = $query->parking_detail->code;
        $historyBtn = route('history.detail', ['code' => $code]);
        $expired = $query->parking_detail->exp_code;
        $user = Auth::user()->id;
        $validateQr = Carbon::parse(Carbon::now())->isBefore($expired);
        if($validateQr){
        // $qrCode = QrCode::size(200)->generate(json_encode(['user_id' => $user, 'code' => $code, 'expired' => $expired, 'parking_type' => 'checkout']));
        $qrCode = QrCode::size(200)->generate(base64_encode(json_encode(['user_id' => $user, 'code' => $code, 'expired' => $expired, 'parking_type' => 'checkout'])));
        $returnData .= '<button id="qr-checkout"class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">QR Check Out</button>
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">QR Check Out Gate</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="text-center">
                        '. $qrCode .'
                        <p class="notify">Waiting for scanning</p>
                    </div>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
            </div>
        </div>';
        }
        $returnData .= '<a target="_blank" href="'.$historyBtn.'" class="btn btn-primary">History</a>';

        return $returnData;
    }
}
