<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Production_cost_detail;
use App\Models\User;
use Illuminate\Http\Request;

class ProductionCostDetailController extends Controller
{
    public function index()
    {
        $production_id = session('production_id');
        $product = Product::orderBy('name', 'desc')->get();
        $user = User::find(session('user_id'));
        return view('admin.production-cost-detail.index', compact('production_id', 'product', 'user'));
    }
    public function data($id)
    {
        $detail = Production_cost_detail::with('product')
            ->where('production_id', $id)
            ->get();
        // dd($detail);
        $dataProduction = datatables()
            ->of($detail)
            ->addColumn('name', function ($detail) {
                return $detail->product->name;
            })
            ->addColumn('stock', function ($detail) {
                return '<input type="number" class="form-control input-sm" name"stock_' . $detail->id . '" value="' . $detail->stock . '">';
            })
            ->addColumn('net_price', function ($detail) {
                return '<input type="text" class="form-control input-sm" name"net_price_' . $detail->id . '" value="' . format_of_money($detail->net_price) . '">';
            })
            ->addColumn('selling_price', function ($detail) {
                return '<input type="text" class="form-control input-sm" name"selling_price_' . $detail->id . '" value="' . format_of_money($detail->selling_price) . '">';
            })
            ->addColumn('subtotal', function ($detail) {
                return format_of_money($detail->subtotal);
            })
            ->addIndexColumn()
            ->addColumn('action', function ($detail) {
                return '
                <div class="d-flex">
                <a onclick="deleteData(`' . route('produksi-detail.destroy', $detail->id) . '`)" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a>
                </div>
                ';
            })
            ->rawColumns(['action', 'stock', 'net_price', 'selling_price'])
            ->make(true);
        // echo '<pre>';
        return $dataProduction;
        // print_r($dataProduction);
        // echo '</pre>';
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
}
