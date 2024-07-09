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
    
        return view('admin.credit.pay-detail.show', compact('creditPayDetail', 'creditPay', 'order', 'orderDetails', 'creditOrder', 'creditPayment'));
    }
    

    public function updateStatus($id)
    {
        $paymentDetail = Credit_payment_detail::find($id);

        if (!$paymentDetail) {
            return response()->json(['error' => 'Not Found'], 404);
        }

        // Set status to 'Sudah bayar'
        $paymentDetail->status = 'Sudah bayar';
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

        return response()->json([
            'status' => $paymentDetail->status,
            'receipt_url' => route('pembayaran-kredit-detail.nota', $paymentDetail->id),
            'cancel_url' => route('pembayaran-kredit-detail.cancel', $paymentDetail->id)
        ]);
    }

    public function cancel($id)
    {
        $paymentDetail = Credit_payment_detail::findOrFail($id);
        $paymentDetail->status = 'Belum bayar';
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

        return response()->json([
            'status' => $paymentDetail->status,
            'update_url' => route('pembayaran-kredit-detail.updateStatus', $paymentDetail->id)
        ]);
    }

    public function nota($id)
    {
        $creditPayDetail = Credit_payment_detail::with('creditPay.credit.creditOrder.order.orderDetail')->find($id);

        if (!$creditPayDetail) {
            abort(404, 'Payment Detail not found');
        }

        $creditPayment = $creditPayDetail->creditPay;
        $creditOrder = $creditPayment->credit->creditOrder;
        $order = $creditOrder->order;
        $orderDetails = $order->orderDetail;

        return view('admin.credit.pay-detail.print', compact('creditPayDetail', 'creditPayment', 'creditOrder', 'order', 'orderDetails'));
    }

    public function printAll($id)
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

        return view('admin.credit.pay-detail.print-all', compact('creditPayDetail', 'creditPay', 'order', 'orderDetails', 'creditOrder'));
    }
}
