<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="{{asset('/assets/css/bootstrap.css')}}">
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('home') }}">myproject.com</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('shops.index') }}">Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('user.categories.index') }}">Categories</a>
                    </li>
                </ul>
                @if(Auth()->user())
                    <form method="post" action="{{ route('auth.logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-danger me-2" value="logout">Logout</button>
                    </form>
                    <span><b> {{ Str::of(Auth()->user()->name) }} </b></span>
                @else
                    <a href="{{ route('auth.login') }}" class="btn btn-secondary me-2">Login</a>
                @endif
                <form class="d-flex" role="search" method="GET" action="{{ route('products.search') }}">
                    @csrf
                    <input class="form-control me-2" type="search" name="q" placeholder="Search Products">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>
    @yield('user-shop')
    @yield('user-categories')

    <script src="{{asset('/assets/js/bootstrap.bundle.js')}}"></script>
</body>

</html>