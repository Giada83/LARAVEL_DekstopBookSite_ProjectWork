@extends('template.base')

@section('content')
    <div class="container">
        <h1>I miei preferiti</h1>
        <div class="row">
            @foreach ($favoriteBooks as $book)
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">{{ $book->title }}</div>
                        <div class="card-body">
                            <p>{{ $book->id }}</p>
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
@endsection
