<?php

namespace App\Http\Controllers;

use App\Models\Expenditure;
use Illuminate\Http\Request;

class ExpenditureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.expenditure.index');
    }
    public function data()
    {
        // dd('coba');
        $expenses = Expenditure::orderBy('id', 'desc')->get();
        $dataExpenses = datatables()
            ->of($expenses)
            ->addIndexColumn()
            ->addColumn('created_at', function($expenses){
                return indonesian_date($expenses->created_at, false);
            })
            ->addColumn('nominal', function($expenses){
                return format_of_money($expenses->nominal);
            })
            ->addColumn('action', function ($expenses) {
                return '
                <div class="d-flex">
                <a onclick="editForm(`' . route('pengeluaran.update', $expenses->id) . '`)" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fas fa-pencil-alt"></i></a>
                <a onclick="deleteData(`' . route('pengeluaran.destroy', $expenses->id) . '`)" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a>
                </div>
                ';
            })
            ->make(true);
        return $dataExpenses;
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
        //     'name' => 'required|unique:categories'
        // ], [
        //     'name.required' => 'Kategori wajib diisi',
        //     'name.unique' => 'Kategori yang dimasukkan sudah ada',
        // ]);

        Expenditure::create($request->all());
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
        $expenses = Expenditure::find($id);
        return response()->json($expenses);
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
        $expenses = Expenditure::find($id);
        //validasi
        // $this->validate($request, [
        //     'name' => 'required|unique:categories'
        // ], [
        //     'name.required' => 'Kategori wajib diisi',
        //     'name.unique' => 'Kategori yang dimasukkan sudah ada',
        // ]);
    
        $expenses->update($request->all());
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
            $expenses = Expenditure::find($id);
            $expenses->delete();
            return response()->json(['status' => 'success']);
        } catch (\Throwable $th) {
            return response()->json(['status' => 'error', 'message' => $th->getMessage()], 500);
            
        }
    }
}
