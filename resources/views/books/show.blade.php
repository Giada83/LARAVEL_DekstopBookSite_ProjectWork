@extends('template.base')

@section('title', 'Show Book Detail')

@section('content')
    <h1>BOOK DETAILS</h1>

    <div class="card" style="width: 18rem;">
        <img src="{{ $book->cover }}" class="card-img-top" alt="cover">
        <div class="card-body">
            <p class="card-title fs-6">id: {{ $book->id }}</p>
            <p class="card-title fs-6">titolo: {{ $book->title }}</p>
            <p class="card-text fs-6">autore: {{ $book->author->name }} {{ $book->author->surname }}</p>

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

            {{-- Aggiunta dei pulsanti per lo stato --}}
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
        </div>
    </div>

@endsection
