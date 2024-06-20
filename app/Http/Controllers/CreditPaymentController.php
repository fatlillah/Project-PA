<?php

namespace App\Http\Controllers;

use App\Models\Credit_payment;
use App\Models\Credit_payment_detail;
use Illuminate\Http\Request;

class CreditPaymentController extends Controller
{
    public function index()
    {
        $creditPay = Credit_payment::orderBy('id', 'desc')->get();
        return view('admin.credit.pay.index', compact('creditPay'));
    }

    public function nota($id)
    {
        $creditPayment = Credit_payment::with([
            'credit.creditOrder.order.orderDetail',
            'creditPayDetail'
        ])->find($id);

        if (!$creditPayment) {
            abort(404, 'Credit Payment not found');
        }

        $creditOrder = $creditPayment->credit->creditOrder;
        $order = $creditOrder->order;
        $orderDetails = $order->orderDetail;
        $paymentDetails = $creditPayment->creditPayDetail;

        return view('admin.credit.pay-detail.receipt', compact('creditPayment', 'creditOrder', 'order', 'orderDetails', 'paymentDetails'));
    }
}
