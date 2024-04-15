<?php

namespace App\Http\Controllers;

use App\Models\Production_cost;
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
        $users = User::orderBy('name')->get();
        return view('admin.production-cost.index', compact('users'));
    }

    public function data()
    {
        // dd('coba');
        $theme = Production_theme::orderBy('id', 'desc')->get();
        $dataTheme = datatables()
            ->of($theme)
            ->addIndexColumn()
            ->addColumn('selectThemes', function ($theme) {
                return '
                <td width="25%">
                <button type="button" class="btn btn-primary light px-3" onclick="selectThemes(`' . route('produksi.create', $theme->themes_id) . '`)"><i class="fa fa-check-circle"></i> Pilih</button>
                </td>
                ';
            })
            ->rawColumns(['selectThemes'])
            ->make(true);
        return $dataTheme;
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

        session()->put('id', $production->id);
        session()->put('prod_themes_id', $production->themes_id);

        return view('admin.production-cost-detail.index');
    }
}