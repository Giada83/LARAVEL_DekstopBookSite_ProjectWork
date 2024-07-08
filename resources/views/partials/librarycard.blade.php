{{-- image --}}
<a href="{{ route('books.show', ['book' => $book->id]) }}" class="lib-card">
    @if ($book->cover)
        @if (Storage::exists($book->cover))
            <img src="{{ Storage::url($book->cover) }}" class="card-img-top img-fluid img-card" alt="Book cover">
        @else
            <img src="{{ $book->cover }}" class="card-img-top img-fluid img-card" alt="Book cover">
        @endif
    @else
        <img src="{{ asset('assets/image/no_cover.jpg') }}" class="card-img-top img-fluid img-card" alt="cover">
    @endif

    <div class="card-body pt-1">
        {{-- title --}}
        <p class="p-size-small mb-1 pb-0">{{ $book->title }}</p>
        {{-- author --}}
        <p class="card-text mb-1 fw-light">{{ $book->author->name }}
            {{ $book->author->surname }}</p>
    </div>

</a>
