<?php

namespace App\Http\Controllers;

use App\Models\Completed_order;
use App\Models\Credit;
use App\Models\Credit_payment;
use App\Models\Credit_payment_detail;
use App\Models\Tenor;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CreditController extends Controller
{
    public function index()
    {
        $creditOrder = Completed_order::with('order')->orderBy('id', 'desc')->get();
        $tenor = Tenor::all();
        return view('admin.credit.data-credit.index', compact('creditOrder', 'tenor'));
    }

    public function data()
    {
        $credits = Credit::with('creditOrder')
                        ->whereIn('id', function ($query) {
                            $query->select(DB::raw('MAX(id)'))
                                  ->from('credits')
                                  ->groupBy('credit_order_id');
                        })
                        ->orderBy('credit_order_id', 'desc')
                        ->get();
    
        $dataCredit = datatables()
                        ->of($credits)
                        ->addIndexColumn()
                        ->addColumn('date', function ($credit) {
                            return indonesian_date($credit->created_at, false);
                        })
                        ->addColumn('customer', function ($credit) {
                            return $credit->creditOrder->order->customer->name;
                        })
                        ->addColumn('total_item', function ($credit) {
                            return $credit->creditOrder->order->total_item;
                        })
                        ->addColumn('price', function ($credit) {
                            return format_of_money($credit->creditOrder->price);
                        })
                        ->addColumn('tenor', function ($credit) {
                            return $credit->tenor->jum_tenor . ' Bulan';
                        })
                        ->addColumn('action', function ($credit) {
                            return '
                                <div class="d-flex">
                                    <a onclick="deleteCredit(`' . route('data-kredit.destroy', $credit->id) . '`)" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a>
                                </div>
                            ';
                        })
                        ->make(true);
    
        return $dataCredit;
    }
    
    public function store(Request $request)
    {
        // validasi
        // $this->validate($request, [
        //     'name' => 'required|unique:categories'
        // ], [
        //     'name.required' => 'Kategori wajib diisi',
        //     'name.unique' => 'Kategori yang dimasukkan sudah ada',
        // ]);

        // simpan data kredit
        $credit = Credit::with('creditOrder')->create($request->all());

        // simpan pembayaran kredit
        $paidAmount = $credit->creditOrder->order->DP;
        $remainingBill = $credit->creditOrder->price - $paidAmount;

        $creditPay = Credit_payment::create([
            'credit_id' => $credit->id,
            'paid' => $paidAmount,
            'remaining_bill' => $remainingBill,
        ]);

        // simpan detail pembayaran kredit
        $tenor = $request->input('tenor', $creditPay->credit->tenor->jum_tenor);
        $totalPrice = $creditPay->credit->creditOrder->price;
        $downPayment = $creditPay->credit->creditOrder->order->DP;
        $totalAfterDP = $totalPrice - $downPayment;
        $monthlyBill = $totalAfterDP / $tenor;
        $currentMonth = Carbon::now()->startOfMonth()->addMonth();
        $dayLate = $creditPay->created_at;

        for ($i = 0; $i < $tenor; $i++) {
            $creditPayDetail = new Credit_payment_detail();
            $creditPayDetail->credit_pay_id = $creditPay->id;
            $creditPayDetail->month = $currentMonth->copy()->addMonths($i);
            $creditPayDetail->no_credit = $i + 1;
            $creditPayDetail->bill = $monthlyBill;
            $creditPayDetail->status = 'Belum bayar';
            $payDate = $currentMonth->copy()->addMonths($i)->day($dayLate->day);
            $creditPayDetail->pay_date = $payDate;
            $creditPayDetail->save();
        }

        return response()->json([
            'status' => 'success',
        ]);
    }


    public function destroy($id)
    {
        try {
            $credit = Credit::find($id);
            $credit->delete();
            return response()->json(['status' => 'success']);
        } catch (\Throwable $th) {
            return response()->json(['status' => 'error', 'message' => $th->getMessage()], 500);
        }
    }
}
