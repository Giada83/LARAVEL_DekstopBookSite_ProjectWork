@extends('layouts.base')

@section('title', 'BooksList')

@section('content')

    <div class="mt-5">

        <div class="container">
            <h2 class="text-center pt-3">ReadWish - Explore the Library</h2>
            {{-- ricerca per tipologia e categorie --}}
            <form action="{{ route('books.index') }}" method="GET">
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
            <div class="row mt-3 justify-content-center">
                @foreach ($books as $book)
                    @include('partials.bookcard')
                @endforeach
            </div>
        </div>
    </div>

@endsection
