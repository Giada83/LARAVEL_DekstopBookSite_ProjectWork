@extends('layouts.home')

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

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Id</th>
                <th>Author</th>
                <th>Title</th>
                <th>Cover</th>
                <th>Description</th>
                <th>Year</th>
                <th>Language</th>
                <th>Categories</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($books as $book)
                <tr>
                    <td>{{ $book->id }}</td>
                    <td>{{ ucfirst(substr($book->author->name, 0, 1)) }}. {{ $book->author->surname }}</td>
                    <td>{{ Str::limit($book->title, 20) }}</td>
                    <td>
                        @if ($book->cover)
                            {{-- Se $book->cover è un URL di un'immagine --}}
                            @if (filter_var($book->cover, FILTER_VALIDATE_URL))
                                <img src="{{ $book->cover }}" alt="Cover Image" style="width: 50px;">
                            @else
                                {{-- Se $book->cover è un percorso nel filesystem --}}
                                <img src="{{ Storage::url($book->cover) }}" alt="{{ $book->title }}" style="width: 50px;">
                            @endif
                        @else
                            <span>No cover found</span>
                        @endif
                    </td>
                    <td>{{ Str::limit($book->description, 20) }}</td>
                    <td>{{ $book->year }}</td>
                    <td>{{ $book->language }}</td>
                    <td>
                        @foreach ($book->categories as $category)
                            {{ $category->name }}@if (!$loop->last)
                                ,
                            @endif
                        @endforeach
                    </td>
                    <td>
                        <a href="{{ route('books.edit', $book->id) }}" class="btn btn-sm btn-primary">Edit</a>
                        <form action="{{ route('books.destroy', $book->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger"
                                onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
