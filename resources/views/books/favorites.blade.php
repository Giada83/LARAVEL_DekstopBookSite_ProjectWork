@extends('template.base')

@section('content')
    <div class="container">
        <h1>I miei libri</h1>

        {{-- Sezione dei Preferiti --}}
        <div class="mt-4">
            <h2>Preferiti</h2>
            <div class="row">
                @foreach ($favoriteBooks as $book)
                    <div class="col-md-4 mb-3">
                        <div class="card">
                            <div class="card-header">{{ $book->title }}</div>
                            <div class="card-body">
                                <p>ID: {{ $book->id }}</p>
                                <form action="{{ route('books.removeFromFavorites', $book) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-danger">Rimuovi dai preferiti</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Sezione "Già Letto" --}}
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
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Sezione "In Lettura" --}}
        <div class="mt-4">
            <h2>In Lettura</h2>
            <div class="row">
                @foreach ($reading as $book)
                    <div class="col-md-4 mb-3">
                        <div class="card">
                            <div class="card-header">{{ $book->title }}</div>
                            <div class="card-body">
                                <p>ID: {{ $book->id }}</p>
                                <!-- Aggiungi qui il form per aggiornare lo stato se necessario -->
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Sezione "Da Leggere" --}}
        <div class="mt-4">
            <h2>Da Leggere</h2>
            <div class="row">
                @foreach ($wantToRead as $book)
                    <div class="col-md-4 mb-3">
                        <div class="card">
                            <div class="card-header">{{ $book->title }}</div>
                            <div class="card-body">
                                <p>ID: {{ $book->id }}</p>
                                <!-- Aggiungi qui il form per aggiornare lo stato se necessario -->
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

    </div>
@endsection
