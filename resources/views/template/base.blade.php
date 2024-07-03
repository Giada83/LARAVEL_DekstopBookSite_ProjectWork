@include('partials.head')

<header>
    @include('includes.navbar')
    @include('includes.header_section')
</header>

<body>
    @yield('content')

    @include('partials.script')

</body>

</html>
