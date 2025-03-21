@extends('templates.default')

@push('page-action')
  <a href="{{ route('categories.create') }}" class="btn btn-primary">
    New Data
  </a>
@endpush

@section('content')
<div class="card">
    <div class="table-responsive">
      <table class="table table-vcenter card-table">
        <thead>
          <tr>
            <th>No.</th>
            <th>Category</th>
            <th>Action</th>
            <th class="w-1"></th>
          </tr>
        </thead>
        <tbody>
          @foreach ($categories as $category)
          <tr>
            <td>{{ $category->id_category }}</td>
            <td>{{ $category->category }}</td>
            <td>
              <a href="{{ route('categories.edit', $category->id_category) }}" class="btn btn-primary btn-sm" style="display: inline-block;">Edit</a>
              <form action="{{ route('categories.destory', $category->id_category) }}" method="POST" style="display: inline-block;">
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