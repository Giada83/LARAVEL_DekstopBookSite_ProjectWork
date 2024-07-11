@extends('layouts.admin-sidebar')
@section('title', 'Admin Dashboard')

@section('content')
    @include('partials.admin-sidebar-nav')

    <div class="row justify-content-center mt-4 dash-box">
        <div class="col-md-7 first shadow">
            <a href="{{ route('admin.books_index') }}" class="text-decoration-none">
                <div class="row d-flex align-items-center">
                    <div class="col-5 ps-4 pt-2 img-adm">
                        <img src="{{ asset('assets/image/admin-books.png') }}" class="img-fluid">
                    </div>
                    <div class="col-4 px-4 adm-title">
                        <h3 class="fs-1 mb-0 ps-1">BOOKS</h3>
                        <p class="subtle">Management</p>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <div class="row justify-content-center mt-4 dash-box">
        <div class="col-md-7 second shadow">
            <a href="{{ route('authors.index') }}" class="text-decoration-none">
                <div class="row d-flex align-items-center">
                    <div class="col-5 p-2 img-adm">
                        <img src="{{ asset('assets/image/admin-author.png') }}" class="img-fluid">
                    </div>
                    <div class="col-4 px-4 adm-title">
                        <h3 class="fs-1 mb-0 ps-1">AUTHORS</h3>
                        <p class="subtle">Management</p>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <div class="row justify-content-center mt-4 dash-box">
        <div class="col-md-7 third shadow">
            <a href="{{ route('categories.index') }}" class="text-decoration-none">
                <div class="row d-flex align-items-center">
                    <div class="col-5 p-2 img-adm text-center">
                        <img src="{{ asset('assets/image/admin-categ.png') }}" class="img-fluid">
                    </div>
                    <div class="col-4 px-4 adm-title">
                        <h3 class="fs-1 mb-0 ps-1">CATEGORIES</h3>
                        <p class="subtle">Management</p>
                    </div>
                </div>
            </a>
        </div>
    </div>

@endsection
