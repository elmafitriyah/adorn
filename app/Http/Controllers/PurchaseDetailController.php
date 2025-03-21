<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Purchase;
use App\Models\PurchaseDetail;
use Illuminate\Http\Request;

class PurchaseDetailController extends Controller
{
    public function index()
    {
        $purchase_details = PurchaseDetail::with(['purchase', 'product'])->get();

        $purchase_details->each(function ($detail) {
        $detail->total_price = $detail->product->price * $detail->quantity;
        });
        return view('purchase_details.index', compact('purchase_details'));
    }

    public function create() 
    {
        $produts = Product::all();
        $purchases = Purchase::all();
        return view('purchase_details.create', compact('products', 'purchases'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_purchase' => ['required'],
            'products.*.id_product' => 'required|exists:products,id_product',
            'quantity' => ['required'],
            'unit_price' => ['required'],
        ]);

        PurchaseDetail::create([
            'id_purchase' => $request->id_purchase,
            'id_product' => $request->id_product,
            'quantity' => $request->quantity,
            'unit_price' => $request->unit_price,
        ]);
        // $purchase_detail = new Purchase();
        // $purchase_detail->id_purchase = $request->input('id_purchase');
        // $purchase_detail->id_product = $request->input('id_product');
        // $purchase_detail->quantity = $request->input('quantity');
        // $purchase_detail->unit_price = $request->input('unit_price');

        // $purchase_detail->save();

        return redirect()->route('purchase_details.index');
    }

    public function edit($id)
    {
        $purchase_detail = Purchase::find($id); 
        if (!$purchase_detail) {
            return redirect()->route('purchase_details.index')->with('error', 'Purchase not found');
        }

        $purchases = Purchase::all();
        $products = Product::all();

        return view('purchase_details.edit', compact('purchase_detail', 'purchases', 'products'));
    }

    public function update(Request $request, $id_purchase_detail)
    {
        $purchase_detail =  PurchaseDetail::find($id_purchase_detail);

        $purchase_detail->id_purchase = $request->input('id_purchase');
        $purchase_detail->id_product = $request->input('id_product');
        $purchase_detail->quantity = $request->input('quantity');
        $purchase_detail->unit_price = $request->input('unit_price');

        $purchase_detail->save();
        return redirect()->route('purchase_details.index');
    }

    public function destroy($id)
    {
        $purchase_detail = PurchaseDetail::find($id);
        $purchase_detail->delete();

        return redirect()->route('purchase_details.index');
    }
}
