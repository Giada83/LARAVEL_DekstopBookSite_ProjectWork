@extends('layouts.admin-sidebar')
@section('title', 'Edit Author')
@section('content')
    @include('partials.admin-sidebar-nav')

    <div class="container">
        <div class="px-3 mb-5 mt-4">
            <h2 class="fw-light fav-title edit mb-3">Edit an author</h2>

            <div class="row">
                <div class="col-md-8">
                    <!-- messagi di avviso  -->
                    @include('partials.alert')
                    {{-- form --}}
                    <form action="{{ route('authors.update', $author->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name"
                                value="{{ old('name') ?? ($author->name ?? '') }}" required>
                            @if ($errors->has('name'))
                                <p class="text-danger">{{ $errors->first('name') }}</p>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="surname">Surname</label>
                            <input type="text" class="form-control" id="surname" name="surname"
                                value="{{ old('surname') ?? ($author->surname ?? '') }}" required>
                            @if ($errors->has('surname'))
                                <p class="text-danger">{{ $errors->first('surname') }}</p>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="image">image</label>
                            <input type="file" class="form-control-file" id="image" name="image">
                            @if ($errors->has('image'))
                                <p class="text-danger">{{ $errors->first('image') }}</p>
                            @endif
                            <small class="form-text text-muted p-size-small">
                                The addition of a profile image is not mandatory.
                            </small>
                            @if (isset($author) && $author->image)
                                <div class="preview-container" id="preview-container">
                                    <img id="cover-preview" src="{{ asset('storage/images/' . $author->image) }}"
                                        alt="Image Preview">
                                    <button type="button" class="remove-btn" id="remove-btn">Remove</button>
                                </div>
                            @else
                                <div class="preview-container" id="preview-container" style="display:none;">
                                    <img id="cover-preview" src="#" alt="image preview">
                                    <button type="button" class="remove-btn" id="remove-btn">Remove</button>
                                </div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="nationality">Nationality</label>
                            <input type="text" class="form-control" id="nationality" name="nationality"
                                value="{{ old('nationality') ?? ($author->nationality ?? '') }}">
                            @if ($errors->has('nationality'))
                                <p class="text-danger">{{ $errors->first('nationality') }}</p>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="year_born">Year of birth</label>
                            <input type="number" class="form-control" id="year_born" name="year_born"
                                value="{{ old('year_born') ?? ($author->year_born ?? '') }}" min="1800"
                                max="{{ date('Y') }}">
                            @if ($errors->has('year_born'))
                                <p class="text-danger">{{ $errors->first('year_born') }}</p>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="year_die">Year of death</label>
                            <input type="number" class="form-control" id="year_die" name="year_die"
                                value="{{ old('year_die') ?? ($author->year_die ?? '') }}" min="1850"
                                max="{{ date('Y') }}">
                            @if ($errors->has('year_die'))
                                <p class="text-danger">{{ $errors->first('year_die') }}</p>
                            @endif
                        </div>

                        <button type="submit" class="btn-form">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

{{-- script javascript --}}
@include('authors.partials.script')
