@extends('layouts.admin-sidebar')
@section('title', 'Books Table')
@section('content')
    @include('partials.admin-sidebar-nav')

    <div class="container">
        <div>
            <div class="row p-2">
                <div class="col">
                    <!-- messagi di avviso  -->
                    @include('partials.alert')

                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="fw-light darkgrey mb-2">Books table</h5>
                        <a class="btn-add" href="{{ route('books.create') }}">Add new book</a>
                    </div>

                    <form action="{{ route('admin.books_index') }}" method="GET">
                        <input type="text" name="search" placeholder="Cerca per titolo, autore o categoria">
                        <button type="submit">Cerca</button>
                    </form>

                    <table class="table table-custom">
                        <thead>
                            {{-- <tr>
                                <th><span class="d-none">Cover</span></th>
                                <th>AUTHOR</th>
                                <th>TITLE</th>
                                <th>YEAR</th>
                                <th>LANGUAGE</th>
                                <th>TAGS</th>
                                <th></th>
                            </tr> --}}
                            <tr>
                                <th><span class="d-none">Cover</span></th>
                                <th>
                                    <a href="{{ route('admin.books_index', ['sort' => 'surname', 'order' => $sort == 'surname' && $order == 'asc' ? 'desc' : 'asc', 'search' => request('search')]) }}"
                                        class="text-decoration-none">
                                        Cognome Autore
                                        @if ($sort == 'surname')
                                            <i
                                                class="bi {{ $order == 'asc' ? 'bi-caret-up-fill' : 'bi-caret-down-fill' }}"></i>
                                        @else
                                            <i class="bi bi-caret-down-fill"></i>
                                        @endif
                                    </a>
                                </th>
                                <th>
                                    <a href="{{ route('admin.books_index', ['sort' => 'title', 'order' => $sort == 'title' && $order == 'asc' ? 'desc' : 'asc', 'search' => request('search')]) }}"
                                        class="text-decoration-none">
                                        Titolo
                                        @if ($sort == 'title')
                                            <i
                                                class="bi {{ $order == 'asc' ? 'bi-caret-up-fill' : 'bi-caret-down-fill' }}"></i>
                                        @else
                                            <i class="bi bi-caret-down-fill"></i>
                                        @endif
                                    </a>
                                </th>

                                <th>
                                    <a href="{{ route('admin.books_index', ['sort' => 'year', 'order' => $sort == 'year' && $order == 'asc' ? 'desc' : 'asc', 'search' => request('search')]) }}"
                                        class="text-decoration-none">
                                        Anno
                                        @if ($sort == 'year')
                                            <i
                                                class="bi {{ $order == 'asc' ? 'bi-caret-up-fill' : 'bi-caret-down-fill' }}"></i>
                                        @else
                                            <i class="bi bi-caret-down-fill"></i>
                                        @endif
                                    </a>
                                </th>
                                <th>
                                    <a href="{{ route('admin.books_index', ['sort' => 'language', 'order' => $sort == 'language' && $order == 'asc' ? 'desc' : 'asc', 'search' => request('search')]) }}"
                                        class="text-decoration-none">
                                        Lingua
                                        @if ($sort == 'language')
                                            <i
                                                class="bi {{ $order == 'asc' ? 'bi-caret-up-fill' : 'bi-caret-down-fill' }}"></i>
                                        @else
                                            <i class="bi bi-caret-down-fill"></i>
                                        @endif
                                    </a>
                                </th>
                                <th>
                                    <a href="{{ route('admin.books_index', ['sort' => 'category', 'order' => $sort == 'category' && $order == 'asc' ? 'desc' : 'asc', 'search' => request('search')]) }}"
                                        class="text-decoration-none">
                                        Categoria
                                        @if ($sort == 'category')
                                            <i
                                                class="bi {{ $order == 'asc' ? 'bi-caret-up-fill' : 'bi-caret-down-fill' }}"></i>
                                        @else
                                            <i class="bi bi-caret-down-fill"></i>
                                        @endif
                                    </a>
                                </th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($books as $book)
                                <tr>
                                    <td class="tab-img align-middle">
                                        @if ($book->cover)
                                            @if (Storage::exists($book->cover))
                                                <img src="{{ Storage::url($book->cover) }}" class="img-fluid rounded"
                                                    alt="Book cover">
                                            @else
                                                <img src="{{ $book->cover }}" class="img-fluid rounded" alt="Book cover">
                                            @endif
                                        @else
                                            <img src="{{ asset('assets/image/no_cover.jpg') }}" class="img-fluid rounded"
                                                alt="default cover">
                                        @endif
                                    </td>
                                    <td>
                                        <p class="mb-0">{{ $book->author->name }}</p>
                                        <p class="mb-0">{{ $book->author->surname }}</p>
                                    </td>
                                    <td class="align-middle">
                                        <a href="{{ route('books.show', ['book' => $book->id]) }}"
                                            class="text-decoration-none">
                                            <p class="fst-italic ">{{ Str::limit($book->title, 100) }}</p>
                                        </a>
                                    </td>
                                    <td class="align-middle">{{ $book->year }}</td>
                                    <td class="align-middle">{{ $book->language }}</td>
                                    <td class="align-middle">
                                        @foreach ($book->categories as $category)
                                            {{ $category->name }}@if (!$loop->last)
                                                ,
                                            @endif
                                        @endforeach
                                    </td>


                                    <td class="align-middle">
                                        {{-- modifica --}}
                                        <a href="{{ route('books.edit', $book->id) }}"
                                            class="text-secondary text-decoration-none">
                                            <span class="p-size upd me-2">
                                                Edit
                                            </span>
                                        </a>
                                        {{-- cancella --}}
                                        <form id="delete-form-{{ $book->id }}"
                                            action="{{ route('books.destroy', $book->id) }}" method="POST"
                                            style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <a href="#" class="text-decoration-none"
                                                onclick="event.preventDefault();
                                                                    if(confirm('Are you sure to delete the book: {{ addslashes($book->title) }} with id {{ $book->id }}?')) {
                                                                        document.getElementById('delete-form-{{ $book->id }}').submit();
                                                                    }">
                                                <span class="p-size del">
                                                    Delete
                                                </span>
                                            </a>
                                        </form>
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{ $books->appends(['sort' => $sort, 'order' => $order, 'search' => request('search')])->links() }}
                </div>
                {{-- paginazione
                <span class="mt-2">{{ $books->links() }}</span> --}}
            </div>
        </div>
    </div>
@endsection
