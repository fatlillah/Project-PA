<?php

namespace App\Http\Controllers;

use App\Models\Icon;
use Illuminate\Http\Request;

class IconController extends Controller
{
    public function index()
    {
        return view('admin.icon.index');
    }
    public function data()
    {
        $icon = Icon::orderBy('id', 'desc')->get();
        $dataIcon = datatables()
            ->of($icon)
            ->addIndexColumn()
            ->addColumn('action', function ($icon) {
                return '
                <div class="d-flex">
                <a onclick="editForm(`' . route('icon.update', $icon->id) . '`)" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fas fa-pencil-alt"></i></a>
                <a onclick="deleteData(`' . route('icon.destroy', $icon->id) . '`)" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a>
                </div>
                ';
            })
            ->make(true);
        return $dataIcon;
        // dd($dataIcon);
    }

    public function store(Request $request)
    {
        //validasi
        $this->validate($request, [
            'name' => 'required|unique:icons'
        ], [
            'name.required' => 'Nama icon wajib diisi',
            'name.unique' => 'Nama icon yang dimasukkan sudah ada',
        ]);

        Icon::create([
            'name' => $request->name,
        ]);
        return response()->json([
            'status' => 'success',
        ]);
    }
    
    public function show($id)
    {
        $icon = Icon::find($id);
        return response()->json($icon);
    }

    public function update(Request $request, $id)
    {
        $icon = Icon::find($id);
        //validasi
        $this->validate($request, [
            'name' => 'required|unique:icons'
        ], [
            'name.required' => 'Nama icon wajib diisi',
            'name.unique' => 'Nama icon yang dimasukkan sudah ada',
        ]);
    
        $input = [
            'name' => $request->name,
        ];
        $icon->update($input);
        return response()->json([
            'status' => 'success',
        ]);
    }
    public function destroy($id)
    {
        try {
            $icon = Icon::find($id);
            $icon->delete();
            return response()->json(['status' => 'success']);
        } catch (\Throwable $th) {
            return response()->json(['status' => 'error', 'message' => $th->getMessage()], 500);
            
        }
    }
}
