<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ReadWish ~ @yield('title')</title>

    @include('partials.head')
</head>

<body>
    <div class="container-fluid">
        <div class="row flex-nowrap">
            <div class="col-auto col-md-2 px-sm-2 px-0 admin-sidebar">
                <div
                    class="d-flex flex-column align-items-center align-items-center align-items-sm-start px-4 pt-3 min-vh-100">
                    <div class="d-flex align-items-center pb-3 mb-md-3 me-md-auto text-decoration-none flex-column">
                        <span class="fs-3 d-none d-sm-inline pt-2 pb-3 fw-medium text-center w-100 adm-title">ReadWish
                        </span>
                    </div>
                    <ul class="nav nav-pills flex-column mb-0 mb-sm-auto align-items-center align-items-sm-start admin-link"
                        id="menu">
                        {{-- home --}}
                        <li class="nav-item w-100">
                            <a href="{{ route('home') }}" class="nav-link align-middle px-0">
                                <i class="bi-house"></i><span class="ms-1 d-none d-sm-inline">Home</span>
                            </a>
                        </li>
                        {{-- Tabella libri --}}
                        <li>
                            <a href="#" class="nav-link px-0 align-middle">
                                <i class="bi bi-book"></i><span class="ms-1 d-none d-sm-inline">Books</span></a>
                        </li>
                        {{-- Tabella autori --}}
                        <li>
                            <a href="#" class="nav-link px-0 align-middle">
                                <i class="bi bi-people"></i><span class="ms-1 d-none d-sm-inline">Authors</span></a>
                        </li>
                        {{-- Tabella categorie --}}
                        <li>
                            <a href="#" class="nav-link px-0 align-middle">
                                <i class="bi-tags"></i><span class="ms-1 d-none d-sm-inline">Categories</span>
                            </a>
                        </li>
                        {{-- dashboard user --}}
                        <li>
                            <a href="{{ route('dashboard') }}" class="nav-link px-0 align-middle">
                                <i class="bi bi-speedometer"></i><span class="ms-1 d-none d-sm-inline">Dashboard</span>
                            </a>
                        </li>
                        {{-- logout --}}
                        <li>
                            <a class="nav-link px-0 align-middle" href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form-navbar').submit();">
                                <i class="bi bi-box-arrow-right "></i><span class="ms-1 d-none d-sm-inline ">Log
                                    Out</span>
                            </a>
                            <form id="logout-form-navbar" action="{{ route('logout') }}" method="POST"
                                style="display: none;">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
            {{-- navbar del contenuto principale --}}
            <div class="col pb-3">
                @yield('content')
            </div>
        </div>
    </div>

    {{-- SCRIPT --}}
    @include('partials.script')
</body>

</html>
