<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Production_cost_detail;
use App\Models\Production_theme;
use App\Models\User;
use Illuminate\Http\Request;

class ProductionCostDetailController extends Controller
{
    public function index()
    {
        $production_id = session('production_id');
        $product = Product::orderBy('name', 'desc')->get();
        $user = User::find(session('user_id'));
        $prod_themes = Production_theme::find(session('prod_themes_id'));
        if (! $prod_themes) {
            return response()->json('Data gagal disimpan', 500);
        }
        return view('admin.production-cost-detail.index', compact('production_id', 'product', 'user', 'prod_themes'));
    }

    public function data($id)
    {
        $detail = Production_cost_detail::with('product')
            ->where('production_id', $id)
            ->get();
        $data = array();
        $grand_total = 0;
        $total_item = 0;

        foreach($detail as $item){
            $row = array();
            $row['name']            = $item->product['name'];
            $row['stock']           = '<input type="number" class="form-control input-sm quantity" data-id="'. $item->id .'" value="' . $item->stock . '">';
            $row['net_price']       = '<input type="number" class="form-control input-sm net" data-id="'. $item->id .'" value="' . $item->net_price . '">';
            $row['selling_price']   = '<input type="number" class="form-control input-sm selling" data-id="'. $item->id .'" value="' . $item->selling_price . '">';
            $row['subtotal']        = format_of_money($item->subtotal);
            $row['action']          = '<div class="d-flex">
                                        <a onclick="deleteData(`' . route('produksi-detail.destroy', $item->id) . '`)" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a>
                                        </div>';
            $data[] = $row;

            $grand_total += $item->net_price * $item->stock;
            $total_item += $item->stock;
        }
        $data[] = [
            'name' => '<div class="grand_total hide">'. $grand_total .'</div>
                         <div class="total_item hide">'. $total_item .'</div>',
            'stock' => '',
            'net_price' => '',
            'selling_price' => '',
            'subtotal' => '',
            'action' => ''
        ];
        // dd($detail);
        $dataProduction = datatables()
            ->of($data)
            ->addIndexColumn()
            ->rawColumns(['action', 'name', 'stock', 'net_price', 'selling_price'])
            ->make(true);
        // echo '<pre>';
        return $dataProduction;
        // print_r($dataProduction);
        // echo '</pre>';
    }

    public function store(Request $request)
    {
        $product = Product::where('id', $request->product_id)->first();
        if (! $product) {
            return response()->json('Data gagal disimpan', 500);
        }

        $detail = new Production_cost_detail();
        $detail->production_id = $request->production_id;
        $detail->product_id = $product->id;
        $detail->stock = 0;
        $detail->net_price = $product->net_price;
        $detail->selling_price = $product->selling_price;
        $detail->subtotal = $product->net_price * $product->stock;
        $detail->save();

        return response()->json('Data berhasil disimpan', 200);
    }

    public function update(Request $request, $id)
    {
        $detail = Production_cost_detail::find($id);
        $detail->stock = $request->stock;
        $detail->net_price = $request->net_price;
        $detail->selling_price = $request->selling_price;
        $detail->subtotal = $request->net_price * $request->stock;
        $detail->update();

        return response()->json('Data berhasil diupdate', 200);
    }

    public function destroy($id)
    {
        try {
            $detail = Production_cost_detail::find($id);
            $detail->delete();
            return response()->json(['status' => 'success']);
        } catch (\Throwable $th) {
            return response()->json(['status' => 'error', 'message' => $th->getMessage()], 500);
        }
    }

    public function loadForm($grand_total)
    {
        $data = [
            'grand_totalRp' => format_of_money($grand_total)
        ];
        return response()->json($data);
    }
}
