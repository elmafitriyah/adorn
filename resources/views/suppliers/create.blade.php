@extends('templates.default')

@php
    $title = 'Supplier';
    $preTitle = 'Add Supplier';
@endphp

@section('content')
    <div class="mb-3">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('suppliers.store') }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Supplier</label>
                        <input type="text" name="supplier" class="form-control @error('supplier') is-invalid @enderror" placeholder="Add Supplier" value="{{ old('supplier') }}">
                        @error('supplier')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Supplier Address</label>
                        <input type="text" name="supplier_address" class="form-control @error('supplier_address') is-invalid @enderror" placeholder="Add Supplier Address" value="{{ old('supplier_address') }}">
                        @error('supplier_address')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Phone Number</label>
                        <input type="text" name="phone_number" class="form-control @error('phone_number') is-invalid @enderror" placeholder="Add Phone Number" value="{{ old('phone_number') }}">
                        @error('phone_number')
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