@extends('layouts.admin-sidebar')
@section('title', 'Add Category')
@section('content')
    @include('partials.admin-sidebar-nav')

    <div class="container">
        <div class="px-3 mb-5 mt-4">
            <h2 class="fw-light fav-title edit mb-3">Add a new category</h2>

            <div class="row">
                <div class="col-md-8">
                    <!-- messagi di avviso  -->
                    @include('partials.alert')
                    {{-- form --}}
                    <form action="{{ route('categories.store') }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name"
                                value="{{ old('name') }}" required>
                            @if ($errors->has('name'))
                                <p class="text-danger">{{ $errors->first('name') }}</p>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="color">Color piker
                                <p class="m-0 p-size-small">
                                    <small class="fw-light text-secondary">
                                        Choose a color in the box and click 'Ok'
                                    </small>
                                </p>
                            </label>
                            <input type="color" id="color" name="color" class="form-control form-control-color">
                        </div>

                        <button type="submit" class="btn-form">Submit</button>
                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection
