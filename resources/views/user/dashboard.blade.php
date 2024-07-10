@extends('layouts.sidebar')

@section('title', 'Dashboard')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h2 class="fw-light purple">Welcome to Your Dashboard</h2>

                <div class="row">
                    <div class="col-4">
                        @foreach ($user->badges as $badge)
                            <img src="{{ asset($badge->icon) }}" alt="{{ $badge->name }}" class="img-fluid">
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-md-6"></div>
        </div>
    </div>


@endsection
