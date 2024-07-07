@include('partials.head')

<header>
    @include('includes.navbar')
</header>

<body>
    @yield('content')

    <footer>
        <div style="background-color:purple; height:2rem"></div>
    </footer>

    @include('partials.script')
</body>

</html>
