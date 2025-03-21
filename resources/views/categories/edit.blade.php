@extends('templates.default')

@php
    $title = 'Category';
    $preTitle = 'Edit Category';
@endphp

@section('content')
    <div class="mb-3">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('categories.update', $category->id_category) }}" class="" method="post">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label class="form-label">Category</label>
                        <input type="text" name="category" class="form-control" placeholder="Add Category" value="{{ $category->category }}">
                    </div>
                    <div class="mb-3">
                        <input type="submit" value="Submit" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection