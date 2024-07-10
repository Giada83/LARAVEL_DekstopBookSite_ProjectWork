@extends('layouts.base')

@section('title', 'Welcome')

@include('includes.header_section')

@section('content')

    {{-- BOOKS --}}
    <!-- Ultimi libri inseriti -->
    <div class="container mb-3">
        <h3 class="text-center mt-4">Recently added books</h3>
        <div class="row d-flex mt-3 justify-content-center">
            {{-- @foreach ($latestBooks as $book)
                @include('partials.bookcard')
            @endforeach --}}
            <div id="bookCarousel" class="carousel slide mt-3 carousel-dark" data-bs-ride="carousel">
                <div class="carousel-inner">
                    @foreach ($latestBooks->chunk(5) as $chunk)
                        <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                            <div class="row justify-content-center">
                                @foreach ($chunk as $book)
                                    @include('partials.bookcard')
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#bookCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#bookCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>

        </div>
    </div>

    {{-- Libri con votazione migliore --}}
    <div class="title-section mb-3 pt-4">
        <div class="container">
            <h3 class="text-center">Best rating books</h3>
            <div class="row d-flex mt-3 justify-content-center">
                @foreach ($topRatedBooks as $book)
                    @include('partials.bookcard')
                @endforeach
                <a href="{{ route('books.index') }}" class="text-center mb-4 fw-medium">View all books</a>
            </div>
        </div>
    </div>

    {{-- libri random --}}
    <div class="container mb-3">
        <h3 class="text-center mt-4">Our Suggestions</h3>
        <div class="row d-flex mt-3 justify-content-center">
            @foreach ($randomBooks as $book)
                @include('partials.bookcard')
            @endforeach
        </div>
    </div>

@endsection
