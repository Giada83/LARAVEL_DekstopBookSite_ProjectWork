<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha384-KyZXEAg3QhqLMpG8r+alFV4vnOO+hccYF9PwOm9AEVZJ0LgYWDvHf3/ls++2D2uW" crossorigin="anonymous">
</script>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>

<!-- Select2 JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"
    integrity="sha512-Y4jU4Jq9ROBnq3wdg01GT0A31FgzWhsXpjjxwVEc4RS1vcmx8Zm3lFkhJ4Hc7L9NwobE4/HGjLeWSO8mW1x4AQ=="
    crossorigin="anonymous"></script>

<!-- Script personalizzato -->
<script src="{{ asset('assets/js/main.js') }}"></script>

{{-- sweetalert --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

{{-- Additional scripts --}}
@yield('scripts')
