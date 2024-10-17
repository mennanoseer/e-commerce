@extends('user.home')
@section('user-categories')
    <div class="container d-flex justify-content-evenly">
        @foreach ($categories as $category)
            <a href="{{ route('user.categories.products', $category->id) }}">{{ $category->category_name }}</a>
        @endforeach
    </div>
@endsection