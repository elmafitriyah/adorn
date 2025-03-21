@extends('templates.default')

@push('page-action')
    <a href="{{ route('purchase_details.create') }}" class="btn btn-primary">
        New Data
    </a>
@endpush

@section('content')
<div class="card">
    <div class="table-responsive">
      <table class="table table-vcenter card-table">
        <thead>
          <tr>
            <th>Purchase</th>
            <th>Product</th>
            <th>Quantity</th>
            <th>Unit Price</th>
            <th>Action</th>
            <th class="w-1"></th>
          </tr>
        </thead>
        <tbody>
          @foreach ($purchase_details as $purchase_detail)
          <tr>
            <td>{{ $purchase_detail->purchase->purchase_date}}</td>
            <td>{{ $purchase_detail->product->product}}</td>
            <td>{{ $purchase_detail->quantity}}</td>
            <td>{{ $purchase_detail->unit_price}}</td>
            <td>
              <a href="{{ route('purchase_details.edit', $purchase_detail->id_purchase_detail) }}" class="btn btn-primary btn-sm" style="display: inline-block;">Edit</a>
              <form action="{{ route('purchases.destroy', $purchase_detail->id_purchase_detail) }}" method="POST" style="display: inline-block;">
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