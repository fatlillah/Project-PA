<?php

namespace App\Http\Controllers;

use App\Models\Credit_payment;
use Illuminate\Http\Request;

class CreditPaymentController extends Controller
{
    public function index()
    {
        $creditPay = Credit_payment::orderBy('id', 'desc')->get();
        return view('admin.credit.pay.index', compact('creditPay'));
    }

    public function create()
    {
        $creditPay = new Credit_payment();
        $creditPay->customer_id = 1;
        $creditPay->deadline = 0;
        $creditPay->total_item = 0;
        $creditPay->DP = 0;
        $creditPay->user_id = auth()->id();
        $creditPay->save();

        session()->put(['order_id' => $creditPay->id]);
        return redirect()->route('transaksi-pemesanan.index');
    }
}
