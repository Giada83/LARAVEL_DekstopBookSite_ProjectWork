@extends('layouts.sidebar')

@section('title', 'Dashboard')

@section('content')
    <div class="container">
        <div class="row justify-content-around">
            <h2 class="fw-light purple ms-3">Welcome to Your Dashboard!</h2>
            <div class="col-md-6 title-section rounded p-3">
                <div class="row">
                    <h6 class="mb-3">Achievements</h6>
                    @if ($user->badges->isEmpty())
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="col-md-5">
                                <img src="{{ asset('assets/image/achievement.png') }}" alt="peoples with books"
                                    class="img-fluid">
                            </div>
                            <div class="col-md-6">
                                <p class="p-size-small m-0">You haven't earned any badges or achievements yet</p>
                                <p class="p-sizevm-0 purple">Discover them all!</p>
                            </div>
                        </div>
                    @else
                        @foreach ($user->badges as $badge)
                            <div class="col-md-4 badge-img">
                                <img src="{{ asset($badge->icon) }}" alt="{{ $badge->name }}" class="img-fluid">
                                <p><small class="text-secondary fw-light">{{ $badge->name }}</small></p>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
            <div class="col-md-5 rounded p-3 dash-col">
                <div class="row">
                    <h6 class="mb-3">Profile</h6>
                    <div class="dash-img-profile text-center">
                        <img src="{{ Auth::user()->image_profile ? asset(Auth::user()->image_profile) : asset('assets/image/default-img-profile.png') }}"
                            alt="image profile" class="img-fluid">
                        <p>{{ Auth::user()->name }}</p>
                        <p>{{ Auth::user()->email }}</p>
                        <p><i class="bi bi-cake2"></i> Joined on {{ Auth::user()->created_at->format('j F Y') }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-3 justify-content-center mx-2">
            <div class="col-md-12 dash-col1 rounded p-3 pb-0">
                <h6 class="mb-3">Our Recommendation for You</h6>
                <div class="row d-flex mt-3 justify-content-center">
                    @foreach ($randomBooks as $book)
                        @include('partials.bookcard')
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
