@extends('layouts.base')

@section('title', 'BooksList')

@section('content')

    <div class="mt-5">
        <div class="header-section pb-2 mb-4">
            <h2 class="text-center text-white">Explore the Library</h2>
        </div>
        <div class="container">

            <form action="{{ route('books.index') }}" method="GET" class="d-flex justify-content-between align-items-center"
                role="search">
                {{-- Gruppo 1: Ricerca --}}
                <div class="d-flex">
                    <div class="search-wrapper">
                        <input class="input" type="text" name="search" id="search" value="{{ request('search') }}"
                            placeholder="Search by title or author" id="clearSearch">
                        <i class="bi bi-x clear-icon"></i>
                    </div>
                </div>

                {{-- Gruppo 2: Filtri e Pulsanti --}}
                <div class="d-flex">
                    {{-- Filtri --}}
                    <div class="d-flex align-items-center">

                        <span class="sort">Sort by:</span>
                        <select class="form-select" name="sort" id="sort">
                            <option selected ="title_asc" {{ request('sort') == 'title_asc' ? 'selected' : '' }}>Title:
                                A-Z
                            </option>
                            <option value="title_desc" {{ request('sort') == 'title_desc' ? 'selected' : '' }}>Title:
                                Z-A
                            </option>
                            <option value="recent" {{ request('sort') == 'recent' ? 'selected' : '' }}>Latest books
                            </option>
                            <option value="best_reviews" {{ request('sort') == 'best_reviews' ? 'selected' : '' }}>Best
                                reviews
                            </option>
                        </select>

                        <span class="sort">Filter by:</span>
                        <select class="form-select" name="category" id="sort">
                            <option value="">All Categories</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ request('category') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>

                    </div>

                    {{-- Pulsanti --}}
                    <div>
                        <button type="submit" class="btn-index"><i class="bi bi-search text-yellow"></i></button>
                        <button type="button" onclick="resetForm()" class="btn-index purple"><i
                                class="bi bi-x-circle"></i></button>
                    </div>
                </div>
            </form>

            {{-- card libri e paginazione --}}
            @include('partials.search-card')
        </div>
    </div>
@endsection
