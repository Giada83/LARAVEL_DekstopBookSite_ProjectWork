{{-- image --}}
<a href="{{ route('books.show', ['book' => $book->id]) }}">
    @if ($book->cover)
        @if (Storage::exists($book->cover))
            <img src="{{ Storage::url($book->cover) }}" class="card-img-top img-fluid img-card" alt="Book cover">
        @else
            <img src="{{ $book->cover }}" class="card-img-top img-fluid img-card" alt="Book cover">
        @endif
    @else
        <img src="{{ asset('assets/image/no_cover.jpg') }}" class="card-img-top img-fluid img-card" alt="cover">
    @endif
</a>
<div class="card-body pt-1" class="card-img-top img-fluid" alt="Book cover of '{{ $book->title }}'">
    {{-- title --}}
    <p class="p-size-small m-0 p-0">{{ $book->title }}</p>
    {{-- author --}}
    <p class="card-text mb-1 fw-light">{{ $book->author->name }}
        {{ $book->author->surname }}</p>
</div>
{{-- <div class="card-footer border-top">
                <form action="{{ route('updateBookStatus', $book) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn-fav" @if ($book->users()->where('user_id', auth()->id())->wherePivot('status', 'reading')->exists()) btn-custom @endif"
                        name="status" value="reading">Reading</button>

                    <button type="submit" class="btn-fav" @if ($book->users()->where('user_id', auth()->id())->wherePivot('status', 'already_read')->exists()) btn-custom @endif"
                        name="status" value="already_read">Read</button>
                </form>
            </div> --}}
