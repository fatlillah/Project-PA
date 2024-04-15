<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.category.index');
    }
    public function data()
    {
        // dd('coba');
        $category = Category::orderBy('id', 'desc')->get();
        $dataCategory = datatables()
            ->of($category)
            ->addIndexColumn()
            ->addColumn('action', function ($category) {
                return '
                <div class="d-flex">
                <a onclick="editForm(`' . route('kategori.update', $category->id) . '`)" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fas fa-pencil-alt"></i></a>
                <a onclick="deleteData(`' . route('kategori.destroy', $category->id) . '`)" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a>
                </div>
                ';
            })
            ->make(true);
        return $dataCategory;
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
        $this->validate($request, [
            'name' => 'required|unique:categories'
        ], [
            'name.required' => 'Kategori wajib diisi',
            'name.unique' => 'Kategori yang dimasukkan sudah ada',
        ]);

        // $aliasname = 'als_' . $request->name;
        // $harga_jual = $request->harga_bersih + 100000 ;
        Category::create([
            'name' => $request->name,
            // 'alias_name' => $aliasname
        ]);
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
        $category = Category::find($id);
        return response()->json($category);
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
        $category = Category::find($id);
        //validasi
        $this->validate($request, [
            'name' => 'required|unique:categories'
        ], [
            'name.required' => 'Kategori wajib diisi',
            'name.unique' => 'Kategori yang dimasukkan sudah ada',
        ]);
    
        $input = [
            'name' => $request->name,
        ];
        $category->update($input);
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
            $category = Category::find($id);
            $category->delete();
            return response()->json(['status' => 'success']);
        } catch (\Throwable $th) {
            return response()->json(['status' => 'error', 'message' => $th->getMessage()], 500);
            
        }
    }
}
