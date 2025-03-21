<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;

class SupplierController extends Controller
{
    public function index()
    {
        $suppliers = Supplier::all();
        return view('suppliers.index', compact('suppliers'));
    }

    public function create()
    {
        return view('suppliers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'supplier' => ['required'],
            'supplier_address' => ['required'],
            'phone_number' => ['required']
        ]);

        $supplier = new Supplier();
        $supplier->supplier = $request->input('supplier');
        $supplier->supplier_address = $request->input('supplier_address');
        $supplier->phone_number = $request->input('phone_number');

        $supplier->save();

        return redirect()->route('suppliers.index');
    }

    public function edit($id)
    {
        $supplier = Supplier::find($id);
        return view('suppliers.edit', [
            'supplier' => $supplier
        ]);
    }

    public function update(Request $request, $id_supplier)
    {
        $supplier = Supplier::find($id_supplier);
        $supplier->supplier = $request->input('supplier');
        $supplier->supplier_address = $request->input('supplier_address');
        $supplier->phone_number = $request->input('phone_number');
        $supplier->save();

        return redirect()->route('suppliers.index');
    }

    public function destroy($id)
    {
        $supplier = Supplier::find($id);
        $supplier->delete();

        return redirect()->route('suppliers.index');
    }
}
