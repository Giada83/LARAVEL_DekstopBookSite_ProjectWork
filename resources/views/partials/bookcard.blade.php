<div class="col-md-2 mb-4">
    {{-- link --}}
    <a href="{{ route('books.show', ['book' => $book->id]) }}" class="card-link">
        <div class="card h-100">
            {{-- image --}}
            <img src="{{ $book->cover }}" class="card-img-top img-fluid" alt="cover">
            {{-- <img src="{{ Storage::url($book->cover) }}" class="card-img-top" alt="cover"> --}}
            <div class="card-body pt-1">
                {{-- title --}}
                <h5 class="card-title fw-medium m-0">{{ $book->title }}</h5>
                {{-- author --}}
                <p class="card-text mb-1">by <span class="fw-medium">{{ $book->author->name }}
                        {{ $book->author->surname }}</span></p>
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
