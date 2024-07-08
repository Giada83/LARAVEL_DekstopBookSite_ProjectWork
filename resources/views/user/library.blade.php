@extends('layouts.sidebar')
@section('title', 'Library')
@section('content')

    <div class="px-3">
        {{-- WANT TO READ --}}
        <h3 class="darkgrey fw-light lib-title mb-3">Want to read</h3>
        <div class="row mb-4">
            @foreach ($wantToRead as $book)
                <div class="col-md-2">
                    <div class="card h-100">
                        @include('partials.librarycard')
                        <div class="card-footer">
                            <form action="{{ route('updateBookStatus', $book) }}" method="POST">
                                @csrf
                                <div class="dropdown">
                                    <button class="btn-fav dropdown-toggle" type="button" id="dropdownMenuButton"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        Cambia stato
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <li>
                                            <button type="submit"
                                                class="dropdown-item @if ($book->users()->where('user_id', auth()->id())->wherePivot('status', 'reading')->exists()) btn-custom @endif"
                                                name="status" value="reading">Reading</button>
                                        </li>
                                        <li>
                                            <button type="submit"
                                                class="dropdown-item @if ($book->users()->where('user_id', auth()->id())->wherePivot('status', 'read')->exists()) btn-custom @endif"
                                                name="status" value="reading">Read</button>
                                        </li>
                                    </ul>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- READING --}}
        <h3 class="darkgrey fw-light lib-title mb-3">Currently Reading</h3>
        <div class="row mb-4">
            @foreach ($reading as $book)
                <div class="col-md-2">
                    <div class="card h-100">
                        @include('partials.librarycard')
                    </div>
                </div>
            @endforeach
        </div>

        {{-- READ --}}
        <h3 class="darkgrey fw-light lib-title mb-3">Read</h3>
        <div class="row mb-4">
            @foreach ($alreadyRead as $book)
                <div class="col-md-2">
                    <div class="card h-100">
                        @include('partials.librarycard')
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
