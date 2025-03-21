<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;
use Illuminate\Support\Facades\Validator;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transaction = Transaction::all();
        return response()->json([
            'status' => true,
            'message' => 'Data Transaction',
            'data' => $transaction
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'transaction_date' => 'required|date_format:Y-m-d H:i:s',
            'total_price' => 'required'
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'validasi error',
                'errors' => $validator->errors()
            ], 422);
        }
    
        $transaction = Transaction::create($request->all());
        return response()->json([
            'status' => true,
            'message' => 'validasi berhasil',
            'data' => $transaction
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $transaction = Transaction::findOrFail($id);
        return response()->json([
            'status' => 'true',
            'message' => 'Data Founded',
            'data' => $transaction
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'transaction_date' => 'required',
            'total_price' => 'required',
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'validasi error',
                'errors' => $validator->errors()
            ], 422);
        }
    
        $transaction = Transaction::findOrFail($id);
        $transaction->update($request->all());
        return response()->json([
            'status' => true,
            'message' => 'validasi berhasil',
            'data' => $transaction
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $transaction = transaction::findOrFail($id);
        $transaction->delete();
        return response()->json([
            'status'=>true,
            'message'=>'data deleted'
        ], 204);
    }
}
