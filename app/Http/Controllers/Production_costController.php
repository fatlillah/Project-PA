<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Production_cost;
use App\Models\Production_cost_detail;
use App\Models\Production_theme;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Production_costController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $themes = Production_theme::orderBy('name')->get();
        return view('admin.production-cost.index', compact('themes'));
    }

    public function data()
    {
        // dd('coba');
        $production = Production_cost::orderBy('id', 'desc')->get();
        $dataProduction = datatables()
            ->of($production)
            ->addIndexColumn()
            ->addColumn('date', function ($production) {
                return indonesian_date($production->created_at, false);
            })
            ->addColumn('production_theme', function ($production) {
                return $production->production_themes->name;
            })
            ->addColumn('user', function ($production) {
                return $production->user->name;
            })
            ->addColumn('grand_total', function ($production) {
                return format_of_money($production->grand_total);
            })
            ->addColumn('action', function ($production) {
                return '
                <div class="d-flex">
                <a onclick="showDetail(`' . route('produksi.show', $production->id) . '`)" class="btn btn-secondary shadow btn-xs sharp me-1"><i class="fas fa-eye"></i></a>
                <a onclick="deleteData(`' . route('produksi.destroy', $production->id) . '`)" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a>
                </div>
                ';
            })
            ->make(true);
        return $dataProduction;
    }

    public function create($id)
    {
        $production = new Production_cost();
        $production->themes_id = $id;

        $user = Auth::user();
        $production->user_id = $user->id;
        $production->total_item = 0;
        $production->grand_total = 0;
        $production->save();

        session()->put(['production_id' => $production->id]);
        session()->put(['prod_themes_id'=> $production->themes_id]);

        return redirect()->route('produksi-detail.index');
    }

    public function store(Request $request)
    {
        $production = Production_cost::findOrfail($request->production_id);
        $production->total_item = $request->total_item;
        $production->grand_total = $request->grand_total;
        $production->save();

        $detail = Production_cost_detail::where('production_id', $production->id)->get();
        foreach ($detail as $item) {
            $product = Product::find($item->product_id);
            $product->stock += $item->stock;
            $product->net_price += $item->net_price;
            $product->selling_price += $item->selling_price;
            $product->update();

        }
        return redirect()->route('produksi.index');
    }

    public function show($id)
    {
        $detail = Production_cost_detail::with('product')->where('production_id', $id)->get();
        $dataDetail = datatables()
            ->of($detail)
            ->addIndexColumn()
            ->addColumn('name', function ($detail) {
                return $detail->product->name;
            })
            ->addColumn('stock', function ($detail) {
                return $detail->stock;
            })
            ->addColumn('net_price', function ($detail) {
                return format_of_money($detail->net_price);
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
            $production = Production_cost::find($id);
            $production->delete();
            return response()->json(['status' => 'success']);
        } catch (\Throwable $th) {
            return response()->json(['status' => 'error', 'message' => $th->getMessage()], 500);
        }
    }
}