@extends('layouts.admin-sidebar')
@section('title', 'Categories Table')
@section('content')
    @include('partials.admin-sidebar-nav')

    <div class="container">
        <div>
            <div class="row p-2">
                <div class="col">
                    <!-- messagi di avviso  -->
                    @include('partials.alert')

                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="fw-light darkgrey mb-2">Categories table</h5>
                        <a class="btn-add" href="{{ route('categories.create') }}">Add new category</a>
                    </div>

                    <table class="table table-custom">
                        <thead>
                            <tr>
                                <th>NAME</th>
                                <th>COLOR</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($categories as $category)
                                <tr>
                                    <td class="align-middle">
                                        <p class="mb-0">{{ $category->name }}</p>
                                    </td>
                                    <td> <span style="background-color: {{ $category->color }}; padding: 5px 10px"
                                            class="darkgrey">
                                            {{ $category->color }}
                                        </span></td>
                                    <td class="align-middle">
                                        {{-- modifica --}}
                                        <a href="{{ route('categories.edit', $category->id) }}"
                                            class="text-secondary text-decoration-none">
                                            <span class="p-size upd me-2">
                                                Edit
                                            </span>
                                        </a>
                                        {{-- cancella --}}
                                        <form id="delete-form-{{ $category->id }}"
                                            action="{{ route('categories.destroy', $category->id) }}" method="POST"
                                            style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <a href="#" class="text-decoration-none"
                                                onclick="event.preventDefault();
                                                                    if(confirm('Are you sure to delete {{ addslashes($category->name) }}?')) {
                                                                        document.getElementById('delete-form-{{ $category->id }}').submit();
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
            </div>
        </div>
    </div>
@endsection
