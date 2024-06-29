@extends('template.base')

@section('content')
    <div class="container">
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

        {{-- Se c'è un messaggio di successo da visualizzare --}}
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
                        <td>{{ Str::limit($book->description, 20) }}</td>
                        <td>
                            @if ($book->cover)
                                <img src="{{ $book->cover }}" alt="no cover found" style="width: 50px;">
                                {{-- <img src="{{ Storage::url($book->cover) }}" alt="{{ $book->title }}" style="width: 50px;"> --}}
                            @endif
                        </td>
                        <td>{{ Str::limit($book->description, 50) }}</td>
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
    </div>
@endsection
