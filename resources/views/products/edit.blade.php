@extends('templates.default')

@php
    $title = 'product';
    $preTitle = 'Edit product';
@endphp

@section('content')
    <div class="mb-3">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('products.update', $product->id_product) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label class="form-label">Product</label>
                        <input type="text" name="product" class="form-control @error('product') is-invalid @enderror" placeholder="Add product" value="{{ $product->product }}">
                        @error('product')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <input type="text" name="description" class="form-control @error('description') is-invalid @enderror" placeholder="Add Description" value="{{ $product->description }}">
                        @error('description')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Price</label>
                        <input type="text" name="price" class="form-control @error('price') is-invalid @enderror" placeholder="Add Price" value="{{ $product->price }}">
                        @error('price')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Stock</label>
                        <input type="text" name="stock" class="form-control @error('stock') is-invalid @enderror" placeholder="Add Stock" value="{{ $product->stock }}">
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
                        <label class="form-label">Current Image</label>
                        <br>
                        @if($product->image)
                            <img src="{{ asset($product->image) }}" alt="Current Image" width="150">
                        @else
                            <p>No image available</p>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Upload New Image</label>
                        <input type="file" name="image" class="form-control @error('image') is-invalid @enderror">
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