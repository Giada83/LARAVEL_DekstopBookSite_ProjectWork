@include('partials.head')

<header>
    @include('includes.navbar')
    @include('includes.header_section')
</header>

<body>
    <div class="container">
        @yield('content')
    </div>

    @include('partials.script')

</body>

</html>
