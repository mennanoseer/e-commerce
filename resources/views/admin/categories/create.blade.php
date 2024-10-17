@extends('admin.dashboard')

@section('title', 'Create Category')

@section('content')
<div class="container">
    <h1 class="mb-4">Create New Category</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form method="POST" action="{{ route('admin.categories.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="category_name" class="form-label">Category name</label>
            <input type="text" class="form-control" id="category_name" name="category_name" value="{{ old('category_name') }}">
        </div>
        <div class="mb-3">
            <label for="category_image" class="form-label">Category image</label>
            <input type="file" class="form-control" id="category_image" name="category_image" accept="image/*">
        </div>
        <button type="submit" class="btn btn-primary">Add Category</button>
        <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection