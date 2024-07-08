@extends('layouts.sidebar')
@section('title', 'Library')
@section('content')

    <div class="px-3">
        {{-- WANT TO READ --}}
        <h3 class="darkgrey fw-light lib-title mb-3">Want to read</h3>
        <div class="row mb-5 g-2">
            @if ($wantToRead->isNotEmpty())
                @foreach ($wantToRead as $book)
                    <div class="col-md-2">
                        <div class="card h-100">
                            @include('partials.librarycard')
                            {{-- dropdown --}}
                            <div class="card-footer px-0 mt-auto">
                                <form action="{{ route('updateBookStatus', $book) }}" method="POST">
                                    @csrf
                                    <div class="dropdown-center">
                                        <button class="btn-fav dropdown-toggle px-0 w-100" type="button"
                                            id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                            Change status
                                        </button>
                                        <ul class="dropdown-menu lib-drop" aria-labelledby="dropdownMenuButton">
                                            <li>
                                                <button type="submit"
                                                    class="dropdown-item @if ($book->users()->where('user_id', auth()->id())->wherePivot('status', 'reading')->exists()) btn-custom @endif"
                                                    name="status" value="reading">Reading</button>
                                            </li>
                                            <li>
                                                <button type="submit"
                                                    class="dropdown-item @if ($book->users()->where('user_id', auth()->id())->wherePivot('status', 'already_read')->exists()) btn-custom @endif"
                                                    name="status" value="already_read">Read</button>
                                            </li>
                                        </ul>
                                    </div>
                                </form>
                                <form action="{{ route('books.removeBookStatus', $book->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="mt-1 w-100 btn-delete"
                                        onclick="return confirm('Are you sure?')">Delete
                                        status</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="col-12 col-md-6 text-left pt-2">
                    <div class="d-flex align-items-center flex-column">
                        <img src="{{ asset('assets/image/no-books.png') }}" alt="girl with book and coffe"
                            class="lib-img img-fluid">
                        <p class="p-size fw-light">No books have been added to this reading status yet</p>
                    </div>
                </div>
            @endif
        </div>

        {{-- READING --}}
        <h3 class="darkgrey fw-light lib-title mb-3">Currently Reading</h3>
        <div class="row mb-5 g-2">
            @if ($reading->isNotEmpty())
                @foreach ($reading as $book)
                    <div class="col-md-2">
                        <div class="card h-100">
                            @include('partials.librarycard')
                            {{-- dropdown --}}
                            <div class="card-footer px-0 mt-auto">
                                <form action="{{ route('updateBookStatus', $book) }}" method="POST">
                                    @csrf
                                    <div class="dropdown-center">
                                        <button class="btn-fav dropdown-toggle px-0 w-100" type="button"
                                            id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                            Change status
                                        </button>
                                        <ul class="dropdown-menu lib-drop" aria-labelledby="dropdownMenuButton">
                                            <li>
                                                <button type="submit"
                                                    class="dropdown-item @if ($book->users()->where('user_id', auth()->id())->wherePivot('status', 'want_to_read')->exists()) btn-custom @endif"
                                                    name="status" value="want_to_read">Want to read</button>
                                            </li>
                                            <li>
                                                <button type="submit"
                                                    class="dropdown-item @if ($book->users()->where('user_id', auth()->id())->wherePivot('status', 'already_read')->exists()) btn-custom @endif"
                                                    name="status" value="already_read">Read</button>
                                            </li>
                                        </ul>
                                    </div>
                                </form>
                                <form action="{{ route('books.removeBookStatus', $book->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="mt-1 w-100 btn-delete"
                                        onclick="return confirm('Are you sure?')">Delete
                                        status</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="col-12 col-md-6 text-left pt-2">
                    <div class="d-flex align-items-center flex-column">
                        <img src="{{ asset('assets/image/no-books1.png') }}" alt="girl with book and coffe"
                            class="lib-img img-fluid">
                        <p class="p-size fw-light">No books have been added to this reading status yet</p>
                    </div>
                </div>
            @endif
        </div>

        {{-- READ --}}
        <h3 class="darkgrey fw-light lib-title mb-3">Read</h3>
        <div class="row mb-4 g-2">
            @if ($alreadyRead->isNotEmpty())
                @foreach ($alreadyRead as $book)
                    <div class="col-md-2">
                        <div class="card h-100">
                            @include('partials.librarycard')
                            {{-- dropdown --}}
                            <div class="card-footer px-0 mt-auto">
                                <form action="{{ route('updateBookStatus', $book) }}" method="POST">
                                    @csrf
                                    <div class="dropdown-center">
                                        <button class="btn-fav dropdown-toggle px-0 w-100" type="button"
                                            id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                            Change status
                                        </button>
                                        <ul class="dropdown-menu lib-drop" aria-labelledby="dropdownMenuButton">
                                            <li>
                                                <button type="submit"
                                                    class="dropdown-item @if ($book->users()->where('user_id', auth()->id())->wherePivot('status', 'want_to_read')->exists()) btn-custom @endif"
                                                    name="status" value="want_to_read">Want to read</button>
                                            </li>
                                            <li>
                                                <button type="submit"
                                                    class="dropdown-item @if ($book->users()->where('user_id', auth()->id())->wherePivot('status', 'reading')->exists()) btn-custom @endif"
                                                    name="status" value="reading">Reading</button>
                                            </li>
                                        </ul>
                                    </div>
                                </form>
                                <form action="{{ route('books.removeBookStatus', $book->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="mt-1 w-100 btn-delete"
                                        onclick="return confirm('Are you sure?')">Delete
                                        status</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="col-12 col-md-6 text-left pt-2">
                    <div class="d-flex align-items-center flex-column">
                        <img src="{{ asset('assets/image/no-books2.png') }}" alt="girl with book and coffe"
                            class="lib-img img-fluid">
                        <p class="p-size fw-light">No books have been added to this reading status yet</p>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
