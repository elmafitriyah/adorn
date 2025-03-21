<!DOCTYPE html>
<html>
    <head>
        <title>Input New Transaction Here</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    </head>
    <body>
        <div class="container d-flex justify-content center-pt-5">
            <div class="col-md-9">
                <h2 class="text-center pb-3 text-danger">Input New Transaction Here</h2>

                <form action="/post" method="POST">
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

                      <div class="m-3">
                        <form action="/transaction_detail" method="POST">
                            @csrf
                            <div class="m-3">
                                <table class="table table-bordered" id="table">
                                    <tr>
                                        <th>Transaction Date</th>
                                        <th>Product</th>
                                        <th>Quantity</th>
                                        <th>Aksi</th>
                                    </tr>        
                                    <tr>
                                        <td>
                                            <input type="date" name="id_transaction" class="form-control @error('id_transaction')
                                            is-invalid
                                            @enderror" name="example-text-input" placeholder="Masukkan Barang" value="{{ old('id_transaction') }}">
                                        </td>
                                        <td>
                                            <input type="text" name="id_product" class="form-control @error('id_product')
                                            is-invalid
                                            @enderror" name="example-text-input" placeholder="Masukkan Barang" value="{{ old('id_product') }}">
                                        </td>
                                        <td>
                                            <input type="text" name="quantity" class="form-control @error('quantity')
                                            is-invalid
                                            @enderror" name="example-text-input" placeholder="Masukkan Barang" value="{{ old('quantity') }}">
                                        </td>
                                        <td>
                                            <button type="button" name="add" id="add" class="btn btn-success btn-sm">Add Product</button>
                                        </td>
                                    </tr>
b 
                                </table>
                            </div>
                      </div>
                </form>
            </div>
        </div>
    </body>
</html>