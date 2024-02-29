<?php

namespace App\Http\Controllers;

use App\Models\Icon;
use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $icon = Icon::all();
        return view('admin.menu.index', compact('icon'));
    }

    public function data()
    {
        // dd('coba');
        $menu = Menu::join('icons', 'icons.id', '=', 'menus.icon_id')
        ->select('icons.*', 'menus.*')
        ->get();
        $dataMenu = datatables()
            ->of($menu)
            ->addIndexColumn()
            ->addColumn('action', function ($menu) {
                return '
                <div class="d-flex">
                <a onclick="editForm(`' . route('menu.update', $menu->id) . '`)" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fas fa-pencil-alt"></i></a>
                <a onclick="deleteData(`' . route('menu.destroy', $menu->id) . '`)" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a>
                </div>
                ';
            })
            ->make(true);
        return $dataMenu;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validasi
        // $this->validate($request, [
        //     'name' => 'required|unique:icons'
        // ], [
        //     'name.required' => 'Nama icon wajib diisi',
        //     'name.unique' => 'Nama icon yang dimasukkan sudah ada',
        // ]);

        Menu::create($request->all());
        return response()->json([
            'status' => 'success',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $menu = Menu::find($id);
        return response()->json($menu);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $menu = Menu::find($id);
        //validasi
        // $this->validate($request, [
        //     'name' => 'required|unique:icons'
        // ], [
        //     'name.required' => 'Nama menu wajib diisi',
        //     'name.unique' => 'Nama menu yang dimasukkan sudah ada',
        // ]);
    
        $menu->update($request->all());
        return response()->json([
            'status' => 'success',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $menu = Menu::find($id);
            $menu->delete();
            return response()->json(['status' => 'success']);
        } catch (\Throwable $th) {
            return response()->json(['status' => 'error', 'message' => $th->getMessage()], 500);
            
        }
    }
}
