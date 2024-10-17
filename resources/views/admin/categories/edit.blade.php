@extends('admin.dashboard')

@section('title', 'Edit Category')

@section('content')
<div class="container">
    <h1 class="mb-4">Edit Category</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('admin.categories.update', $category->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="category_name" class="form-label">Category name</label>
            <input type="text" class="form-control" id="category_name" name="category_name" value="{{ old('category_name', $category->category_name) }}" required>
        </div>
        <div class="mb-3">
            <label for="category_image" class="form-label">Category image</label>
            <input type="file" class="form-control" id="category_image" name="category_image" accept="image/*">
        </div>
        @if($category->image)
            <div class="mb-3">
                <label class="form-label">Current Image</label>
                <img src="{{ asset('storage/category_images/' . $category->image) }}" alt="{{ $category->category_name }}" class="img-thumbnail" style="max-width: 200px;">
            </div>
        @endif
        <button type="submit" class="btn btn-primary">Update Category</button>
        <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection