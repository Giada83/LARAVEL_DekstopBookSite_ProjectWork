@extends('layouts.home')

@section('title', 'Welcome')

@section('content')

    {{-- HEADER --}}
    <div class="title-section py-4">
        <div class="container">
            <div class="row d-flex align-items-end">
                <div class="col-3"><img src="{{ asset('assets/image/books.jpg') }}" alt="" class="img-fluid"></div>
                <div class="col-9">
                    <h1>Unlock the joy of reading with <u>ReadWish</u></h1>
                    </h1>
                    <h2 class="fs-5 fw-light mb-3 pink">Your gateway to a personalized reading experience!</h2>
                    <span class="rectangle">
                        <h5>Why Choose ReadWish?</h5>
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

    {{-- BOOKS --}}

    <!-- Ultimi libri inseriti -->
    <div class="container mt-4 mb-5">
        <h2 class="text-center">Recently added books</h2>
        <div class="row mt-3 justify-content-center">
            @foreach ($latestBooks as $book)
                <div class="col-md-2">
                    {{-- link --}}
                    <a href="{{ route('books.show', ['book' => $book->id]) }}" class="card-link">
                        <div class="card h-100">
                            {{-- image --}}
                            <img src="{{ $book->cover }}" class="card-img-top img-fluid" alt="cover">
                            {{-- <img src="{{ Storage::url($book->cover) }}" class="card-img-top" alt="cover"> --}}
                            <div class="card-body pt-1">
                                {{-- title --}}
                                <h5 class="card-title fw-medium m-0">{{ $book->title }}</h5>
                                {{-- author --}}
                                <p class="card-text mb-1">by <span class="fw-medium">{{ $book->author->name }}
                                        {{ $book->author->surname }}</span></p>
                                {{-- reviews --}}
                                @if ($book->reviews->count() > 0)
                                    <p class="card-text mb-1"><i class="bi bi-star-fill text-yellow"></i>
                                        {{ number_format($book->reviews->avg('rating'), 1) }}
                                        ({{ $book->reviews->count() }})</p>
                                @else
                                    <p class="card-text"><em>No reviews available</em></p>
                                @endif
                            </div>
                            {{-- categories --}}
                            <div class="card-footer">
                                @foreach ($book->categories as $category)
                                    <span class="category" style="background-color: {{ $category->color }};">
                                        {{ $category->name }}</span>
                                @endforeach
                            </div>

                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>

    {{-- Libri con votazione migliore --}}
    <div class="container mt-4 mb-5">
        <h2 class="text-center">Best rating books</h2>
        <div class="row mt-3 justify-content-center">
            @foreach ($topRatedBooks as $book)
                <div class="col-md-2">
                    {{-- link --}}
                    <a href="{{ route('books.show', ['book' => $book->id]) }}" class="card-link">
                        <div class="card h-100">
                            {{-- image --}}
                            <img src="{{ $book->cover }}" class="card-img-top img-fluid" alt="cover">
                            {{-- <img src="{{ Storage::url($book->cover) }}" class="card-img-top" alt="cover"> --}}
                            <div class="card-body pt-1">
                                {{-- title --}}
                                <h5 class="card-title fw-medium m-0">{{ $book->title }}</h5>
                                {{-- author --}}
                                <p class="card-text mb-1">by <span class="fw-medium">{{ $book->author->name }}
                                        {{ $book->author->surname }}</span></p>
                                {{-- reviews --}}
                                @if ($book->reviews->count() > 0)
                                    <p class="card-text mb-1"><i class="bi bi-star-fill text-yellow"></i>
                                        {{ number_format($book->reviews->avg('rating'), 1) }}
                                        ({{ $book->reviews->count() }})</p>
                                @else
                                    <p class="card-text"><em>No reviews available</em></p>
                                @endif
                            </div>
                            {{-- categories --}}
                            <div class="card-footer">
                                @foreach ($book->categories as $category)
                                    <span class="category" style="background-color: {{ $category->color }};">
                                        {{ $category->name }}</span>
                                @endforeach
                            </div>

                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>

@endsection
