@extends('templates.default')

@push('page-action')
    <a href="{{ route('suppliers.create') }}" class="btn btn-primary">
        New Data
    </a>
@endpush

@section('content')
<div class="card">
    <div class="table-responsive">
      <table class="table table-vcenter card-table">
        <thead>
          <tr>
            <th>Supplier</th>
            <th>Supplier Address</th>
            <th>Phone Number</th>
            <th>Action</th>
            <th class="w-1"></th>
          </tr>
        </thead>
        <tbody>
          @foreach ($suppliers as $supplier)
          <tr>
            <td>{{ $supplier->supplier}}</td>
            <td>{{ $supplier->supplier_address }}</td>
            <td>{{ $supplier->phone_number }}</td>
            <td>
              <a href="{{ route('suppliers.edit', $supplier->id_supplier) }}" class="btn btn-primary btn-sm" style="display: inline-block;">Edit</a>
              <form action="{{ route('suppliers.destroy', $supplier->id_supplier) }}" method="POST" style="display: inline-block;">
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