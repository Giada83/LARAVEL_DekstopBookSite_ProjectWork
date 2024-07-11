@extends('layouts.admin-sidebar')
@section('title', 'Edit Category')
@section('content')
    @include('partials.admin-sidebar-nav')

    <div class="container">
        <div class="px-3 mb-5 mt-4">
            <h2 class="fw-light fav-title edit mb-3">Edit a category</h2>
            <div class="row">
                <div class="col-md-8">
                    <!-- messagi di avviso  -->
                    @include('partials.alert')
                    {{-- form --}}
                    <form action="{{ route('categories.update', $category->id) }}" method="POST"
                        id="editCategoryForm-{{ $category->id }}">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="name-{{ $category->id }}">Name:</label>
                            <input type="text" id="name-{{ $category->id }}" name="name" class="form-control"
                                value="{{ $category->name }}" required>
                        </div>

                        <div class="form-group">
                            <label for="color-{{ $category->id }}">Color piker
                                <p class="m-0 p-size-small">
                                    <small class="fw-light text-secondary">
                                        Choose a color in the box and click 'Ok'
                                    </small>
                                </p>
                            </label>
                            <input type="color" id="color-{{ $category->id }}" name="color"
                                class="form-control form-control-color" value="{{ $category->color }}">
                        </div>
                        <button type="submit" class="btn-form">Submit</button>
                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection
<div>
    <!-- It is not the man who has too little, but the man who craves more, that is poor. - Seneca -->
</div>
