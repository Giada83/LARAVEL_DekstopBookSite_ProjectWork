@include('partials.head')

<header>
    @include('includes.navbar')
</header>

<body>
    @yield('content')

    @include('partials.script')

</body>

</html>
