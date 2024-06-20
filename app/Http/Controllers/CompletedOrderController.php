<?php

namespace App\Http\Controllers;

use App\Models\Completed_order;
use App\Models\Order;
use Illuminate\Http\Request;

class CompletedOrderController extends Controller
{
    public function index()
    {
        $order = Order::with('orderDetail')->orderBy('id', 'desc')->get();
        return view('admin.order-completed.index', compact('order'));
    }

    public function data()
    {
        $complits = Completed_order::with('order')->get();

        $data = array();

        foreach ($complits as $complit) {
            $row = array();
            $row['no_order']   = $complit->order['no_order'];
            $row['customer']   = $complit->order->customer['name'];
            $row['total_item'] = $complit->order['total_item'];
            $row['price']      = '<input type="number" class="form-control input-sm price" data-id="' . $complit->id . '" value="' . $complit->price . '">';
            $row['pay']     = '<div class="d-flex">
                                    <a href="' . route('pembayaran-cash.show', $complit->id) . '" class="btn btn-primary shadow btn-xs sharp me-1">
                                        <i class="fas fa-money-bill"></i>
                                    </a>
                                  </div>';
            $row['delete']     = '<div class="d-flex">
                                    <a onclick="deleteData(`' . route('pesanan-selesai.destroy', $complit->id) . '`)" class="btn btn-danger shadow btn-xs sharp">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                  </div>';
            $data[] = $row;
        }        

        $dataOrderCompleted = datatables()
            ->of($data)
            ->addIndexColumn()
            ->rawColumns(['action', 'name', 'price', 'pay', 'delete'])
            ->make(true);

        return $dataOrderCompleted;
    }

    public function show($id)
    {
        $complit = Completed_order::find($id);
        return response()->json($complit);
    }

    public function update(Request $request, $id)
    {
        $complit = Completed_order::find($id);
        //validasi
        // $this->validate($request, [
        //     'name' => 'required|unique:categories'
        // ], [
        //     'name.required' => 'Kategori wajib diisi',
        //     'name.unique' => 'Kategori yang dimasukkan sudah ada',
        // ]);

        $complit->update($request->all());
        return response()->json([
            'status' => 'success',
        ]);
    }

    public function destroy($id)
    {
        try {
            $complit = Completed_order::find($id);
            $complit->delete();
            return response()->json(['status' => 'success']);
        } catch (\Throwable $th) {
            return response()->json(['status' => 'error', 'message' => $th->getMessage()], 500);
        }
    }
}
