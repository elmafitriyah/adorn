@extends('templates.default')

@php
    $title = 'Product';
    $preTitle = 'Add Product';
@endphp

@section('content')
    <div class="mb-3">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Product</label>
                        <input type="text" name="product" class="form-control @error('product') is-invalid @enderror" placeholder="Add Product" value="{{ old('product') }}">
                        @error('product')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <input type="text" name="description" class="form-control @error('description') is-invalid @enderror" placeholder="Add Description" value="{{ old('description') }}">
                        @error('description')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Price</label>
                        <input type="text" name="price" class="form-control @error('price') is-invalid @enderror" placeholder="Add Price" value="{{ old('price') }}">
                        @error('price')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Stock</label>
                        <input type="text" name="stock" class="form-control @error('stock') is-invalid @enderror" placeholder="Add Stock" value="{{ old('stock') }}">
                        @error('stock')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Category</label>
                        <select name="id_category" class="form-control @error('id_category') is-invalid @enderror">
                            <option value="">Choose Category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id_category }}" {{ old('id_category', isset($product) ? $product->id_category : '') == $category->id_category ? 'selected' : '' }}>
                                    {{ $category->category }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_category')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Image</label>
                        <input type="file" id="imageUpload" name="image" class="form-control" accept=".png, .jpg, .svg" onchange="previewImage(this)" required>

                        @error('image')
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