@extends('template.base')

@section('content')
    <div class="container mt-5">
        <h2>Add New Book</h2>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Se c'è un messaggio di successo da visualizzare --}}
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('books.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- autore con plugin js select2 --}}
            <div class="form-group">
                <label for="author_id">Author</label>
                <select class="form-control select2" id="author_id" name="author_id" required placeholder="Select an author">
                    <option></option> <!-- empty option for placeholder -->
                    @foreach ($authors as $author)
                        <option value="{{ $author->id }}" {{ old('author_id') == $author->id ? 'selected' : '' }}>
                            {{ $author->name }} {{ $author->surname }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}"
                    required>
            </div>

            <div class="form-group">
                <label for="cover">Cover</label>
                <input type="file" class="form-control-file" id="cover" name="cover">
                @if ($errors->has('cover'))
                    <p class="text-danger">{{ $errors->first('cover') }}</p>
                @endif
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3" required>{{ old('description') }}</textarea>
            </div>

            <div class="form-group">
                <label for="year">Year</label>
                <input type="number" class="form-control" id="year" name="year" min="1800"
                    max="{{ date('Y') }}" value="{{ old('year') }}" required>
            </div>

            <div class="form-group">
                <label for="language">Language</label>
                <input type="text" class="form-control" id="language" name="language" value="{{ old('language') }}"
                    required>
            </div>

            <div class="form-group">
                <label for="categories">Categories</label>
                <select multiple class="form-control select2" id="categories" name="categories[]">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ in_array($category->id, old('categories', [])) ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
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
{{-- end script javascript --}}
