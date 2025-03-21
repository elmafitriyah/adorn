<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\PurchaseDetail;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    public function index()
    {
        $purchases = Purchase::all();
        $suppliers = Supplier::all(); 
        $products = Product::all(); 
        return view('purchases.index', compact('purchases', 'suppliers', 'products'));
    }

    public function create()
    {
        $products = Product::all();
        $suppliers = Supplier::all();
        return view('purchases.create' , compact('suppliers', 'products'));
    }

    public function store(Request $request)
    {
        DB::transaction(function () use ($request) {
            $idSupplier = $request->suppliers[0]['id_supplier'];

            $purchase = Purchase::create([
                'purchase_date' => $request->purchase_date,
                'id_supplier' => $idSupplier,
                'total_price' => array_sum(array_column($request->products, 'total_price')), // Hitung total harga
            ]);

            foreach ($request->products as $productData) {
                $product = Product::find($productData['id_product']);

                PurchaseDetail::create([
                    'id_purchase' => $purchase->id_purchase,
                    'id_product' => $product->id_product,
                    'quantity' => $productData['quantity'],
                    'unit_price' => $productData['total_price'] / $productData['quantity'],
                ]);

                $product->stock += $productData['quantity'];
                $product->save();
            }
        });

        return redirect()->route('purchases.index');
    }
        // $request->validate([
        //     'id_supplier' => ['required'],
        //     'id_product' => ['required'],
        //     'purchase_date' => ['required'],
        //     'total_price' => ['required'],
        // ]);

        // $purchase = new Purchase();
        // $purchase->id_supplier = $request->input('id_supplier');
        // $purchase->id_product = $request->input('id_product');
        // $purchase->purchase_date = $request->input('purchase_date');
        // $purchase->total_price = $request->input('total_price');

    public function edit($id)
    {
        $purchase = Purchase::find($id); 
        if (!$purchase) {
            return redirect()->route('purchases.index')->with('error', 'Purchase not found');
        }

        $suppliers = Supplier::all();
        $products = Product::all();

        return view('purchases.edit', compact('purchase', 'suppliers', 'products'));
    }


    public function update(Request $request, $id_purchase)
    {
        $purchase =  Purchase::find($id_purchase);

        $purchase->purchase_date = $request->input('purchase_date');
        $purchase->total_price = $request->input('total_price');

        $purchase->save();
        return redirect()->route('purchases.index');
    }

    public function destroy($id)
    {
        $purchase = Purchase::find($id);
        $purchase->delete();

        return redirect()->route('purchases.index');
    }
}
