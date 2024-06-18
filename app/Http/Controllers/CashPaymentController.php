<?php

namespace App\Http\Controllers;

use App\Models\Cash_payment;
use App\Models\Completed_order;
use Illuminate\Http\Request;

class CashPaymentController extends Controller
{
    public function show($id)
    {
        $cashPay = Cash_payment::with('cashOrder')->where('cash_order_id', $id)->get();
        $cashOrder = Completed_order::with('order')->find($id);
        $order = $cashOrder->order;
        $orderDetail = $cashOrder->order->orderDetail;
        return view('admin.cash-payment.show', compact('cashPay', 'order', 'orderDetail', 'cashOrder', 'orderDetail'));
    }

    public function data($id)
    {
        $sales = Cash_payment::with('cashOrder')
            ->where('cash_order_id', $id)
            ->get();
        $data = array();
        $total = 0;

        foreach ($sales as $item) {
            $row = array();
            $row['name']            = $item->cashOrder['name'];
            $row['amount']          = '<input type="number" class="form-control input-sm quantity" data-id="' . $item->id . '" value="' . $item->amount . '">';
            $row['discount']        = '<div class="input-group">
                                        <input type="number" class="form-control input-sm disc" data-id="' . $item->id . '" value="' . $item->discount . '" style="border-top-right-radius: 0; border-bottom-right-radius: 0;">
                                        <span class="input-group-text" style="border-top-left-radius: 0; border-bottom-left-radius: 0;">%</span>
                                        </div>';
            $row['selling_price']   = format_of_money($item->selling_price);
            $row['subtotal']        = format_of_money($item->subtotal);
            $row['action']          = '<div class="d-flex">
                                        <a onclick="deleteData(`' . route('transaksi-penjualan.destroy', $item->id) . '`)" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a>
                                        </div>';
            $data[] = $row;

            $total += $item->subtotal;
        }
        $data[] = [
            'name' => '<div class="total hide">' . $total . '</div>',
            'amount' => '',
            'discount' => '',
            'selling_price' => '',
            'subtotal' => '',
            'action' => ''
        ];
        // dd($detail);
        $dataSales = datatables()
            ->of($data)
            ->addIndexColumn()
            ->rawColumns(['action', 'name', 'amount', 'discount'])
            ->make(true);
        // echo '<pre>';
        return $dataSales;
        // print_r($dataSales);
        // echo '</pre>';
    }
    
}
