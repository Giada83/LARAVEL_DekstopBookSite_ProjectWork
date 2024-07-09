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
                    {{-- form --}}
                    <form action="{{ route('books.update', $book->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        @include('books.partials.form-update')
                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection

{{-- script javascript --}}
@section('scripts')
    @include('books.partials.script')
@endsection
