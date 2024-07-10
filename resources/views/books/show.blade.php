@extends('layouts.base')

@section('title', 'Show Book Details')

@section('content')
    <div class="mt-5">
        <div class="header-section pb-1 mb-2">
            <h2 class="text-center text-white">Inside the Book</h2>
        </div>
        <div class="container">

            {{-- go back --}}
            <div class="row">
                <div class="col-md-12 text-end hover">
                    <a href="{{ url()->previous() }}" class=" link-underline link-underline-opacity-0 ">
                        <i class="bi bi-arrow-left-square"></i> Go Back
                    </a>
                </div>
            </div>

            <div class="p-4">

                {{-- @if (session('badge_message'))
                    <div class="alert alert-success">
                        {{ session('badge_message') }}
                    </div>
                @endif --}}

                {{-- messaggi di errore e successo --}}
                @include('partials.alert')
                {{-- recensione già lasciata --}}
                @if (Session::has('review_error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        You have already submitted a review for this book.
                        You can modify or delete your review from your <a href="{{ route('user.reviews') }}"
                            class="alert-link">dashboard</a>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                {{-- title --}}
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
                                <p class="card-text mt-3">
                                    @foreach ($book->categories as $category)
                                        <small class="p-1 me-1" style="background-color: {{ $category->color }};">
                                            {{ $category->name }}</small>
                                    @endforeach
                                </p>
                                <p class="card-text"><small class="text-body-secondary">Last updated
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
                                        <div class="card mb-2">
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
                                                <p class="card-text mb-1">
                                                    <small class="text-body-secondary">Reviewed on
                                                        {{ \Carbon\Carbon::parse($review->updated_at)->format('F d, Y') }}
                                                    </small>
                                                </p>
                                                {{-- commento --}}
                                                <p class="p-size-small">{{ $review->review }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="row d-flex justify-content-start ps-4">
                                    <div class="col-md-4">
                                        <img src="{{ asset('assets/image/no-reviews-yet.png') }}" class="img-fluid">
                                    </div>
                                    <p class="fs-6 fw-light mb-0 mt-1">There are no reviews for this book yet</p>
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
                    <div class="d-flex align-items-baseline">
                        <h4 class="text-dark fw-light ">Write a review</h4>
                        <div class="divider"></div>
                        <small class="mb-3 p-size-small ">Share your thoughts with other readers!</small>
                    </div>
                    {{-- utenti loggati --}}
                    @auth
                        <form method="POST" action="{{ route('reviews.store') }}">
                            @csrf
                            <input type="hidden" name="book_id" value="{{ $book->id }}">
                            <div class="form-group d-flex align-items-center">
                                <label for="rating" class="me-2">Rating:</label>
                                <div class="rating d-flex">
                                    @for ($i = 5; $i >= 1; $i--)
                                        <input type="radio" name="rating" id="rating-{{ $i }}"
                                            value="{{ $i }}">
                                        <label for="rating-{{ $i }}" class="star-label ml-1 textlab"
                                            data-value="{{ $i }}">&#9733;</label>
                                    @endfor
                                </div>
                                @error('rating')
                                    <div class="invalid-feedback d-block ml-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="review">Review:</label>
                                <textarea class="form-control @error('review') is-invalid @enderror rev-text" name="review" id="review"
                                    rows="5" maxlength="1000" placeholder="Share your thoughts about the book"></textarea>
                                @error('review')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="rev-btn mt-3">Submit review</button>
                        </form>
                    @endauth
                    {{-- utenti non loggati --}}
                    @guest
                        <p class="mt-2"><small class="fw-light">OPS! To leave a review, you must be <a
                                    href="{{ route('login') }}" class="pink">logged in</a></small></p>
                    @endguest
                </div>
            </div>
        </div>
    </div>

    {{-- visualizzazoine del badge vinto --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const badgeMessage = {!! json_encode(session('badge_message')) !!}; // Ottieni il messaggio del badge dalla sessione
            const badgeIcon = {!! json_encode(session('badge_icon')) !!}; // Ottieni l'URL dell'immagine del badge dalla sessione

            if (badgeMessage) {
                Swal.fire({
                    title: 'Congratulations!',
                    html: `<p>${badgeMessage}</p><img src="${badgeIcon}" alt="Badge Icon" style="width: 150px; height: 150px;">`,
                    icon: 'success',
                    confirmButtonText: 'OK'
                });
            }
        });
    </script>
@endsection
