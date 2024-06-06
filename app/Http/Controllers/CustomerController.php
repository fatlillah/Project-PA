<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        return view('admin.customer.index');
    }
    public function data()
    {
        // dd('coba');
        $customer = Customer::orderBy('id', 'desc')->get();
        $dataCustomer = datatables()
            ->of($customer)
            ->addIndexColumn()
            ->addColumn('action', function ($customer) {
                return '
                <div class="d-flex">
                <a onclick="editCustomer(`' . route('pelanggan.update', $customer->id) . '`)" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fas fa-pencil-alt"></i></a>
                <a onclick="deleteCustomer(`' . route('pelanggan.destroy', $customer->id) . '`)" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a>
                </div>
                ';
            })
            ->make(true);
        return $dataCustomer;
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

        Customer::create($request->all());
        return response()->json([
            'status' => 'success',
        ]);
    }

    public function show($id)
    {
        $customer = Customer::find($id);
        return response()->json($customer);
    }

    public function update(Request $request, $id)
    {
        $customer = Customer::find($id);
        //validasi
        // $this->validate($request, [
        //     'name' => 'required|unique:categories'
        // ], [
        //     'name.required' => 'Kategori wajib diisi',
        //     'name.unique' => 'Kategori yang dimasukkan sudah ada',
        // ]);

        $customer->update($request->all());
        return response()->json([
            'status' => 'success',
        ]);
    }

    public function destroy($id)
    {
        try {
            $customer = Customer::find($id);
            $customer->delete();
            return response()->json(['status' => 'success']);
        } catch (\Throwable $th) {
            return response()->json(['status' => 'error', 'message' => $th->getMessage()], 500);
            
        }
    }
}
