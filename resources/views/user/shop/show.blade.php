@extends('user.home')

@section('user-shop')
    <div class="container mt-4">
        <div class="card mb-3" style="max-width: 540px;">
            <div class="row g-0">
                <div class="col-md-4">
                    <img src="{{ asset("/storage/product_images/$product->image") }}" class="img-fluid rounded-start" alt="{{ $product->product_name }}">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->product_name }}</h5>
                        <p class="card-text">{{ $product->description }}</p>
                        <p class="card-text"><b>Price: </b> {{ $product->price }} EGP</p>
                        <a href="#" class="btn btn-primary">Add to Cart</a>
                    </div>
                </div>
            </div>
        </div>
        <a href="{{ route('shops.index') }}" class="btn btn-secondary">Back to Products</a>
    </div>
@endsection
