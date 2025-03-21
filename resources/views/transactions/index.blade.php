    @extends('templates.default')

    @php
        $preTitle = 'Adorn';
        $title = 'Add Transaction'
    @endphp

    @section('content')
        <form action="{{ route('transactions.store') }}" class="p-2" method="POST">
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

            <div class="col-12">
                <div class="m-3 bg-white p-2 rounded-3 shadow-sm">
                    <div class="m-3">
                        <table class="table table-bordered" id="table">
                            <tr>
                                <th>Date</th>
                                <th>Product</th>
                                <th>Quantity</th>
                                <th>Total Price</th>
                                <th></th>
                            </tr>
                            <tr>
                                <td>
                                    <input type="datetime-local" name="transaction_date" class="form-control @error('transaction_date') is-invalid @enderror" placeholder="Enter Transaction Date" value="{{ old('transaction_date') }}">
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
                                <td class="total-price-cell">0</td>
                                <td>
                                    <button type="button" name="add" id="add" class="btn btn-primary">+</button>
                                </td>
                            </tr>
                        </table>

                        <div class="m-3">
                            <strong>Total: <span id="grand-total">0</span></strong>
                        </div>
                        <input type="hidden" name="total_price" id="total-price-input">
                        <div class="m-3 ">
                            <input type="submit" value="Confirm" class="btn btn-primary">
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <div class="card" style="margin-top: 5%">
            <div class="table-responsive">
              <table class="table table-vcenter card-table">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Transaction Date</th>
                    <th>Total Price</th>
                    <th class="w-1"></th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($transactions as $transaction)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $transaction->transaction_date }}</td>
                    <td>{{ $transaction->total_price }}</td>
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

                function calculateTotalPrice(row) {
                    var price = parseFloat(row.find('.product-select option:selected').data('price')) || 0;
                    var quantity = parseInt(row.find('.quantity-input').val()) || 0;
                    var total = price * quantity;
                    row.find('.total-price-cell').text(total);
                    calculateGrandTotal();
                }

                function calculateGrandTotal() {
                    var grandTotal = 0;
                    $('#table tr:gt(0)').each(function () {
                        grandTotal += parseFloat($(this).find('.total-price-cell').text()) || 0;
                    });
                    $('#grand-total').text(grandTotal);
                    $('#total-price-input').val(grandTotal);
                }

                $(document).on('change', '.product-select, .quantity-input', function () {
                    calculateTotalPrice($(this).closest('tr'));
                });

                $('#add').click(function () {
                    $('#table').append(
                        `<tr>
                            <td></td>
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
                            <td class="total-price-cell">0</td>
                            <td>
                                <button type="button" class="btn btn-danger remove-table-row">-</button>
                            </td>
                        </tr>`
                    );
                    i++;
                });

                $(document).on('click', '.remove-table-row', function () {
                    $(this).closest('tr').remove();
                    calculateGrandTotal();
                });

                calculateGrandTotal();
            });
        </script>
    @endsection