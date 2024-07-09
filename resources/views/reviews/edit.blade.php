@extends('layouts.sidebar')
@section('title', 'Edit Reviews')

@section('content')
    <div class="container">

        <div class="px-3 mb-5 mt-4">
            <h2 class="fw-light fav-title edit mb-0">Edit Book Reviews</h2>
            {{-- go back --}}
            <div class="mb-4">
                <a href="{{ route('user.reviews') }}" class=" link-underline link-underline-opacity-0">
                    <small class="text-secondary"> <i class="bi bi-arrow-left"></i> Go Back</small>
                </a>
            </div>

            <div class="row">
                <div class="col-md-8">
                    <!-- messagi di avviso  -->
                    @include('partials.alert')

                    <form action="{{ route('reviews.update', $review) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="review">Edit review text</label>
                            <textarea name="review" id="review" class="form-control p-size">{{ old('review', $review->review) }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="rating">Rating</label><br>
                            @for ($i = 1; $i <= 5; $i++)
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="rating"
                                        id="rating{{ $i }}" value="{{ $i }}"
                                        {{ $review->rating == $i ? 'checked' : '' }}>
                                    <label class="form-check-label rounded-circle"
                                        for="rating{{ $i }}">{{ $i }}</label>
                                </div>
                            @endfor
                        </div>

                        <button type="submit" class="btn-form">Update</button>
                    </form>
                </div>
            </div>
        @endsection
