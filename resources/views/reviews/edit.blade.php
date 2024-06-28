@extends('template.base')


@section('content')
    <div class="container">
        <h1>Modifica la tua recensione</h1>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('reviews.update', $review) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="review">Recensione</label>
                <textarea name="review" id="review" class="form-control">{{ old('review', $review->review) }}</textarea>
            </div>

            <div class="form-group">
                <label for="rating">Voto</label>
                <input type="number" name="rating" id="rating" class="form-control"
                    value="{{ old('rating', $review->rating) }}" min="1" max="5">
            </div>

            <button type="submit" class="btn btn-primary">Aggiorna</button>
        </form>
    </div>
@endsection
