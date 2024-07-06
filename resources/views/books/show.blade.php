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
                        <div class="col-md-3 max me-2">
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

                <div class="d-flex">
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
                        {{-- <form action="{{ route('updateBookStatus', $book) }}" method="POST">
                            @csrf
                            <div class="btn-group" role="group" aria-label="Stato di lettura">
                                <button type="submit" class="btn @if ($book->users()->where('user_id', auth()->id())->wherePivot('status', 'want_to_read')->exists()) btn-primary @endif"
                                    name="status" value="want_to_read">Want to read</button>
                                <button type="submit" class="btn @if ($book->users()->where('user_id', auth()->id())->wherePivot('status', 'reading')->exists()) btn-primary @endif"
                                    name="status" value="reading">Now Reading</button>
                                <button type="submit" class="btn @if ($book->users()->where('user_id', auth()->id())->wherePivot('status', 'already_read')->exists()) btn-primary @endif"
                                    name="status" value="already_read">Already Read</button>
                            </div>
                        </form> --}}
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

            </div>
        </div>

    </div>




    {{-- <h2 class="mt-3">Recensioni</h2>
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
    </div> --}}
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
