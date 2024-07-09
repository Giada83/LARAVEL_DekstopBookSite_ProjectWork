<div class="header-section">
    <div class="container">
        <div class="row mt-5">
            {{-- colonna sinistra --}}
            <div class="col-md-6 header-text mt-4 text-white">
                {{-- testo --}}
                <p class="pt-2">Expand your mind, reading a book</p>
                <p>Reading books is a wonderful way to spend your time.
                    Create an account and start building your personal library.
                    Make a wishlist, organize your reading schedule, and earn achievements.
                </p>

                {{-- barra di ricerca --}}
                <div class="mt-4">
                    <form action="{{ route('books.search') }}" method="GET" class="form">
                        <button type="submit">
                            <svg width="20" height="19" fill="none" xmlns="http://www.w3.org/2000/svg"
                                role="img" aria-labelledby="search">
                                <path
                                    d="M7.667 12.667A5.333 5.333 0 107.667 2a5.333 5.333 0 000 10.667zM14.334 14l-2.9-2.9"
                                    stroke="currentColor" stroke-width="1.333" stroke-linecap="round"
                                    stroke-linejoin="round"></path>
                            </svg>
                        </button>
                        <input class="searchformbar" name="search" placeholder="Search books or authors" required=""
                            type="text">
                        <button class="reset" type="reset">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </form>
                </div>

                {{-- Bottoni --}}
                <div class="mt-4">
                    @guest
                        <button class="button">
                            <a href="{{ route('register') }}" type="button"><span class="button-content fw-normal">Join for
                                    free</span></a>
                        </button>
                    @endguest
                    @auth
                        <button class="button" onclick="window.location.href='{{ route('register') }}'">
                            <a href="{{ route('dashboard') }}"><span class="button-content fw-normal">Dashboard</a>
                        </button>
                    @endauth
                    <button class="button yellow ms-3"><a href="{{ route('books.index') }}"><span
                                class="button-content fw-normal">Browse
                                book</span></a>
                    </button>
                </div>
            </div>

            {{-- colonna destra --}}
            <div class="col-md-6">
                <div>
                    <img src="{{ asset('assets/image/bookheader.png') }}" alt="woman that read a book"
                        class="img-fluid">
                </div>
            </div>
        </div>
    </div>
</div>
