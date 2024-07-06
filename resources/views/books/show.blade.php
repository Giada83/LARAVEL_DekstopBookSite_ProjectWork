@extends('layouts.base')

@section('title', 'Show Book Details')

@section('content')
    <div class="mt-5">
        <div class="header-section pb-1 mb-2">
            <h2 class="text-center text-white">Inside the Book</h2>
        </div>
        <div class="container">

            <div class="p-4">
                <h3 class="fw-light mb-0">{{ $book->title }}</h3>

                {{-- stelle recensioni --}}
                <div class="review-summary mb-3">
                    @if ($book->reviews->count() > 0)
                        @php
                            $averageRating = $book->reviews->avg('rating');
                            $fullStars = floor($averageRating); // Numero di stelle piene
                            $hasHalfStar = $averageRating - $fullStars >= 0.5; // Indica se c'è una stella a metà
                        @endphp
                        <p class="card-text mb-1 star-ratings">
                            @for ($i = 1; $i <= 5; $i++)
                                @if ($i <= $fullStars)
                                    <i class="bi bi-star-fill"></i> <!-- Stelle piene -->
                                @elseif ($i == $fullStars + 1 && $hasHalfStar)
                                    <i class="bi bi-star-half"></i> <!-- Stelle a metà -->
                                @else
                                    <i class="bi bi-star"></i> <!-- Stelle vuote -->
                                @endif
                            @endfor
                            <span class="ms-1 fs-6 fw-normal">{{ number_format($averageRating, 1) }}</span>
                            <span class="p-size fw-light"> - {{ $book->reviews->count() }} reviews</span>
                        </p>
                    @else
                        <p class="card-text mb-1 star-ratings">
                            @for ($i = 1; $i <= 5; $i++)
                                <i class="bi bi-star"></i>
                            @endfor
                            <em>No reviews available</em>
                        </p>
                    @endif
                </div>

                {{-- card --}}
                <div class="card mb-4">
                    <div class="row g-0 ">
                        <div class="col-md-3 max me-3">
                            {{-- image --}}
                            <div class="img-box outline">
                                @if ($book->cover)
                                    @if (Storage::exists($book->cover))
                                        <img src="{{ Storage::url($book->cover) }}" class="card-img-top img-fluid img-show"
                                            alt="Book cover">
                                    @else
                                        <img src="{{ $book->cover }}" class="card-img-top img-fluid img-show"
                                            alt="Book cover">
                                    @endif
                                @else
                                    <img src="{{ asset('assets/image/no_cover.jpg') }}"
                                        class="card-img-top img-fluid img-show" alt="default cover">
                                @endif
                            </div>
                        </div>

                        <div class="col-md-7">
                            <div class="card-body show-card">
                                <p class="card-title p-0 pb-2"><span class="fw-light">Author:</span>
                                    {{ $book->author->name }}
                                    {{ $book->author->surname }}</p>
                                <p>{{ $book->description }}</p>
                                <p class="p-size mb-1"><span class="fw-light">Published in</span> {{ $book->year }}
                                </p>
                                <p class="p-size mb-1"><span class="fw-light">Language</span>: {{ $book->language }}
                                </p>
                                <p class="card-text pt-3"><small class="text-body-secondary">Last updated
                                        {{ \Carbon\Carbon::parse($book->updated_at)->format('d-m-Y') }}</small></p>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- fine card --}}

                {{-- preferiti e stato di lettura --}}
                <div class="d-flex mb-3">
                    {{-- pulsante preferiti --}}
                    <div class="me-3">
                        @if ($book->users()->where('user_id', auth()->id())->wherePivot('is_favorite', true)->exists())
                            <form action="{{ route('books.removeFromFavorites', $book) }}" method="POST"
                                style="display: inline;">
                                @csrf
                                <button type="submit" class="favorite-btn">
                                    <i class="bi bi-heart-fill pink"></i>
                                    <span class="ms-2 fw-normal">Added to Favorites</span>
                                </button>
                            </form>
                        @else
                            <form action="{{ route('books.addToFavorites', $book) }}" method="POST"
                                style="display: inline;">
                                @csrf
                                <button type="submit" class="favorite-btn">
                                    <i class="bi bi-heart pink"></i>
                                    <span class="ms-2 fw-normal">Add to Favorites</span>
                                </button>
                            </form>
                        @endif
                    </div>

                    {{-- stato di lettura --}}
                    <div>
                        <form action="{{ route('updateBookStatus', $book) }}" method="POST">
                            @csrf
                            <div class="btn-group" role="group" aria-label="Stato di lettura">
                                <button type="submit"
                                    class="btn custom-btn @if ($book->users()->where('user_id', auth()->id())->wherePivot('status', 'want_to_read')->exists()) btn-custom @endif"
                                    name="status" value="want_to_read">Want to read</button>
                                <button type="submit"
                                    class="btn custom-btn @if ($book->users()->where('user_id', auth()->id())->wherePivot('status', 'reading')->exists()) btn-custom @endif"
                                    name="status" value="reading">Now Reading</button>
                                <button type="submit"
                                    class="btn custom-btn @if ($book->users()->where('user_id', auth()->id())->wherePivot('status', 'already_read')->exists()) btn-custom @endif"
                                    name="status" value="already_read">Already Read</button>
                            </div>
                        </form>
                    </div>
                </div>

                {{-- fine container --}}
            </div>
        </div>

        {{-- recensioni --}}
        <div class="title-section">
            <div class="container ">
                <div class="row p-4">
                    <div class="col-10">
                        <h4 class="text-dark mb-3 fw-light">Reviews</h4>
                        <div class="row">
                            @if ($reviews->count() > 0)
                                @foreach ($reviews as $review)
                                    <div class="col-10">
                                        <div class="card mb-4">
                                            <div class="card-body text-start">
                                                {{-- user --}}
                                                <div class="card-title d-flex align-items-center mb-0 p-0">
                                                    <div class="rev-img me-2">
                                                        <img src="{{ $review->user->image_profile }}" alt="image profile">
                                                    </div>
                                                    <div>{{ $review->user->name }}</div>
                                                </div>
                                                {{-- stelle --}}
                                                <div class="star-ratings">
                                                    <p class="card-text">
                                                        @php
                                                            $rating = $review->rating; // Voto della recensione
                                                            $maxRating = 5; // Numero massimo di stelle
                                                        @endphp

                                                        @for ($i = 1; $i <= $maxRating; $i++)
                                                            @if ($i <= $rating)
                                                                <i class="bi bi-star-fill"></i>
                                                                <!-- Stelle piene -->
                                                            @else
                                                                <i class="bi bi-star"></i>
                                                                <!-- Stelle vuote -->
                                                            @endif
                                                        @endfor
                                                    </p>
                                                </div>
                                                {{-- data recensione --}}
                                                <p class="card-subtitle">
                                                    <small class="text-body-secondary">Reviewed on
                                                        {{ \Carbon\Carbon::parse($review->updated_at)->format('F d, Y') }}
                                                    </small>
                                                </p>
                                                {{-- commento --}}
                                                <p class="card-text">{{ $review->review }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="col-12">
                                    <p class="card-subtitle">There are no reviews for this book yet</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- lasciare una recensione --}}
        <div class="mb-5">
            <div class="container">
                <div class="row ps-4 pt-3">
                    <h5 class="text-dark mb-3 fw-light">Leave a review</h5>
                    {{-- bottone per utenti loggati --}}
                    @auth
                        <div class="mt-4">
                            {{-- <form method="POST" action="{{ route('reviews.store') }}">
                                @csrf
                                <input type="hidden" name="book_id" value="{{ $book->id }}">
                                <div>
                                    <label for="rating">Rating (da 1 a 5):</label>
                                    <input type="number" name="rating" id="rating" min="1" max="5"
                                        required>
                                </div>
                                <div>
                                    <label for="review">Recensione:</label>
                                    <textarea name="review" id="review" rows="5" maxlength="1000" required></textarea>
                                </div>
                                <button type="submit">Invia recensione</button>
                            </form> --}}
                            <form method="POST" action="{{ route('reviews.store') }}">
                                @csrf
                                <input type="hidden" name="book_id" value="{{ $book->id }}">
                                <input type="hidden" name="rating" id="rating" value="0">
                                <div>
                                    <label for="rating">Rating (da 1 a 5):</label>
                                    <div class="stars">
                                        <i class="bi bi-star star" data-value="1"></i>
                                        <i class="bi bi-star star" data-value="2"></i>
                                        <i class="bi bi-star star" data-value="3"></i>
                                        <i class="bi bi-star star" data-value="4"></i>
                                        <i class="bi bi-star star" data-value="5"></i>
                                    </div>
                                </div>
                                <div>
                                    <label for="review">Recensione:</label>
                                    <textarea name="review" id="review" rows="5" maxlength="1000" required></textarea>
                                </div>
                                <button type="submit">Invia recensione</button>
                            </form>
                        </div>
                    @endauth
                    {{-- utenti non loggati --}}
                    @guest
                        <p><small class="fw-light">OPS! To leave a review, you must be <a href="{{ route('login') }}"
                                    class="pink">logged in</a></small></p>
                    @endguest
                </div>
            </div>
        </div>
    </div>







    {{-- Form per le recensioni --}}
    {{-- Bottone per lasciare una recensione --}}
    {{-- @auth
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
    @endauth --}}

    @guest
        {{-- <p class="mt-4">Per lasciare una recensione devi effettuare l'accesso.</p> --}}
    @endguest

@endsection
