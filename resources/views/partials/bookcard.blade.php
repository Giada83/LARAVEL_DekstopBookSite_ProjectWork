<div class="col-md-2 mb-4">
    {{-- link --}}
    <a href="{{ route('books.show', ['book' => $book->id]) }}" class="card-link">
        <div class="card h-100">

            {{-- image --}}
            @if ($book->cover)
                @if (Storage::exists($book->cover))
                    <img src="{{ Storage::url($book->cover) }}" class="card-img-top img-fluid img-card" alt="Book cover">
                @else
                    <img src="{{ $book->cover }}" class="card-img-top img-fluid img-card" alt="Book cover">
                @endif
            @else
                <img src="{{ asset('assets/image/no_cover.jpg') }}" class="card-img-top img-fluid img-card"
                    alt="default cover">
            @endif

            <div class="card-body pt-1" class="card-img-top img-fluid" alt="Book cover of '{{ $book->title }}'">
                {{-- title --}}
                <h5 class="card-title fw-medium m-0">{{ $book->title }}</h5>
                {{-- author --}}
                <p class="card-text mb-1"><span class="fw-light">by</span> {{ $book->author->name }}
                    {{ $book->author->surname }}</p>
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
