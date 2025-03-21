<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $category = Category::all();
        return response()->json([
            'status' => true,
            'message' => 'Data Category',
            'data' => $category
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
        'category' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'validasi error',
                'errors' => $validator->errors()
            ], 422);
        }

        $category = Category::create($request->all());
        return response()->json([
            'status' => true,
            'message' => 'validasi berhasil',
            'data' => $category
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = Category::findOrFail($id);
        return response()->json([
            'status' => 'true',
            'message' => 'Data Founded',
            'data' => $category
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'category' => 'required'
            ]);
    
            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'validasi error',
                    'errors' => $validator->errors()
                ], 422);
            }
            
        $category = Category::findOrFail($id);
        $category->update($request->all());
        return response()->json([
            'status' => true,
            'message' => 'updated data',
            'data' => $category
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return response()->json([
            'status'=>true,
            'message'=>'data deleted'
        ], 204);
    }
}
