<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Order_detail;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function create()
    {
        $lastOrder = Order::orderBy('id', 'desc')->first();
        $orderNumber = 'PO-RES' . date('dmy') . str_pad(($lastOrder ? ((int)substr($lastOrder->no_order, -4)) + 1 : 1), 4, '0', STR_PAD_LEFT);

        $orders = new Order();
        $orders->no_order = $orderNumber;
        $orders->name_order = 'Tidak ada';
        $orders->phone = 0;
        $orders->deadline = 0;
        $orders->total_item = 0;
        $orders->DP = 0;
        $orders->credit = 'Tidak';
        $orders->user_id = auth()->id();
        $orders->save();

        session()->put(['order_id' => $orders->id]);
        return redirect()->route('transaksi-pemesanan.index');
    }

    public function nota()
    {
        $orders = Order::find(session('order_id'));
        if (!$orders) {
            abort(404);
        }
        $orderDetail = Order_detail::with('detail_size')
            ->where('order_id', session('order_id'))
            ->get();

        return view('admin.orders-transaction.nota', compact('orders', 'orderDetail'));
    }
}
