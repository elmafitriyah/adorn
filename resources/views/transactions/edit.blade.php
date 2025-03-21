@extends('templates.default')

@php
    $title = 'Transaction';
    $preTitle = 'Edit Transaction';
@endphp

@section('content')
    <div class="mb-3">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('transactions.update', $transaction->id_transaction) }}" class="" method="post">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label class="form-label">Transaction Date</label>
                        <input type="datetime-local" name="transaction_date" class="form-control" placeholder="Add Transaction Date" value="{{ $transaction->transaction_date }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Total Price</label>
                        <input type="decimal" name="total_price" class="form-control" placeholder="Add Total Price" value="{{ $transaction->total_price }}">
                    </div>
                    <div class="mb-3">
                        <input type="submit" value="Submit" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection