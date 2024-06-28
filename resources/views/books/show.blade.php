@extends('template.base')

@section('title', 'Show Book Detail')

@section('content')
    <h1>BOOK DETAILS</h1>
    {{-- errori --}}
    @if (Session::has('review_error'))
        <div class="alert alert-danger">
            {{ Session::get('review_error') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Se c'è un messaggio di successo da visualizzare --}}
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card mb-5" style="width: 25rem;">
        <img src="{{ $book->cover }}" class="card-img-top" alt="cover">
        <div class="card-body">
            <p class="card-title fs-6">id: {{ $book->id }}</p>
            <p class="card-title fs-6">titolo: {{ $book->title }}</p>
            <p class="card-text fs-6">autore: {{ $book->author->name }} {{ $book->author->surname }}</p>

            {{-- Aggiunta dei pulsanti per i preferiti --}}
            <div class="card-body">
                @if ($book->users()->where('user_id', auth()->id())->wherePivot('is_favorite', true)->exists())
                    <form action="{{ route('books.removeFromFavorites', $book) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-danger">Rimuovi dai preferiti</button>
                    </form>
                @else
                    <form action="{{ route('books.addToFavorites', $book) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary">Aggiungi ai preferiti</button>
                    </form>
                @endif
            </div>

            {{-- Aggiunta dei pulsanti per lo stato di lettura --}}
            <div class="mt-3">
                <form action="{{ route('updateBookStatus', $book) }}" method="POST">
                    @csrf
                    <div class="btn-group" role="group" aria-label="Stato di lettura">
                        <button type="submit"
                            class="btn btn-outline-primary @if ($book->users()->where('user_id', auth()->id())->wherePivot('status', 'already_read')->exists()) btn-primary @endif"
                            name="status" value="already_read">Già letto</button>
                        <button type="submit"
                            class="btn btn-outline-primary @if ($book->users()->where('user_id', auth()->id())->wherePivot('status', 'reading')->exists()) btn-primary @endif"
                            name="status" value="reading">In lettura</button>
                        <button type="submit"
                            class="btn btn-outline-primary @if ($book->users()->where('user_id', auth()->id())->wherePivot('status', 'want_to_read')->exists()) btn-primary @endif"
                            name="status" value="want_to_read">Da leggere</button>
                    </div>
                </form>
            </div>

            {{-- Sezione delle recensioni --}}
            <h2 class="mt-3">Recensioni</h2>
            @if ($reviews->count() > 0)
                <div class="mt-4">
                    <ul class="list-group">
                        @foreach ($reviews as $review)
                            <li class="list-group-item">
                                <p><strong>Utente:</strong> {{ $review->user->name }}</p>
                                <p><strong>Voto:</strong> {{ $review->rating }} SU 5</p>
                                <p><strong>Commento:</strong> {{ $review->review }}</p>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @else
                <p>Non ci sono recensioni per questo libro.</p>
            @endif
        </div>
    </div>

    {{-- Form per le recensioni --}}
    {{-- Bottone per lasciare una recensione --}}
    @auth
        <div class="mt-4">
            <form method="POST" action="{{ route('reviews.store') }}">
                @csrf
                <input type="hidden" name="book_id" value="{{ $book->id }}">
                <div>
                    <label for="rating">Rating (da 1 a 5):</label>
                    <input type="number" name="rating" id="rating" min="1" max="5" required>
                </div>
                <div>
                    <label for="review">Recensione:</label>
                    <textarea name="review" id="review" rows="5" maxlength="1000" required></textarea>
                </div>
                <button type="submit">Invia recensione</button>
            </form>
        </div>
    @endauth

    @guest
        <p class="mt-4">Per lasciare una recensione devi effettuare l'accesso.</p>
    @endguest

@endsection
