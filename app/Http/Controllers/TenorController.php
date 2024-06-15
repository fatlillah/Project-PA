<?php

namespace App\Http\Controllers;

use App\Models\Tenor;
use Illuminate\Http\Request;

class TenorController extends Controller
{
    public function index()
    {
        return view('admin.credit.tenor.index');
    }
    public function data()
    {
        $tenor = Tenor::orderBy('id', 'desc')->get();
        $dataTenor = datatables()
            ->of($tenor)
            ->addIndexColumn()
            ->addColumn('jum_tenor', function ($tenor) {
                return $tenor->jum_tenor . ' Bulan';
            })
            ->addColumn('action', function ($tenor) {
                return '
                <div class="d-flex">
                <a onclick="editTenor(`' . route('tenor.update', $tenor->id) . '`)" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fas fa-pencil-alt"></i></a>
                <a onclick="deleteTenor(`' . route('tenor.destroy', $tenor->id) . '`)" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a>
                </div>
                ';
            })
            ->make(true);
        return $dataTenor;
    }

    public function store(Request $request)
    {
        //validasi
        // $this->validate($request, [
        //     'name' => 'required|unique:categories'
        // ], [
        //     'name.required' => 'Kategori wajib diisi',
        //     'name.unique' => 'Kategori yang dimasukkan sudah ada',
        // ]);

        Tenor::create($request->all());
        return response()->json([
            'status' => 'success',
        ]);
    }

    public function show($id)
    {
        $tenor = Tenor::find($id);
        return response()->json($tenor);
    }

    public function update(Request $request, $id)
    {
        $tenor = Tenor::find($id);
        //validasi
        // $this->validate($request, [
        //     'name' => 'required|unique:categories'
        // ], [
        //     'name.required' => 'Kategori wajib diisi',
        //     'name.unique' => 'Kategori yang dimasukkan sudah ada',
        // ]);

        $tenor->update($request->all());
        return response()->json([
            'status' => 'success',
        ]);
    }

    public function destroy($id)
    {
        try {
            $tenor = Tenor::find($id);
            $tenor->delete();
            return response()->json(['status' => 'success']);
        } catch (\Throwable $th) {
            return response()->json(['status' => 'error', 'message' => $th->getMessage()], 500);
            
        }
    }
}
