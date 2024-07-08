@extends('layouts.sidebar')
@section('title', 'My Favorites')
@section('content')


    <div class="px-3">
        <h2 class="purple fw-light fav-title mb-4">Favorite Books</h2>

        <div class="row">
            @if ($favoriteBooks->isNotEmpty())
                @foreach ($favoriteBooks as $book)
                    <div class="col-md-6 mb-3">
                        <div class="border p-2 rounded border-1 shadow-sm">
                            <div class="card">
                                <div class="row g-0 d-flex align-items-start">
                                    {{-- immagine --}}
                                    <div class="col-md-4 ">
                                        @if ($book->cover)
                                            @if (Storage::exists($book->cover))
                                                <img src="{{ Storage::url($book->cover) }}" class="img-fluid rounded"
                                                    alt="Book cover">
                                            @else
                                                <img src="{{ $book->cover }}" class="img-fluid rounded" alt="Book cover">
                                            @endif
                                        @else
                                            <img src="{{ asset('assets/image/no_cover.jpg') }}" class="img-fluid rounded"
                                                alt="default cover">
                                        @endif
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card-body text-start ps-3">
                                            <a href="{{ route('books.show', ['book' => $book->id]) }}" class="lib-card">
                                                {{-- autore --}}
                                                <p class="card-text mb-1">{{ $book->author->name }}
                                                    {{ $book->author->surname }}
                                                </p>
                                                {{-- titolo --}}
                                                <h5 class="card-title fw-light p-0 fs-6">{{ $book->title }}</h5>
                                                {{-- categorie --}}
                                                <p class="card-text mb-2">
                                                    <small>
                                                        @foreach ($book->categories as $category)
                                                            <span class="px-1 fst-italic">
                                                                #{{ $category->name }}</span>
                                                        @endforeach
                                                    </small>
                                                </p>
                                            </a>
                                            {{-- bottone --}}
                                            <div class="card-text">
                                                <form action="{{ route('books.removeFromFavorites', $book) }}"
                                                    method="POST">
                                                    @csrf
                                                    <button type="submit" class="btn-fav">
                                                        <div class="d-flex align-items-center">
                                                            <i class="bi bi-heartbreak-fill fs-6 pink"></i>
                                                            <span class="ms-1 fw-light">Remove</span>
                                                        </div>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="col-12 col-md-6 text-left pt-2">
                    <div class="d-flex align-items-center flex-column">
                        <img src="{{ asset('assets/image/favorite.png') }}" alt="girl with book" class="lib-img img-fluid">
                        <p class="p-size fw-light">No books have been added to favorite yet</p>
                    </div>
                </div>
            @endif
        </div>
    </div>

@endsection
