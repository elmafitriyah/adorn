@extends('templates.default')

@php
    $title = 'Purchase';
    $preTitle = 'Add Purchase';
@endphp

@section('content')
    <div class="mb-3">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('purchases.store') }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Supplier</label>
                        <select name="id_supplier" class="form-control @error('id_supplier') is-invalid @enderror">
                            <option value="">Choose Supplier</option>
                            @foreach ($suppliers as $supplier)
                                <option value="{{ $supplier->id_supplier }}" {{ old('id_supplier') == $supplier->id_supplier ? 'selected' : '' }}>
                                    {{ $supplier->supplier }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_supplier')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Product</label>
                        <select name="id_product" class="form-control @error('id_product') is-invalid @enderror">
                            <option value="">Choose product</option>
                            @foreach ($products as $product)
                                <option value="{{ $product->id_product }}" {{ old('id_product') == $product->id_product ? 'selected' : '' }}>
                                    {{ $product->product }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_product')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Purchase Date</label>
                        <input type="date" name="purchase_date" class="form-control @error('purchase_date') is-invalid @enderror" placeholder="Add purchase_date" value="{{ old('purchase_date') }}">
                        @error('purchase_date')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Total Price</label>
                        <input type="number" name="total_price" class="form-control @error('total_price') is-invalid @enderror" placeholder="Add total_price" value="{{ old('total_price') }}">
                        @error('total_price')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <input type="submit" value="Submit" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection