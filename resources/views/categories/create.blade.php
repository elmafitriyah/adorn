@extends('templates.default')

@php
    $title = 'Category';
    $preTitle = 'Add Category';
@endphp

@section('content')
    <div class="mb-3">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('categories.store') }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Category</label>
                        <input type="text" name="category" class="form-control @error('category') is-invalid @enderror" placeholder="Add Category" value="{{ old('category') }}">
                        @error('category')
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