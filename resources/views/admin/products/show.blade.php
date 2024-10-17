@extends('admin.dashboard')

@section('title', 'Product Details')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <img src="{{ asset("/storage/product_images/$product->image") }}" class="card-img-top" alt="{{ $product->product_name }}" style="height: 300px; object-fit: cover;">
                <div class="card-body">
                    <h1 class="card-title">{{ $product->product_name }}</h1>
                    <p class="card-text"><strong>Description:</strong> {{ $product->description }}</p>
                    <p class="card-text"><strong>Price:</strong> ${{ number_format($product->price, 2) }}</p>
                    <p class="card-text"><strong>Category:</strong> {{ $product->category->category_name }}</p>
                </div>
                <div class="card-footer">
                    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-primary">Edit</a>
                    <a href="{{ route('products.index') }}" class="btn btn-secondary">Back to List</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection