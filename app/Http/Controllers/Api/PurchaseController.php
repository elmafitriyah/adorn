<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Purchase;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $purchase = Purchase::all();
        return response()->json([
            'status' => true,
            'message' => 'Data Purchase',
            'data' => $purchase
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_supplier' => 'required',
            'id_product' => 'required',
            'purchase_date' => 'required',
            'total_price' => 'required'
            ]);
    
            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'validasi error',
                    'errors' => $validator->errors()
                ], 422);
            }
    
            $purchase = Purchase::create($request->all());
            return response()->json([
                'status' => true,
                'message' => 'validasi berhasil',
                'data' => $purchase
            ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $purchase = Purchase::findOrFail($id);
        return response()->json([
            'status' => 'true',
            'message' => 'Data Founded',
            'data' => $purchase
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'id_supplier' => 'required',
            'purchase_date' => 'required',
            'total_price' => 'required'
            ]);
    
            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'validasi error',
                    'errors' => $validator->errors()
                ], 422);
            }
            
        $purchase = Purchase::findOrFail($id);
        $purchase->update($request->all());
        return response()->json([
            'status' => true,
            'message' => 'updated data',
            'data' => $purchase
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $purchase = Purchase::findOrFail($id);
        $purchase->delete();
        return response()->json([
            'status'=>true,
            'message'=>'data deleted'
        ], 204);
    }
}
