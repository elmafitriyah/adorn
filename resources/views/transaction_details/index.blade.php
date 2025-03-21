@extends('templates.default')

@push('page-action')
    <a href="{{ route('transaction_details.create') }}" class="btn btn-primary">
        New Data
    </a>
@endpush

@section('content')
<div class="card">
    <div class="table-responsive">
      <table class="table table-vcenter card-table">
        <thead>
          <tr>
            <th>Transaction Date</th>
            <th>Product</th>
            <th>Quantity</th>
            <th>Total Price</th>
            <th>Action</th>
            <th class="w-1"></th>
          </tr>
        </thead>
        <tbody>
          @foreach ($transaction_details as $transaction_detail)
          <tr>
            <td>{{ $transaction_detail->transaction->transaction_date}}</td>
            <td>{{ $transaction_detail->product->product}}</td>
            <td>{{ $transaction_detail->quantity}}</td>
            <td>{{ $transaction_detail->total_price }}</td>
            <td>
              <a href="{{ route('transaction_details.edit', $transaction_detail->id_transaction_detail) }}" class="btn btn-primary btn-sm" style="display: inline-block;">Edit</a>
              <form action="{{ route('transaction_details.destroy', $transaction_detail->id_transaction_detail) }}" method="POST" style="display: inline-block;">
                @csrf
                @method('DELETE')
                <input type="submit" value="Delete" class="btn btn-danger btn-sm">
              </form>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
@endsection