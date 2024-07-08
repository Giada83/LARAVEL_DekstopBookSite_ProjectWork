<div class="row ps-3 py-2 mb-3">
    <div>
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

        {{ $greeting }} {{ Auth::user()->name }}
    </div>
    <div class="col-md-4">
        <div class="purple-line"></div>
    </div>
</div>
