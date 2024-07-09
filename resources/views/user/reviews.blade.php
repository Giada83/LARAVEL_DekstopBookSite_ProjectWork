@extends('layouts.sidebar')
@section('title', 'Reviews')

@section('content')
    <div class="container">
        <!-- messagi di avviso  -->
        @include('partials.alert')

        <div class="px-3">
            <h2 class="purple fw-light fav-title mb-4">Your Reviews</h2>
            <div class="row">

                @if ($reviews->isEmpty())
                    <div class="col-12 col-md-6 text-left pt-2">
                        <div class="d-flex align-items-center flex-column">
                            <img src="{{ asset('assets/image/no-reviews.png') }}" alt="book" class="lib-img img-fluid">
                            <p class="p-size fw-light">You haven't written any reviews yet</p>
                        </div>
                    </div>
                @else
                    {{-- card --}}
                    @foreach ($reviews as $review)
                        <div class="col-10 mb-4">
                            <div class="card h-100 mb-4">
                                <div class="card-body text-start  border-bottom border-2">
                                    {{-- data modifica/creazione --}}
                                    <p class="p-size-small mb-1">
                                        <small class="span-back">
                                            {{ \Carbon\Carbon::parse($review->updated_at)->isoFormat('MMMM DD, YYYY [at] HH:mm') }}
                                        </small>
                                    </p>
                                    {{-- titolo --}}
                                    <h3 class="card-title ps-0 mb-0"><a
                                            href="{{ route('books.show', ['book' => $review->book->id]) }}"
                                            class="text-decoration-none">
                                            {{ $review->book->title }}
                                        </a></h3>
                                    {{-- autore --}}
                                    <p class="card-subtitle mb-1 text-body-secondary fw-light p-size">
                                        <small> by
                                            {{ $review->book->author->name }}
                                            {{ $review->book->author->surname }}</small>

                                    </p>
                                    {{-- voto --}}
                                    <p class="card-text mb-2">
                                        @for ($i = 0; $i < $review->rating; $i++)
                                            <i class="bi bi-star-fill text-yellow"></i>
                                        @endfor
                                        @for ($i = $review->rating; $i < 5; $i++)
                                            <i class="bi bi-star text-secondary"></i>
                                        @endfor
                                    </p>
                                    {{-- recensione --}}
                                    <p class="card-text p-size-small mb-2" id="card-text"> {{ $review->review }}</p>
                                    {{-- comandi --}}
                                    <div class="d-flex">
                                        <a href="{{ route('reviews.edit', $review) }}" class="card-link btn-rev btn-sm me-2"
                                            role="button">Update</a>

                                        <form action="{{ route('reviews.destroy', $review) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-rev-del btn-sm darkgrey"
                                                onclick="return confirm('Are you sure you want to delete this review?')">
                                                Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        @endsection
