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
            <div class="col-auto col-md-2 px-sm-2 px-0 sidebar-container">
                <div
                    class="d-flex flex-column align-items-center align-items-center align-items-sm-start  px-4 pt-2 min-vh-100">
                    <div
                        class="d-flex align-items-center pb-4 mb-md-3 me-md-auto text-decoration-none flex-column border-bottom border-secondary border-opacity-50">
                        <span class="fs-3 d-none d-sm-inline darkgrey py-2">ReadWish</span>
                        <div class="rev-img">
                            <img src="{{ Auth::user()->image_profile }}" alt="image profile">
                        </div>
                        <p class="side-p">{{ Auth::user()->name }}</p>
                        <small class="card-text text-secondary">{{ Auth::user()->email }}</small>
                    </div>

                    <ul class="nav nav-pills flex-column mb-0 align-items-center align-items-sm-start sidebar-link "
                        id="menu">
                        <li class="nav-item w-100">
                            <a href="{{ route('home') }}" class="nav-link align-middle px-0">
                                <i class="bi-house"></i><span class="ms-1 d-none d-sm-inline">Home</span>
                            </a>
                        </li>
                        <li class="nav-item w-100">
                            <a href="{{ route('books.index') }}" class="nav-link align-middle px-0">
                                <i class="bi-search"></i><span class="ms-1 d-none d-sm-inline">Browse Books</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="nav-link px-0 align-middle">
                                <i class="bi bi-book"></i><span class="ms-1 d-none d-sm-inline">My
                                    Library</span></a>
                        </li>
                        <li>
                            <a href="#" class="nav-link px-0 align-middle">
                                <i class="bi-bookmark-heart"></i><span class="ms-1 d-none d-sm-inline">Favorites</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="nav-link px-0 align-middle">
                                <i class="bi bi-star"></i><span class="ms-1 d-none d-sm-inline">Reviews</span></a>
                        </li>
                        <li>
                            <a href="{{ route('profile.edit') }}" class="nav-link px-0 align-middle">
                                <i class="bi bi-person-circle"></i><span
                                    class="ms-1 d-none d-sm-inline">Profile</span></a>
                        </li>
                    </ul>

                    <hr class="mt-3 mb-3">

                    <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start sidebar-link "
                        id="menu">
                        <li>
                            <a class="nav-link px-0 align-middle" href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form-navbar').submit();">
                                <i class="bi bi-box-arrow-right text-secondary"></i><span
                                    class="ms-1 d-none d-sm-inline text-secondary">Log
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
            <div class="col py-3">
                @yield('content')
            </div>
        </div>
    </div>

    {{-- SCRIPT --}}
    @include('partials.script')
</body>

</html>
