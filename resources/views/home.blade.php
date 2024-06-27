@extends('template.base')

@section('title', 'Welcome')

@section('content')
    <h1>WELCOME</h1>

    <div class="row g-1">
        @foreach ($books as $book)
            <div class="col-2">
                <a href="{{ route('books.show', ['book' => $book->id]) }}" class="card-link">
                    <div class="card">
                        <img src="{{ $book->cover }}" class="card-img-top" alt="cover">
                        <div class="card-body">
                            <p class="card-title fs-6">{{ $book->title }}</p>
                            <p class="card-text fs-6">{{ $book->author->name }} {{ $book->author->surname }}</p>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
@endsection
