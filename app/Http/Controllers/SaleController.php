<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Sale;
use App\Models\Sale_detail;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    public function index()
    {
        return view('admin.sales-list.index');
    }

    public function data()
    {
        // dd('coba');
        $sales = Sale::orderBy('id', 'desc')->get();
        $dataSales = datatables()
            ->of($sales)
            ->addIndexColumn()
            ->addColumn('date', function ($sales) {
                return indonesian_date($sales->created_at, false);
            })
            ->addColumn('total_price', function ($sales) {
                return format_of_money($sales->total_price);
            })
            ->addColumn('pay', function ($sales) {
                return format_of_money($sales->pay);
            })
            ->addColumn('user', function ($sales) {
                return $sales->user->name ?? '';
            })
            ->addColumn('action', function ($sales) {
                return '
                <div class="d-flex">
                <a onclick="showDetail(`' . route('daftar-penjualan.show', $sales->id) . '`)" class="btn btn-secondary shadow btn-xs sharp me-1"><i class="fas fa-eye"></i></a>
                <a onclick="deleteData(`' . route('daftar-penjualan.destroy', $sales->id) . '`)" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a>
                </div>
                ';
            })
            ->make(true);
        return $dataSales;
    }

    public function create()
    {
        $sale = new Sale();
        $sale->total_item = 0;
        $sale->total_price = 0;
        $sale->pay = 0;
        $sale->accepted = 0;
        $sale->user_id = auth()->id();
        $sale->save();

        session()->put(['sale_id' => $sale->id]);
        return redirect()->route('transaksi-penjualan.index');
    }

    public function store(Request $request)
    {
        $sales = Sale::findOrFail($request->sale_id);
        $sales->total_item = $request->total_item;
        $sales->total_price = $request->total;
        $sales->pay = $request->total;
        $sales->accepted = $request->accepted;
        $sales->update();

        $detail = Sale_detail::where('sale_id', $sales->id)->get();
        foreach ($detail as $item) {
            $product = Product::find($item->product_id);
            $product->stock -= $item->amount;
            $product->update();
        }

        return redirect()->route('transaksi-penjualan.index');
    }

    public function show($id)
    {
        $detail = Sale_detail::with('product')->where('sale_id', $id)->get();
        $dataDetail = datatables()
            ->of($detail)
            ->addIndexColumn()
            ->addColumn('name', function ($detail) {
                return $detail->product->name;
            })
            ->addColumn('amount', function ($detail) {
                return $detail->amount;
            })
            ->addColumn('discount', function ($detail) {
                return $detail->discount . '%';
            })
            ->addColumn('selling_price', function ($detail) {
                return format_of_money($detail->selling_price);
            })
            ->addColumn('subtotal', function ($detail) {
                return format_of_money($detail->subtotal);
            })
            ->rawColumns(['name'])
            ->make(true);
        return $dataDetail;
    }

    public function destroy($id)
    {
        try {
            $sales = Sale::find($id);
            $details = Sale_detail::where('sale_id', $id)->get();
            foreach ($details as $item) {
                $product = Product::find($item->product_id);
                $product->stock += $item->amount;
                $product->update();
            }
            $sales->delete();

            return response()->json(['status' => 'success']);
        } catch (\Throwable $th) {
            return response()->json(['status' => 'error', 'message' => $th->getMessage()], 500);
        }
    }

    public function nota()
    {
        $sales = Sale::find(session('sale_id'));
        if (!$sales) {
            abort(404);
        }
        $detail = Sale_detail::with('product')
            ->where('sale_id', session('sale_id'))
            ->get();

        return view('admin.sales-transaction.nota', compact('sales', 'detail'));
    }
}
