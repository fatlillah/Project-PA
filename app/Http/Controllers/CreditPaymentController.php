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
}
