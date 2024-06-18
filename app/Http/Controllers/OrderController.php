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
        $orders = Order::whereHas('customer', function ($query) {
            $query->where('name', '!=', '-');
        })->orderBy('created_at', 'asc')->get();

        $dataOrder = datatables()
            ->of($orders)
            ->addIndexColumn()
            ->addColumn('action', function ($orders) {
                return '<td class="py-2 text-end">
                                                    <div class="dropdown text-sans-serif"><button class="btn btn-primary tp-btn-light sharp" type="button" id="order-dropdown-0" data-bs-toggle="dropdown" data-boundary="viewport" aria-haspopup="true" aria-expanded="false"><span><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="18px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg></span></button>
                                                        <div class="dropdown-menu dropdown-menu-end border py-0" aria-labelledby="order-dropdown-0" style="margin: 0px;">
                                                            <div class="py-2">
                                                            <a class="dropdown-item" href="javascript:void(0);" onclick="updateStatus(' . $orders->id . ', 2)">Completed</a>
                                                            <a class="dropdown-item" href="javascript:void(0);" onclick="updateStatus(' . $orders->id . ', 1)">Processing</a>
                                                            <a class="dropdown-item" href="javascript:void(0);" onclick="updateStatus(' . $orders->id . ', 0)">Pending</a>
                                                                <div class="dropdown-divider"></div>
                                                                <a class="dropdown-item text-primary" href="javascript:void(0);" onclick="showDetail(`' . route('daftar-pemesanan.show', $orders->id) . '`)"><i class="fas fa-eye"></i> Detail</a>
                                                                <a class="dropdown-item text-danger" href="javascript:void(0);" onclick="deleteData(`' . route('daftar-pemesanan.destroy', $orders->id) . '`)"><i class="fa fa-trash"></i> Delete</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>';
            })
            ->addColumn('date', function ($orders) {
                return indonesian_date($orders->created_at, false);
            })
            ->addColumn('customer', function ($orders) {
                return $orders->customer->name ?? '-';
            })
            ->addColumn('total_item', function ($orders) {
                return $orders->total_item . ' pcs';
            })
            ->addColumn('DP', function ($orders) {
                return format_of_money($orders->DP);
            })
            ->addColumn('status', function ($orders) {
                switch ($orders->status) {
                    case 2:
                        return '<span class="badge badge-success">Completed<span class="ms-1 fa fa-check"></span></span>';
                    case 1:
                        return '<span class="badge badge-primary">Processing<span class="ms-1 fa fa-redo"></span></span>';
                    case 0:
                    default:
                        return '<span class="badge badge-warning">Pending<span class="ms-1 fas fa-stream"></span></span>';
                }
            })
            ->addColumn('user', function ($orders) {
                return $orders->user->name ?? '';
            })
            ->rawColumns(['status', 'action'])
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
        $orders->status = 0;
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
        $orders->status = 0;
        $orders->update();

        return response()->json(['status' => 'success']);
    }

    public function destroy($id)
    {
        try {
            $orders = Order::find($id);
            $orders->delete();
            return response()->json(['status' => 'success']);
        } catch (\Throwable $th) {
            return response()->json(['status' => 'error', 'message' => $th->getMessage()], 500);
            
        }
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

    public function updateStatus(Request $request)
    {
        $order = Order::findOrFail($request->order_id);
        $order->status = $request->status;
        $order->save();

        return response()->json(['status' => 'success', 'message' => 'Order status updated successfully.']);
    }
}
