@extends('admin.dashboard')

@section('title', 'All Products')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h2">All Products</h1>
        <a href="{{ route('products.create') }}" class="btn btn-success">
            <i class="fas fa-plus"></i> Add New Product
        </a>
    </div>

    @if ($products->isEmpty())
        <div class="alert alert-info">
            No products found.
        </div>
    @else
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4 g-4">
            @foreach ($products as $product)
                <div class="col">
                    <div class="card h-100">
                        <img src="{{ asset("/storage/product_images/$product->image") }}" class="card-img-top" alt="{{ $product->product_name }}" style="height: 200px; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->product_name }}</h5>
                            <p class="card-text">{{ Str::limit($product->description, 100) }}</p>
                            <p class="card-text"><strong>Price:</strong> ${{ number_format($product->price, 2) }}</p>
                            <p class="card-text"><strong>Category:</strong> {{ $product->category->category_name }}</p>
                        </div>
                        <div class="card-footer bg-transparent border-top-0">
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('products.show', $product->id) }}" class="btn btn-sm btn-info">
                                    <i class="fas fa-eye"></i> View
                                </a>
                                <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm btn-primary">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <form method="POST" action="{{ route('products.destroy', $product->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this product?')">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        
        <div class="d-flex justify-content-center mt-4">
            {{ $products->links() }}
        </div>
    @endif
</div>
@endsection