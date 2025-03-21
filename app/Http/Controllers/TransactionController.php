<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\TransactionDetail;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::all();
        $products = Product::all();
        return view('transactions.index', compact('transactions', 'products'));
    }

    public function create()
    {
        return view('transactions.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'transaction_date' => 'required|date',
            'products.*.id_product' => 'required|exists:products,id_product',
            'products.*.quantity' => 'required|integer|min:1',
            'total_price' => 'required|numeric',
        ]);

        try {
            DB::beginTransaction();

            $transaction = Transaction::create([
                'transaction_date' => $request->transaction_date,
                'total_price' => $request->total_price,
            ]);

            foreach ($request->products as $productData) {
                $product = Product::find($productData['id_product']);

                if ($product->stock < $productData['quantity']) {
                    throw new \Exception('Stok tidak mencukupi untuk produk: ' . $product->product);
                }

                $detailPrice = $product->price * $productData['quantity'];

                TransactionDetail::create([
                    'id_transaction' => $transaction->id_transaction,
                    'id_product' => $productData['id_product'],
                    'quantity' => $productData['quantity'],
                    'total_price' => $detailPrice,
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
        
        return redirect()->route('transactions.index');
    }

    public function edit($id)
    {
        $transaction = Transaction::find($id);

        return view('transactions.edit', [
            'transaction' => $transaction,
        ]);
    }

    public function update(Request $request, $id_transaction)
    {
        $request->validate([
            'transaction_date' => 'required|date',
            'total_price' => 'required|numeric',
        ]);

        $transaction = Transaction::find($id_transaction);
        $transaction->update([
            'transaction_date' => $request->transaction_date,
            'total_price' => $request->total_price,
        ]);

        $transaction->save();

        return redirect()->route('transactions.index');
    }

    public function destroy($id)
    {
        $transaction = Transaction::find($id);
        $transaction->delete();

        return redirect()->route('transactions.destroy');
    }
}
