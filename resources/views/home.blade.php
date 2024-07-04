@extends('layouts.base')

@section('title', 'Welcome')

@include('includes.header_section')

@section('content')

    {{-- HEADER --}}
    <div class="title-section py-4">
        <div class="container">
            <div class="row d-flex align-items-end">
                <div class="col-3"><img src="{{ asset('assets/image/books.jpg') }}" alt="" class="img-fluid"></div>
                <div class="col-9">
                    <h1>Unlock the joy of reading with <u>ReadWish</u></h1>
                    </h1>
                    <h2 class="fs-5 fw-light mb-3 pink">Your gateway to a personalized reading experience!</h2>
                    <span class="rectangle">
                        <h5>Why Choose ReadWish?</h5>
                    </span>
                    <ul class="list-unstyled">
                        {{-- <li><i class="bi bi-dot"></i> Discover, organize, and transform your reading habits with Readwish</li> --}}
                        <li><i class="bi bi-dot"></i> Explore new genres and authors with ease</li>
                        <li><i class="bi bi-dot"></i> Leave and read reviews on books</li>
                        <li><i class="bi bi-dot"></i> Earn achievements for reaching
                            reading
                            milestones
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    {{-- BOOKS --}}

    <!-- Ultimi libri inseriti -->
    <div class="container mb-3">
        <h3 class="text-center mt-4">Recently added books</h3>
        <div class="row mt-3 justify-content-center">
            @foreach ($latestBooks as $book)
                @include('partials.bookcard')
            @endforeach
        </div>
    </div>

    {{-- Libri con votazione migliore --}}
    <div class="title-section mb-5 pt-4">
        <div class="container">
            <h3 class="text-center">Best rating books</h3>
            <div class="row mt-3 justify-content-center">
                @foreach ($topRatedBooks as $book)
                    @include('partials.bookcard')
                @endforeach
                <a href="{{ route('home.index') }}" class="text-center mb-4 fw-medium">View all books</a>
            </div>
        </div>
    </div>

@endsection
