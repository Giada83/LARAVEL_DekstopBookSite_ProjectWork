@extends('template.base')

@section('title', 'Show Book Detail')

@section('content')
    <h1>BOOK DETAILS</h1>
    {{-- @dd($books->id) --}}

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
        </div>
    </div>

@endsection
