@extends('template.base')

@section('content')
    <div class="container">
        <h1>Ciao Le tue recensioni</h1>

        {{-- Se c'è un messaggio di successo da visualizzare --}}
        @if (session('updRev_success'))
            <div class="alert alert-success">
                {{ session('updRev_success') }}
            </div>
        @endif

        @if ($reviews->isEmpty())
            <p>Non hai ancora scritto nessuna recensione.</p>
        @else
            <ul>
                @foreach ($reviews as $review)
                    <li>
                        <p><strong>Libro:</strong> {{ $review->book->id }}</p>
                        <p><strong>Recensione:</strong> {{ $review->review }}</p>
                        <p><strong>Voto:</strong> {{ $review->rating }}</p>
                        <p><strong>Data della recensione:</strong> {{ $review->created_at->format('d/m/Y H:i') }}</p>
                    </li>

                    <a href="{{ route('reviews.edit', $review) }}">Modifica</a>
                    <form action="{{ route('reviews.destroy', $review) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Elimina</button>
                    </form>

                    <hr>
                @endforeach
            </ul>
        @endif
    </div>
@endsection
