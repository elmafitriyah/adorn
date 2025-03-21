@extends('templates.default')

@php
    $title = 'Supplier';
    $preTitle = 'Edit Supplier';
@endphp

@section('content')
    <div class="mb-3">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('suppliers.update', $supplier->id_supplier) }}" class="" method="post">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label class="form-label">Supplier</label>
                        <input type="text" name="supplier" class="form-control" placeholder="Edit Supplier" value="{{ $supplier->supplier }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Supplier Address</label>
                        <input type="text" name="supplier_address" class="form-control" placeholder="Edit Supplier Address" value="{{ $supplier->supplier_address }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Phone Number</label>
                        <input type="text" name="phone_number" class="form-control" placeholder="Edit Phone Number" value="{{ $supplier->phone_number }}">
                    </div>
                    <div class="mb-3">
                        <input type="submit" value="Submit" class="btn btn-primary">
                    </div>
                </form>
                
            </div>
        </div>
    </div>
@endsection