@extends('layouts.base')

@section('content')
    {{-- messaggio di errore  --}}
    <h1 class="mb-4">Books</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- messaggio di successo --}}
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <h1>Edit Book</h1>
    {{-- @dd($book) --}}
    <form action="{{ route('books.update', $book->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="author_id">Author</label>
            <select class="form-control select2 @error('author_id') is-invalid @enderror" id="author_id" name="author_id"
                required placeholder="Select an author">
                <option></option> <!-- empty option for placeholder -->
                @foreach ($authors as $author)
                    <option value="{{ $author->id }}"
                        {{ old('author_id', $book->author_id) == $author->id ? 'selected' : '' }}>
                        {{ $author->name }} {{ $author->surname }}
                    </option>
                @endforeach
            </select>
            @error('author_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title"
                value="{{ old('title', $book->title) }}" required>
            @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="cover">Cover</label>
            <input type="file" class="form-control-file @error('cover') is-invalid @enderror" id="cover"
                name="cover">
            @if ($book->cover)
                <img src="{{ Storage::url($book->cover) }}" alt="Book Cover" width="100">
            @else
                <p>No cover available</p>
            @endif

            @error('cover')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"
                rows="3" required>{{ old('description', $book->description) }}</textarea>
            @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="year">Year</label>
            <input type="number" class="form-control @error('year') is-invalid @enderror" id="year" name="year"
                min="1800" max="{{ date('Y') }}" value="{{ old('year', $book->year) }}" required>
            @error('year')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="language">Language</label>
            <input type="text" class="form-control @error('language') is-invalid @enderror" id="language"
                name="language" value="{{ old('language', $book->language) }}" required>
            @error('language')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="categories">Categories</label>
            <select multiple class="form-control select2 @error('categories') is-invalid @enderror" id="categories"
                name="categories[]">
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}"
                        {{ in_array($category->id, old('categories', $book->categories->pluck('id')->toArray())) ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            @error('categories')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Update Book</button>
    </form>
@endsection

{{-- script javascript --}}
@section('scripts')
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            // Imposta l'anno massimo per il campo year 
            const currentYear = new Date().getFullYear();
            document.getElementById('year').setAttribute('max', currentYear);

            //Select2 JS
            $('.select2').select2({
                placeholder: "Select an author",
                allowClear: true
            });

            //selezione multipla categorie
            $('#categories').select2({
                placeholder: 'Select categories',
                closeOnSelect: false // Opzionale: per mantenere aperta la select2 dopo ogni selezione
            });
        });
    </script>
@endsection
