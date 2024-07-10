@extends('layouts.base')

@section('title', 'Welcome')

@include('includes.header_section')

@section('content')

    {{-- BOOKS --}}
    <!-- Ultimi libri inseriti -->
    <div class="container mb-3">
        <h3 class="text-center mt-4">Recently added books</h3>
        <div class="row d-flex mt-3 justify-content-center">
            @foreach ($latestBooks as $book)
                @include('partials.bookcard')
            @endforeach
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
        <h3 class="text-center mt-4">Our Suggestions: Today's Picks</h3>
        <div class="row d-flex mt-3 justify-content-center">
            @foreach ($randomBooks as $book)
                @include('partials.bookcard')
            @endforeach
        </div>
    </div>

@endsection
