@extends('layouts.admin-sidebar')
@section('title', 'Books Table')
@section('content')
    @include('partials.admin-sidebar-nav')

    <div class="container">
        <div class="px-3 mb-5 mt-4">
            <h2 class="fw-light fav-title edit mb-3">Add a new book</h2>

            <div class="row">
                <div class="col-md-8">
                    <!-- messagi di avviso  -->
                    @include('partials.alert')

                    <form action="{{ route('books.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        {{-- autore con plugin js select2 --}}
                        <div class="form-group">
                            <label for="author_id">Author</label>
                            <select class="form-control select2" id="author_id" name="author_id" required
                                placeholder="Select an author">
                                <option></option> <!-- empty option for placeholder -->
                                @foreach ($authors as $author)
                                    <option value="{{ $author->id }}"
                                        {{ old('author_id') == $author->id ? 'selected' : '' }}>
                                        {{ $author->name }} {{ $author->surname }}
                                    </option>
                                @endforeach
                            </select>
                            @if ($errors->has('author_id'))
                                <p class="text-danger">{{ $errors->first('author_id') }}</p>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" id="title" name="title"
                                value="{{ old('title') }}" required>
                            @if ($errors->has('title'))
                                <p class="text-danger">{{ $errors->first('title') }}</p>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="cover">Cover</label>
                            <input type="file" class="form-control-file" id="cover" name="cover">
                            @if ($errors->has('cover'))
                                <p class="text-danger">{{ $errors->first('cover') }}</p>
                            @endif
                            <small class="form-text text-muted p-size-small">
                                The addition of a book cover is not mandatory.
                            </small>
                            <div class="preview-container" id="preview-container" style="display:none;">
                                <img id="cover-preview" src="#" alt="Cover Preview">
                                <button type="button" class="remove-btn" id="remove-btn">Remove</button>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control text-font" id="description" name="description" rows="3"
                                placeholder="Please enter a text containing a minimum of 150 characters and a maximum of 1000 characters" required>{{ old('description') }}</textarea>
                            @if ($errors->has('description'))
                                <p class="text-danger">{{ $errors->first('description') }}</p>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="year">Year</label>
                            <input type="number" class="form-control" id="year" name="year" min="1800"
                                max="{{ date('Y') }}" value="{{ old('year') }}" required>
                            @if ($errors->has('year'))
                                <p class="text-danger">{{ $errors->first('year') }}</p>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="language">Language</label>
                            <input type="text" class="form-control" id="language" name="language"
                                value="{{ old('language') }}" required>
                            @if ($errors->has('language'))
                                <p class="text-danger">{{ $errors->first('language') }}</p>
                            @endif
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
                            @if ($errors->has('categories'))
                                <p class="text-danger">{{ $errors->first('categories') }}</p>
                            @endif
                        </div>

                        <button type="submit" class="btn-form">Submit</button>
                    </form>
                </div>
            </div>
        </div>

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

        // Finestra anteprima immagini
        document.addEventListener("DOMContentLoaded", function() {
            const coverInput = document.getElementById("cover");
            const previewContainer = document.getElementById("preview-container");
            const coverPreview = document.getElementById("cover-preview");
            const removeBtn = document.getElementById("remove-btn");

            coverInput.addEventListener("change", function() {
                const file = this.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        coverPreview.src = e.target.result;
                        previewContainer.style.display = "block";
                    }
                    reader.readAsDataURL(file);
                } else {
                    previewContainer.style.display = "none";
                }
            });

            removeBtn.addEventListener("click", function() {
                coverInput.value = "";
                coverPreview.src = "#";
                previewContainer.style.display = "none";
            });
        });
    </script>
@endsection
{{-- end script javascript --}}
