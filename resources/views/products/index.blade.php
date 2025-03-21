@extends('templates.default')

@push('page-action')
    <a href="{{ route('products.create') }}" class="btn btn-primary">
        New Data
    </a>
@endpush

@section('content')
<div class="card">
    <div class="table-responsive">
      <table class="table table-vcenter card-table">
        <thead>
          <tr>
            <th>Product</th>
            <th>Price</th>
            <th>Stock</th>
            <th>Category</th>
            <th>Image</th>
            <th>Action</th>
            <th class="w-1"></th>
          </tr>
        </thead>
        <tbody>
          @foreach ($products as $product)
          <tr>
            <td>{{ $product->product}}</td>
            <td>{{ $product->price}}</td>
            <td>{{ $product->stock}}</td>
            <td>{{ $product->category->category}}</td>
            <td>
              @if($product->image)
                  <img src="{{ asset($product->image) }}" width="50" alt="{{ $product->product }}">
              @else
                  No Image
              @endif
            </td>                      
            <td>
              <a href="{{ route('products.edit', $product->id_product) }}" class="btn btn-primary btn-sm" style="display: inline-block;">Edit</a>
              <form action="{{ route('products.destroy', $product->id_product) }}" method="POST" style="display: inline-block;">
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