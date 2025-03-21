<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TransactionDetail;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TransactionDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transaction_detail = TransactionDetail::all();
        return response()->json([
            'status' => true,
            'message' => 'Data Transaction Detail',
            'data' => $transaction_detail
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_transaction' => 'required', 
            'id_product' => 'required', 
            'quantity' => 'required|numeric'
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'validasi error',
                'errors' => $validator->errors()
            ], 422);
        }
    
    $transaction = Transaction::find($request->id_transaction);
    if (!$transaction) {
        return response()->json([
            'status' => false,
            'message' => 'Transaction not found'
        ], 404);
    }
    $product = Product::find($request->id_product);
    if (!$product) {
        return response()->json([
            'status' => false,
            'message' => 'Product not found'
        ], 404);
    }

        $transaction_detail = TransactionDetail::create($request->all());
        return response()->json([
            'status' => true,
            'message' => 'validasi berhasil',
            'data' => $transaction_detail
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $transaction_detail = TransactionDetail::findOrFail($id);
        return response()->json([
            'status' => 'true',
            'message' => 'Data Founded',
            'data' => $transaction_detail
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'id_transaction' => 'required',
            'id_product' => 'required',
            'quantity' => 'required'
            ]);
    
            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'validasi error',
                    'errors' => $validator->errors()
                ], 422);
            }
            
        $transaction_detail = TransactionDetail::findOrFail($id);
        $transaction_detail->update($request->all());
        return response()->json([
            'status' => true,
            'message' => 'updated data',
            'data' => $transaction_detail
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $transaction_detail = TransactionDetail::findOrFail($id);
        $transaction_detail->delete();
        return response()->json([
            'status'=>true,
            'message'=>'data deleted'
        ], 204);
    }
}
