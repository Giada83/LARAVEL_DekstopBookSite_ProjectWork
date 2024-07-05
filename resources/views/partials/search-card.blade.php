{{-- card libri --}}
<div class="row mt-3 d-flex justify-content-center mb-3">
    @forelse ($books as $book)
        @include('partials.bookcard')
    @empty
        <div class="row d-flex justify-content-center">
            <div class="col-5 text-center bg-white rounded p-2">
                <img src="{{ asset('assets/image/no_results.jpg') }}" class="img-fluid">
                <p class="fs-3 mb-0 purple fw-semibold">No
                    Results Found</p>
                <p class="fs-6 fw-light mb-0">Explore Different Keywords</p>
            </div>
        </div>
    @endforelse
</div>


{{-- paginazione --}}
{{ $books->links() }}
