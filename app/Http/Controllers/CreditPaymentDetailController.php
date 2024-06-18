<?php

namespace App\Http\Controllers;

use App\Models\Credit_payment;
use App\Models\Credit_payment_detail;
use Illuminate\Http\Request;

class CreditPaymentDetailController extends Controller
{
    public function show($id)
    {
        $creditPay = Credit_payment::with('credit')->orderBy('id', 'desc')->get();
        $creditPayDetail = Credit_payment_detail::with('creditPay')->where('credit_pay_id', $id)->get();
        $creditPayment = Credit_payment::with('credit.creditOrder')->find($id);

        if (!$creditPayment) {
            abort(404, 'Payment not found');
        }

        $order = $creditPayment->credit->creditOrder->order;
        $orderDetails = $order->orderDetail;
        $creditOrder = $creditPayment->credit->creditOrder;

        return view('admin.credit.pay-detail.show', compact('creditPayDetail', 'creditPay', 'order', 'orderDetails', 'creditOrder'));
    }

    public function updateStatus($id)
    {
        $paymentDetail = Credit_payment_detail::find($id);

        if (!$paymentDetail) {
            return response()->json(['error' => 'Not Found'], 404);
        }

        // Toggle status
        if ($paymentDetail->status === 'Belum bayar') {
            $paymentDetail->status = 'Sudah bayar';
        } else {
            $paymentDetail->status = 'Belum bayar';
        }

        $paymentDetail->save();

        // Update paid and remaining bill
        $creditPayment = Credit_payment::find($paymentDetail->credit_pay_id);
        if ($creditPayment) {
            $creditOrder = $creditPayment->credit->creditOrder;
            $dp = $creditOrder->order->DP;

            $paidAmount = $dp + Credit_payment_detail::where('credit_pay_id', $creditPayment->id)
                ->where('status', 'Sudah bayar')
                ->sum('bill');

            $remainingBill = $creditOrder->price - $paidAmount;

            $creditPayment->paid = $paidAmount;
            $creditPayment->remaining_bill = $remainingBill;
            $creditPayment->save();
        }

        return response()->json(['status' => $paymentDetail->status]);
    }

    public function destroy($id)
    {
        $paymentDetail = Credit_payment_detail::find($id);

        if (!$paymentDetail) {
            return response()->json(['error' => 'Not Found'], 404);
        }

        $paymentDetail->delete();

        return response()->json(['success' => true]);
    }

    public function printNota($id)
    {
        $creditPayment = Credit_payment::with('credit.creditOrder.order.orderDetail.detail_size', 'credit.creditOrder.order.customer')->findOrFail($id);
        $creditPayDetail = Credit_payment_detail::with('creditPay')->where('credit_pay_id', $id)->get();
        $order = $creditPayment->credit->creditOrder->order;

        return view('admin.credit.pay-detail.print', compact('order', 'creditPayDetail'));
    }

    
}

