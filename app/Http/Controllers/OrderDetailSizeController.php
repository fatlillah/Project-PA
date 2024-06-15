<?php
namespace App\Http\Controllers;

use App\Models\Order_detail;
use App\Models\Order_detail_size;
use Illuminate\Http\Request;

class OrderDetailSizeController extends Controller
{
    public function store(Request $request)
    {
        $orderDetailSize = new Order_detail_size();
        $orderDetailSize->customer = $request->customer;
        $orderDetailSize->name_product = $request->name_product;
        $orderDetailSize->body = $request->body;
        $orderDetailSize->waist = $request->waist;
        $orderDetailSize->pelvis = $request->pelvis;
        $orderDetailSize->armhole = $request->armhole;
        $orderDetailSize->length_shoulder = $request->length_shoulder;
        $orderDetailSize->arm_length = $request->arm_length;
        $orderDetailSize->length_shirt = $request->length_shirt;
        $orderDetailSize->length_face = $request->length_face;
        $orderDetailSize->desc = $request->desc;
        $orderDetailSize->save();

        $orderDetail = new Order_detail();
        $order_id = session('order_id');
        if (!$order_id) {
            return response()->json('Order ID tidak ditemukan dalam sesi', 500);
        }
        $orderDetail->order_id = $order_id;
        $orderDetail->order_detail_size_id = $orderDetailSize->id;
        $orderDetail->amount = 1;
        $orderDetail->save();

        return response()->json([
            'status' => 'success',
        ]);
    }

    public function show($id)
    {
        $orderDetailSize = Order_detail_size::find($id);
        return response()->json($orderDetailSize);
    }

    public function update(Request $request, $id)
    {
        $orderDetailSize = Order_detail_size::find($id);
        if (!$orderDetailSize) {
            return response()->json('Data tidak ditemukan', 404);
        }
        $orderDetailSize->update($request->all());
        return response()->json([
            'status' => 'success',
        ]);
    }
}
