<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">

{{-- bootstrap --}}
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">

{{-- font --}}
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;300;400;600;700&display=swap" rel="stylesheet">

{{-- aos --}}
<link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />

<!-- Select2 JS -->
<link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('libs/select2js/select2-bootstrap-5-theme.css') }}">

<!-- JQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="{{ asset('libs/jquery/dist/jquery-3.6.3.min.js') }}"></script>

<!-- Font Awesome Icons -->
<link rel="stylesheet" href="{{ asset('fontawesome/css/fontawesome.min.css') }}">
<link rel="stylesheet" href="{{ asset('fontawesome/css/regular.min.css') }}">
<link rel="stylesheet" href="{{ asset('fontawesome/css/brands.min.css') }}">
<link rel="stylesheet" href="{{ asset('fontawesome/css/solid.min.css') }}">

@yield('style')


{{-- style custom --}}
<link rel="stylesheet" href="{{ asset('css/main/style.css') }}">
