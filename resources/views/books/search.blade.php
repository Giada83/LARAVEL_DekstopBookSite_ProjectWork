@extends('layouts.base')

@section('title', 'Search Books')

@section('content')

    <div class="container">
        @if (!empty($search))
            <h2 class="mt-4">Search Results for "{{ $search }}"</h2>

            <div id="searchResults">
                @if ($books->isEmpty())
                    <p>No results found.</p>
                @else
                    <div class="row">
                        @foreach ($books as $book)
                            <div class="col-md-2"> @include('partials.bookcard')</div>
                        @endforeach
                    </div>
                @endif
            </div>
        @endif
    </div>

@endsection
