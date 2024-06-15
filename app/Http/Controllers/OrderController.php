<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use App\Models\Order_detail;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        return view('admin.orders-list.index');
    }

    public function data()
    {
        $orders = Order::orderBy('id', 'desc')->get();
        $dataOrder = datatables()
            ->of($orders)
            ->addIndexColumn()
            ->addColumn('date', function ($orders) {
                return indonesian_date($orders->created_at, false);
            })
            ->addColumn('customer', function ($orders) {
                return $orders->customer->name;
            })
            ->addColumn('DP', function ($orders) {
                return format_of_money($orders->DP);
            })
            ->addColumn('user', function ($orders) {
                return $orders->user->name ?? '';
            })
            ->addColumn('action', function ($orders) {
                return '
                <div class="d-flex">
                <a onclick="showDetail(`' . route('daftar-pemesanan.show', $orders->id) . '`)" class="btn btn-secondary shadow btn-xs sharp me-1"><i class="fas fa-eye"></i></a>
                <a onclick="deleteData(`' . route('daftar-pemesanan.destroy', $orders->id) . '`)" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a>
                </div>
                ';
            })
            ->make(true);
        return $dataOrder;
    }

    public function create()
    {
        $lastOrder = Order::orderBy('id', 'desc')->first();
        $orderNumber = 'PO-RES' . date('dmy') . str_pad(($lastOrder ? ((int)substr($lastOrder->no_order, -4)) + 1 : 1), 4, '0', STR_PAD_LEFT);

        $orders = new Order();
        $orders->no_order = $orderNumber;
        $orders->customer_id = 1;
        $orders->deadline = 0;
        $orders->total_item = 0;
        $orders->DP = 0;
        $orders->user_id = auth()->id();
        $orders->save();

        session()->put(['order_id' => $orders->id]);
        return redirect()->route('transaksi-pemesanan.index');
    }

    public function store(Request $request)
    {
        $orders = Order::findOrFail($request->order_id);
        $total_item = Order_detail::where('order_id', $request->order_id)->sum('amount');
        $customer = Customer::findOrFail($request->customer_id);

        $orders->customer_id = $customer->id;
        $orders->deadline = $request->deadline;
        $orders->total_item = $total_item;
        $orders->DP = $request->DP;
        $orders->update();

        return response()->json(['status' => 'success']);
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
