<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Sale;
use App\Models\Sale_detail;
use Illuminate\Http\Request;

class SaleDetailController extends Controller
{
    public function index()
    {
        $product = Product::orderBy('name', 'desc')->get();
        if ($sale_id = session('sale_id')) {
            $sales = Sale::find($sale_id);
            return view('admin.sales-transaction.index', compact('product', 'sale_id', 'sales'));
        }
    }

    public function data($id)
    {
        $sales = Sale_detail::with('product')
            ->where('sale_id', $id)
            ->get();
        $data = array();
        $total = 0;
        $total_item = 0;

        foreach ($sales as $item) {
            $row = array();
            $row['name']            = $item->product['name'];
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
            $total_item += $item->amount;
        }
        $data[] = [
            'name' => '<div class="total hide">' . $total . '</div>
                         <div class="total_item hide">' . $total_item . '</div>',
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

    public function store(Request $request)
    {
        $product = Product::where('id', $request->product_id)->first();
        if (!$product) {
            return response()->json('Data gagal disimpan', 500);
        }

        $sales = new Sale_detail();
        $sales->sale_id = $request->sale_id;
        $sales->product_id = $product->id;
        $sales->selling_price = floatval($product->selling_price);
        $sales->amount = 1;
        $sales->discount = floatval($request->discount);
        $sales->subtotal = $sales->selling_price - ($sales->discount / 100 * $sales->selling_price);
        $sales->save();

        return response()->json('Data berhasil disimpan', 200);
    }

    public function update(Request $request, $id)
    {
        $sales = Sale_detail::find($id);
        $sales->amount = $request->amount;
        $sales->discount = $request->discount;
        $sales->subtotal = $sales->selling_price * $request->amount - (($request->discount * $request->amount) / 100 * $sales->selling_price);
        $sales->update();
    }

    public function destroy($id)
    {
        try {
            $sales = Sale_detail::find($id);
            $sales->delete();
            return response()->json(['status' => 'success']);
        } catch (\Throwable $th) {
            return response()->json(['status' => 'error', 'message' => $th->getMessage()], 500);
        }
    }

    public function loadForm($total = 0, $accepted = 0)
    {
        $pay   = $total;
        $accepted = floatval($accepted);
        $pay = floatval($pay);
        $money_changes = ($accepted != 0) ? $accepted - $pay : 0;
        $data    = [
            'totalRp' => format_of_money($total),
            'pay' => $pay,
            'payRp' => format_of_money($pay),
            'money_changesRp' => format_of_money($money_changes)
        ];

        return response()->json($data);
    }
}
