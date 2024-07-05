@extends('layouts.base')

@section('title', 'BooksList')

@section('content')

    <div class="mt-5">

        <div class="container">
            <h2 class="text-center pt-3">ReadWish - Explore the Library</h2>
            <form action="{{ route('books.index') }}" method="GET">
                {{-- ricerca per tipologia e categorie --}}
                <label for="search">Search:</label>
                <input type="text" name="search" id="search" value="{{ request('search') }}"
                    placeholder="Search by title or author">

                {{-- Filtra per tipologia --}}
                <label for="sort">Sort By:</label>
                <select name="sort" id="sort">
                    <option value="title_asc" {{ request('sort') == 'title_asc' ? 'selected' : '' }}>Title: A-Z
                    </option>
                    <option value="title_desc" {{ request('sort') == 'title_desc' ? 'selected' : '' }}>Title: Z-A
                    </option>
                    <option value="author" {{ request('sort') == 'author' ? 'selected' : '' }}>Author</option>
                    <option value="recent" {{ request('sort') == 'recent' ? 'selected' : '' }}>Latest books added</option>
                    <option value="best_reviews" {{ request('sort') == 'best_reviews' ? 'selected' : '' }}>Best reviews
                    </option>
                </select>

                {{-- Filta per categorie --}}
                <label for="category">Filter By Category:</label>
                <select name="category" id="category">
                    <option value="">All Categories</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>

                <button type="submit">Apply</button>
                <button type="button" onclick="resetForm()">Reset</button>
            </form>

            {{-- card libri --}}
            <div class="row mt-3 d-flex justify-content-center">
                @forelse ($books as $book)
                    @include('partials.bookcard')
                @empty
                    <div class="row d-flex justify-content-center">
                        <div class="col-5 text-center bg-white rounded p-2">
                            <img src="{{ asset('assets/image/no_results.jpg') }}" class="img-fluid">
                            <p class="fs-3 mb-0 purple fw-semibold">No
                                Results Found</p>
                            <p class="fs-6 fw-light mb-0">Explore Different Keywords</p>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

@endsection
