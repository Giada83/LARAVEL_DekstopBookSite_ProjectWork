<div class="row p-3 mb-2 border-bottom d-flex justify-content-between">
    <div class="col-md-6">
        @php
            $hour = date('H');
            if ($hour < 12) {
                $greeting = 'Good morning,';
            } elseif ($hour < 18) {
                $greeting = 'Good afternoon,';
            } else {
                $greeting = 'Good evening,';
            }
        @endphp

        <p class="mb-0 adm-title">
            {{ $greeting }} {{ Auth::user()->name }}</p>
    </div>
    {{-- go back --}}
    <div class="col-md-6 text-end adm-title">
        <a href="{{ url()->previous() }}" class=" link-underline link-underline-opacity-0">
            <i class="bi bi-arrow-left-square"></i> Go Back
        </a>
    </div>
</div>
