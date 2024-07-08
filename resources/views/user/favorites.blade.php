@extends('layouts.sidebar')
@section('title', 'My Favorites')
@section('content')


    <div class="px-3">
        <h2 class="purple fw-light fav-title mb-0">Favorite Books</h2>
        <p class="fav-subtitle mb-4">*Click on the image to view the book details</p>

        <div class="row">
            @foreach ($favoriteBooks as $book)
                <div class="col-md-6 mb-3">
                    <div class="border p-2 rounded border-1 shadow-sm">
                        <div class="card" style="max-width: 540px;">
                            <div class="row g-0 d-flex align-items-center">
                                {{-- immagine --}}
                                <div class="col-md-4 ">
                                    <a href="{{ route('books.show', ['book' => $book->id]) }}">
                                        @if ($book->cover)
                                            @if (Storage::exists($book->cover))
                                                <img src="{{ Storage::url($book->cover) }}"
                                                    class="card-img-top img-fluid img-card rounded" alt="Book cover">
                                            @else
                                                <img src="{{ $book->cover }}" class="img-fluid rounded-start rounded"
                                                    alt="Book cover">
                                            @endif
                                        @else
                                            <img src="{{ asset('assets/image/no_cover.jpg') }}"
                                                class="card-img-top img-fluid img-card rounded" alt="default cover">
                                        @endif
                                    </a>
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body text-start ps-3">
                                        {{-- autore --}}
                                        <p class="card-text mb-1">{{ $book->author->name }} {{ $book->author->surname }}</p>
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
                                        {{-- bottone --}}
                                        <div class="card-text">
                                            <form action="{{ route('books.removeFromFavorites', $book) }}" method="POST">
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
        </div>
    </div>

@endsection

{{-- Sezione "Già Letto"
        <div class="mt-4">
            <h2>Già Letto</h2>
            <div class="row">
                @foreach ($alreadyRead as $book)
                    <div class="col-md-4 mb-3">
                        <div class="card">
                            <div class="card-header">{{ $book->title }}</div>
                            <div class="card-body">
                                <p>ID: {{ $book->id }}</p>
                                <!-- Aggiungi qui il form per aggiornare lo stato se necessario -->
                                <!-- Bottone per rimuovere lo stato -->
                                <form action="{{ route('books.removeBookStatus', $book->id) }}" method="POST">
                                    @csrf
                                    <button type="submit">Rimuovi Stato</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Sezione "In Lettura" --}}
{{-- <div class="mt-4">
            <h2>In Lettura</h2>
            <div class="row">
                @foreach ($reading as $book)
                    <div class="col-md-4 mb-3">
                        <div class="card">
                            <div class="card-header">{{ $book->title }}</div>
                            <div class="card-body">
                                <p>ID: {{ $book->id }}</p>
                                <!-- Aggiungi qui il form per aggiornare lo stato se necessario -->
                                <!-- Bottone per rimuovere lo stato -->
                                <form action="{{ route('books.removeBookStatus', $book->id) }}" method="POST">
                                    @csrf
                                    <button type="submit">Rimuovi Stato</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div> --}}

{{-- Sezione "Da Leggere" --}}
{{-- <div class="mt-4">
            <h2>Da Leggere</h2>
            <div class="row">
                @foreach ($wantToRead as $book)
                    <div class="col-md-4 mb-3">
                        <div class="card">
                            <div class="card-header">{{ $book->title }}</div>
                            <div class="card-body">
                                <p>ID: {{ $book->id }}</p>
                                <!-- Aggiungi qui il form per aggiornare lo stato se necessario -->
                                <!-- Bottone per rimuovere lo stato -->
                                <form action="{{ route('books.removeBookStatus', $book->id) }}" method="POST">
                                    @csrf
                                    <button type="submit">Rimuovi Stato</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>  --}}
