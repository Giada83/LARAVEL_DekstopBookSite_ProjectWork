@extends('layouts.sidebar')

@section('title', 'Dashboard')

@section('content')
    <div class="container cont-dash my-0">
        <div class="row row-dash">
            <div class="col-7 fs-4">Hi, {{ Auth::user()->name }}
                <div class="row">
                    <div class="col-7 rounded">
                        <img src="{{ asset('assets/image/readingbooks.png') }}" alt="" class="img-fluid img-dash">
                    </div>
                </div>
            </div>
            <div class="col-4 col-dash my-2">

            </div>
        </div>
    </div>

@endsection
