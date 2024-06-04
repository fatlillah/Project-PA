<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Order_detail;
use App\Models\Order_detail_size;
use Illuminate\Http\Request;

class OrderDetailController extends Controller
{
    public function index()
    {
        $orderDetailSize = Order_detail_size::orderBy('customer', 'desc')->get();
        if ($order_id = session('order_id')) {
            $orders = Order::find($order_id);
            return view('admin.orders-transaction.index', compact('orderDetailSize', 'order_id', 'orders'));
        }
    }

    public function data($id)
    {
        $orderDetail = Order_detail::with('detail_size')->where('order_id', $id)->get();
        $data = array();
        $total_item = 0;

        foreach ($orderDetail as $item) {
            $row = array();
            $row['name_product']    = $item->detail_size['name_product'];
            $row['amount']          = '<input type="number" class="form-control input-sm quantity" data-id="' . $item->id . '" value="' . $item->amount . '">';
            $row['action']          = '<div class="d-flex">
                                        <a onclick="editForm(`' . route('ukuran-detail-pesanan.update', $item->id) . '`)" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fas fa-pencil-alt"></i></a>
                                        <a onclick="deleteData(`' . route('transaksi-pemesanan.destroy', $item->id) . '`)" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a>
                                        </div>';
            $data[] = $row;
            $total_item += $item->amount;
        }

        $dataOrderDetail = datatables()
            ->of($data)
            ->addIndexColumn()
            ->rawColumns(['action', 'name_product', 'amount'])
            ->make(true);
        return $dataOrderDetail;
    }

    public function store(Request $request)
    {
        $orders = Order::findOrFail($request->order_id);
        $total_item = Order_detail::where('order_id', $request->order_id)->sum('amount');

        $orders->name_order = $request->name_order;
        $orders->phone = $request->phone;
        $orders->deadline = $request->deadline;
        $orders->total_item = $total_item;  
        $orders->DP = $request->DP;
        $orders->credit = $request->credit;
        $orders->update();

        return response()->json(['status' => 'success']);
    }

    public function update(Request $request, $id)
    {
        $orderDetail = Order_detail::find($id);
        $orderDetail->amount = $request->amount;
        $orderDetail->update();
    }

    public function destroy($id)
    {
        try {
            $orderDetail = Order_detail::find($id);
            $orderDetail->delete();
            return response()->json(['status' => 'success']);
        } catch (\Throwable $th) {
            return response()->json(['status' => 'error', 'message' => $th->getMessage()], 500);
        }
    }
}
