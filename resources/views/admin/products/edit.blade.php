@extends('admin.dashboard')

@section('title', 'Edit Product')

@section('content')
<div class="container">
    <h1 class="mb-4">Edit Product</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form method="POST" action="{{ route('products.update', $product->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="product_name" class="form-label">Product name</label>
            <input type="text" class="form-control" id="product_name" name="product_name" value="{{ old('product_name', $product->product_name) }}">
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Product description</label>
            <textarea class="form-control" id="description" name="description" rows="3">{{ old('description', $product->description) }}</textarea>
        </div>
        <div class="mb-3">
            <label for="product_price" class="form-label">Product price</label>
            <input type="number" class="form-control" id="product_price" name="product_price" step="0.01" value="{{ old('product_price', $product->price) }}">
        </div>
        <div class="mb-3">
            <label for="category_id" class="form-label">Category</label>
            <select name="category_id" id="category_id" class="form-select">
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ $category->id == old('category_id', $product->category_id) ? "selected" : "" }}>{{ $category->category_name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="product_image" class="form-label">Product image</label>
            <input type="file" class="form-control" id="product_image" name="product_image" accept="image/*">
        </div>
        <div class="mb-3">
            <img src="{{ asset("/storage/product_images/$product->image") }}" alt="{{ $product->product_name }}" class="img-thumbnail" style="max-width: 200px;">
        </div>
        <button type="submit" class="btn btn-primary">Update Product</button>
        <a href="{{ route('products.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection