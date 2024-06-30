@extends('template.base')

@section('title', 'Welcome')

@section('content')
    <h1>
        WELCOME</h1>
    {{-- @dd($categories) --}}


    <div class="row g-1">
        @foreach ($books as $book)
            <div class="col-2">
                <a href="{{ route('books.show', ['book' => $book->id]) }}" class="card-link">
                    <div class="card">
                        <img src="{{ $book->cover }}" class="card-img-top" alt="cover">
                        {{-- <img src="{{ Storage::url($book->cover) }}" class="card-img-top" alt="cover"> --}}
                        <div class="card-body">
                            <p class="card-title">Id: {{ $book->id }}</p>
                            <p class="card-title fw-semibold">{{ $book->title }}</p>
                            <p class="card-text">By: {{ $book->author->name }} {{ $book->author->surname }}</p>
                            <p class="card-text">
                                Category: @foreach ($book->categories as $category)
                                    {{ $category->name }}
                                    @unless ($loop->last)
                                        ,
                                    @endunless
                                @endforeach
                            </p>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
@endsection
