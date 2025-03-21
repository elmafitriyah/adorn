<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\PurchaseDetail;
use App\Models\Purchase;
use App\Models\Product;

class PurchaseDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $purchase_detail = PurchaseDetail::all();
        return response()->json([
            'status' => true,
            'message' => 'Data Purchase',
            'data' => $purchase_detail
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_purchase' => 'required',
            'id_product' => 'required',
            'quantity' => 'required',
            'unit_price' => 'required'
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'validasi error',
                'errors' => $validator->errors()
            ], 422);
        }
    
        $purchase_detail = PurchaseDetail::create($request->all());
        return response()->json([
            'status' => true,
            'message' => 'validasi berhasil',
            'data' => $purchase_detail
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $purchase_detail = PurchaseDetail::findOrFail($id);
        return response()->json([
            'status' => 'true',
            'message' => 'Data Founded',
            'data' => $purchase_detail
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'id_purchase' => 'required',
            'id_product' => 'required',
            'quantity' => 'required',
            'unit_price' => 'required'
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'validasi error',
                'errors' => $validator->errors()
            ], 422);
        }
    
        $purchase_detail = PurchaseDetail::findOrFail($id);
        $purchase_detail->update($request->all());
        return response()->json([
            'status' => true,
            'message' => 'validasi berhasil',
            'data' => $purchase_detail
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $purchase_detail = PurchaseDetail::findOrFail($id);
        $purchase_detail->delete();
        return response()->json([
            'status'=>true,
            'message'=>'data deleted'
        ], 204);
    }
}
