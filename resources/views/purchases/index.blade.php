@extends('templates.default')

@php
    $preTitle = 'Adorn';
    $title = 'Add Purchases'
@endphp

@section('content')
    <form action="{{ route('purchases.store') }}" class="p-2" method="POST">
        @csrf

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (Session::has('success'))
            <div class="alert alert-success text-center">
                <p>{{ Session::get('success') }}</p>
            </div>
        @endif

        <div class="m-3">
            <div class="m-3 bg-white p-2 rounded-3 shadow-sm">
                <div class="m-3">
                    <table class="table table-bordered" id="table">
                        <tr>
                            <th>Date</th>
                            <th>Supplier</th>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Total Price</th>
                            <th></th>
                        </tr>
                        <tr>
                            <td>
                                <input type="datetime-local" name="purchase_date" class="form-control @error('purchase_date') is-invalid @enderror" placeholder="Enter Purchase Date" value="{{ old('purchase_date') }}">
                            </td>
                            <td>
                              <select name="suppliers[0][id_supplier]" class="form-control @error('suppliers.0.id_supplier') is-invalid @enderror supplier-select">
                                  <option value="">Choose supplier</option>
                                  @foreach ($suppliers as $supplier)
                                      <option value="{{ $supplier->id_supplier }}" data-price="{{ $supplier->price }}" {{ old('suppliers.0.id_supplier') == $supplier->id_supplier ? 'selected' : '' }}>
                                          {{ $supplier->supplier }}
                                      </option>
                                  @endforeach
                              </select>
                          </td>
                            <td>
                                <select name="products[0][id_product]" class="form-control @error('products.0.id_product') is-invalid @enderror product-select">
                                    <option value="">Choose product</option>
                                    @foreach ($products as $product)
                                        <option value="{{ $product->id_product }}" data-price="{{ $product->price }}" {{ old('products.0.id_product') == $product->id_product ? 'selected' : '' }}>
                                            {{ $product->product }}
                                        </option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <input type="number" name="products[0][quantity]" class="form-control @error('products.0.quantity') is-invalid @enderror quantity-input" placeholder="Enter Quantity" value="{{ old('products.0.quantity') }}">
                            </td>
                            <td>
                              <input type="number" name="products[0][total_price]" class="form-control total-price-input" placeholder="Enter Total Price">
                            </td>
                            <td>
                                <button type="button" name="add" id="add" class="btn btn-primary">+</button>
                            </td>
                        </tr>
                    </table>
                    <div class="m-3 ">
                        <input type="submit" value="Confirm" class="btn btn-primary">
                    </div>
                </div>
            </div>
        </div>
    </form>

    <div class="card" style="margin-top: 6%">
      <div class="table-responsive">
        <table class="table table-vcenter card-table">
          <thead>
            <tr>
              <th>No</th>
              <th>Supplier</th>
              <th>Purchase Date</th>
              <th>Total Price</th>
              <th class="w-1"></th>
            </tr>
          </thead>
          <tbody>
            @foreach ($purchases as $purchase)
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ $purchase->supplier->supplier }}</td>
              <td>{{ $purchase->purchase_date }}</td>
              <td>{{ $purchase->total_price }}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>  
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            var i = 1; // Mulai dari 1

            $('#add').click(function () {
                $('#table').append(
                    `<tr>
                        <td></td>
                        <td>
                            <select name="suppliers[${i}][id_supplier]" class="form-control supplier-select">
                                <option value="">Choose supplier</option>
                                @foreach ($suppliers as $supplier)
                                    <option value="{{ $supplier->id_supplier }}">
                                        {{ $supplier->supplier }}
                                    </option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <select name="products[${i}][id_product]" class="form-control product-select">
                                <option value="">Choose product</option>
                                @foreach ($products as $product)
                                    <option value="{{ $product->id_product }}" data-price="{{ $product->price }}">
                                        {{ $product->product }}
                                    </option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <input type="number" name="products[${i}][quantity]" placeholder="Enter Quantity" class="form-control quantity-input" />
                        </td>
                        <td>
                            <input type="number" name="products[${i}][total_price]" class="form-control total-price-input" placeholder="Enter Total Price">
                        </td>
                        <td>
                            <button type="button" class="btn btn-danger remove-table-row">-</button>
                        </td>
                    </tr>`
                );
                i++;
            });

            $(document).on('click', '.remove-table-row', function () {
                $(this).closest('tr').remove();
            });
        });
    </script>
@endsection