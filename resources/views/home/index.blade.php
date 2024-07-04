@extends('layouts.base')

@section('title', 'BooksList')

@section('content')

    <div class="mt-5">
        <div class="container">
            <h2 class="text-center pt-3">ReadWish - Explore the Library</h2>

            {{-- <form action="{{ route('home.index') }}" method="GET">
                <label for="sort">Sort By:</label>
                <select name="sort" id="sort" onchange="this.form.submit()">
                    <option value="title_asc" {{ request('sort') == 'title_asc' ? 'selected' : '' }}>Title: A-Z</option>
                    <option value="title_desc" {{ request('sort') == 'title_desc' ? 'selected' : '' }}>Title: Z-A
                    </option>
                    <option value="author" {{ request('sort') == 'author' ? 'selected' : '' }}>Author</option>
                    </option>
                    <option value="recent" {{ request('sort') == 'recent' ? 'selected' : '' }}>Most Recent Update</option>
                    <option value="best_reviews" {{ request('sort') == 'best_reviews' ? 'selected' : '' }}>Best Reviews
                    </option>
                </select>
            </form> --}}
            <form action="{{ route('home.index') }}" method="GET">
                <label for="sort">Sort By:</label>
                <select name="sort" id="sort">
                    <option value="title_asc" {{ request('sort') == 'title_asc' ? 'selected' : '' }}>Title Ascending</option>
                    <option value="title_desc" {{ request('sort') == 'title_desc' ? 'selected' : '' }}>Title Descending
                    </option>
                    <option value="author" {{ request('sort') == 'author' ? 'selected' : '' }}>Author</option>
                    <option value="recent" {{ request('sort') == 'recent' ? 'selected' : '' }}>Most Recent</option>
                    <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Oldest</option>
                    <option value="best_reviews" {{ request('sort') == 'best_reviews' ? 'selected' : '' }}>Best Reviews
                    </option>
                    <option value="year_asc" {{ request('sort') == 'year_asc' ? 'selected' : '' }}>Year Ascending</option>
                    <option value="year_desc" {{ request('sort') == 'year_desc' ? 'selected' : '' }}>Year Descending
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
            </form>

            <div class="row mt-3 justify-content-center">
                @foreach ($books as $book)
                    @include('partials.bookcard')
                @endforeach
            </div>
        </div>
    </div>

@endsection
