@extends('user.home')
@section('user-shop')
    <div class="container d-flex gap-4 mt-4 flex-wrap">
        @foreach ($products as $product)
            <div class="card" style="width: 18rem;">
                {{-- @dd($product->image) --}}
                <img src="{{ asset("/storage/product_images/$product->image") }}" class="card-img-top" alt="">
                <div class="card-body">
                    <h5 class="card-title">{{ $product->product_name }}</h5>
                    <p class="card-text">{{ Str::of($product->description)->limit(20) }}</p>
                    <span><b>{{ $product->price }}</b></span>
                    <a href="{{ route('shops.show', $product->id) }}" class="btn btn-primary float-end">View Details</a>
                </div>
            </div>
        @endforeach
    </div>
    <div class="d-flex justify-content-center">
        {{ $products->links() }}
    </div>
@endsection