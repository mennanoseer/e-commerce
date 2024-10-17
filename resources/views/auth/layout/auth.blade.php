<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{asset('/assets/css/bootstrap.css')}}">
</head>
<body class="bg-light">
    @yield('content')
    <script src="{{asset('/assets/js/bootstrap.bundle.js')}}"></script>
</body>
</html>