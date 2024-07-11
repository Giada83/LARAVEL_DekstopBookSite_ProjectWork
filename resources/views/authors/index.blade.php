@extends('layouts.admin-sidebar')
@section('title', 'Author Table')
@section('content')
    @include('partials.admin-sidebar-nav')

    <div class="container">
        <div>
            <div class="row p-2">
                <div class="col">
                    <!-- messagi di avviso  -->
                    @include('partials.alert')

                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="fw-light darkgrey mb-2">Authors table</h5>
                        <a class="btn-add" href="{{ route('authors.create') }}">Add new author</a>
                    </div>

                    <table class="table table-custom">
                        <thead>

                            <th><span class="d-none">Image</span></th>
                            <th>NAME</th>
                            <th>SURNAME</th>
                            <th>NATIONALITY</th>
                            <th>BORN</th>
                            <th>DIED</th>
                            <th></th>

                        </thead>
                        <tbody>
                            @foreach ($authors as $author)
                                <tr>
                                    <td class="tab-img align-middle">
                                        @if ($author->image)
                                            @if (Storage::exists($author->image))
                                                <img src="{{ Storage::url($author->image) }}" class="img-fluid rounded"
                                                    alt="Author profile">
                                            @else
                                                <img src="{{ $author->image }}" class="img-fluid rounded"
                                                    alt="Author profile">
                                            @endif
                                        @endif
                                    </td>
                                    <td class="align-middle">
                                        <p class="mb-0">{{ $author->name }}</p>

                                    </td>
                                    <td class="align-middle">
                                        <p class="mb-0">{{ $author->surname }}</p>
                                    </td>
                                    <td class="align-middle">{{ $author->nationality }}</td>
                                    <td class="align-middle">{{ $author->year_born }}</td>
                                    <td class="align-middle">{{ $author->year_die }}</td>

                                    <td class="align-middle">
                                        {{-- modifica --}}
                                        <a href="{{ route('authors.edit', $author->id) }}"
                                            class="text-secondary text-decoration-none">
                                            <span class="p-size upd me-2">
                                                Edit
                                            </span>
                                        </a>
                                        {{-- cancella --}}
                                        <form id="delete-form-{{ $author->id }}"
                                            action="{{ route('authors.destroy', $author->id) }}" method="POST"
                                            style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <a href="#" class="text-decoration-none"
                                                onclick="event.preventDefault();
                                                                    if(confirm('Are you sure to delete {{ addslashes($author->name) }} {{ $author->surname }}?')) {
                                                                        document.getElementById('delete-form-{{ $author->id }}').submit();
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
                </div>
                {{-- paginazione --}}
                <span class="mt-2">{{ $authors->links() }}</span>
            </div>
        </div>
    </div>
@endsection
