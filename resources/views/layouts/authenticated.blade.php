<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ReadWish ~ @yield('title')</title>

    @include('partials.head')
</head>

<body>
    @yield('content')

    {{-- SCRIPT --}}
    @include('partials.script')
</body>

</html>
