@extends('layouts.base')

@section('title', 'Search Books')

@section('content')

    <div class="mt-5">
        <div class="header-section pb-2 mb-4">
            @if ($search)
                <h2 class="text-center text-white">
                    Search Results for "{{ $search }}"
                </h2>
            @else
                <h2 class="text-center text-white">
                    Looking for something specific?
                </h2>
            @endif
        </div>

        <div class="container">
            {{-- barra di ricerca --}}
            <div class="d-flex justify-content-center">
                <form action="{{ route('books.search') }}" method="GET"
                    class="d-flex justify-content-between align-items-center" role="search">
                    <input class="form-control" type="search" name="search" id="search" value="{{ request('search') }}"
                        placeholder="Search by title or author" id="clearSearch" aria-label="Search">
                </form>

                <a href="{{ route('home') }}"><button class="goback yellow-hover"> Go Back </button></a>
                <a href="{{ route('books.index') }}"><button class="goback purple-hover"> Browse Books </button></a>
            </div>

            {{-- card libri e paginazione --}}
            @include('partials.search-card')
        </div>
    </div>
@endsection
