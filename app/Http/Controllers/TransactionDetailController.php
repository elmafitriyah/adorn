<?php

namespace App\Http\Controllers;

use App\Models\TransactionDetail;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class TransactionDetailController extends Controller
{
    public function index()
    {
        $transaction_details = TransactionDetail::with(['transaction', 'product'])->get();

        $transaction_details->each(function ($detail) {
        $detail->total_price = $detail->product->price * $detail->quantity;
        });

        return view('transaction_details.index', compact('transaction_details'));
    }

    public function create($id_transaction)
    {
        $products = Product::all();
        return view('transaction_details.create', compact('id_transaction', 'products'));
    }

    public function store (Request $request, $id_transaction) 
    {
        $request->validate([
            'products.*.id_product' => 'required|exists:products,id_product',
            'products.*.quantity' => 'required|integer|min:1',
        ]);

        try {
            DB::beginTransaction();

            foreach ($request->products as $productData) {
                $product = Product::find($productData['id_product']);

                if ($product->stock < $productData['quantity']) {
                    throw new \Exception('Stok tidak mencukupi untuk produk: ' . $product->product);
                }

                $transactionDetail = TransactionDetail::create([
                    'id_transaction' => $id_transaction,
                    'id_product' => $productData['id_product'],
                    'quantity' => $productData['quantity'],
                    'total_price' => $product->price * $productData['quantity'], 
                ]);

                $product->stock -= $productData['quantity'];
                $product->save();
            }

            DB::commit();
            return redirect()->route('transactions.index')->with('success', 'Transaksi berhasil disimpan.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()])->withInput();
        }
    }
   
    public function destroy($id)
    {
        $transaction_details = TransactionDetail::find($id);
        $transaction_details->delete();

        return redirect()->route('transaction_details.index');
    }
}
