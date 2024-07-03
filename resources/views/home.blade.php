@extends('template.base')

@section('title', 'Welcome')

@section('content')
    {{-- @dd($categories) --}}

    <div class="title-section py-4">
        <div class="container">
            <div class="row d-flex align-items-end ">
                <div class="col-3"><img src="{{ asset('assets/image/books.jpg') }}" alt="" class="img-fluid"></div>
                <div class="col-9">
                    <h1>Unlock the joy of reading with Readwish</h1>
                    <p class="fs-5 fw-normal">Your gateway to a personalized reading experience!</p>
                    <span class="rectangle">
                        <h5>Why Choose Readwish?</h5>
                    </span>
                    <ul class="list-unstyled">
                        {{-- <li><i class="bi bi-dot"></i> Discover, organize, and transform your reading habits with Readwish</li> --}}
                        <li><i class="bi bi-dot"></i> Explore new genres and authors with ease</li>
                        <li><i class="bi bi-dot"></i> Leave and read reviews on books</li>
                        <li><i class="bi bi-dot"></i> Earn achievements and rewards for reaching reading milestones</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    {{-- Sezioni libri --}}
    <div class="container">
        <div class="row g-1 mt-5">
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
    </div>


@endsection
