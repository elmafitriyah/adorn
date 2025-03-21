<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $supplier = Supplier::all();
        return response()->json([
            'status' => true,
            'message' => 'Data Supplier',
            'data' => $supplier
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'supplier' => 'required',
            'supplier_address' => 'required',
            'phone_number' => 'required'
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'validasi error',
                'errors' => $validator->errors()
            ], 422);
        }
    
        $supplier = Supplier::create($request->all());
        return response()->json([
            'status' => true,
            'message' => 'validasi berhasil',
            'data' => $supplier
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $supplier = Supplier::findOrFail($id);
        return response()->json([
            'status' => 'true',
            'message' => 'Data Founded',
            'data' => $supplier
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'supplier' => 'required',
            'supplier_address' => 'required',
            'phone_number' => 'required'
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'validasi error',
                'errors' => $validator->errors()
            ], 422);
        }
            
        $supplier = Supplier::findOrFail($id);
        $supplier->update($request->all());
        return response()->json([
            'status' => true,
            'message' => 'updated data',
            'data' => $supplier
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $supplier = Supplier::findOrFail($id);
        $supplier->delete();
        return response()->json([
            'status'=>true,
            'message'=>'data deleted'
        ], 204);
    }
}
