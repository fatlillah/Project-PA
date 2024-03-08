<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = Category::all();
        return view('admin.product.index', compact('category'));
    }

    public function data()
    {
        // dd('coba');
        $product = Product::join('categories', 'categories.id', '=', 'products.category_id')
            ->select('categories.*', 'products.*', 'categories.name AS category_name')
            ->get();
        $dataProduct = datatables()
            ->of($product)
            ->addIndexColumn()
            ->addColumn('checkAll', function ($product) {
                return '
                <div class="form-check custom-checkbox">
                    <input type="checkbox" class="form-check-input" name="id[]" value="' . $product->id . '">
                    <label class="form-check-label"></label>
                </div>';
            })
            ->addColumn('action', function ($product) {
                return '
                <div class="d-flex">
                <a onclick="editForm(`' . route('produk.update', $product->id) . '`)" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fas fa-pencil-alt"></i></a>
                <a onclick="deleteData(`' . route('produk.destroy', $product->id) . '`)" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a>
                </div>
                ';
            })
            ->rawColumns(['action', 'checkAll'])
            ->make(true);
        return $dataProduct;
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
        Product::create($request->all());
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
        $product = Product::find($id);
        return response()->json($product);
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
        $product = Product::find($id);
        //validasi
        // $this->validate($request, [
        //     'name' => 'required|unique:categories'
        // ], [
        //     'name.required' => 'Nama product wajib diisi',
        //     'name.unique' => 'Nama product yang dimasukkan sudah ada',
        // ]);

        $product->update($request->all());
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
            $product = Product::find($id);
            $product->delete();
            return response()->json(['status' => 'success']);
        } catch (\Throwable $th) {
            return response()->json(['status' => 'error', 'message' => $th->getMessage()], 500);
        }
    }

    public function deleteSelected(Request $request)
    {
        foreach($request->id as $id){
            $product = Product::find($id);
            $product->delete();
        }
        return response(null, 204);
    }
}
