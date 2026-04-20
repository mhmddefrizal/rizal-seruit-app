<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>{{ config('app.name', 'SERUIT-BPS') }}{{ isset($title) ? ' | ' . $title : '' }}</title>
{{-- Google Fonts: Plus Jakarta Sans --}}
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap"
    rel="stylesheet">

{{-- Load CSS & JS utama (hasil npm run build) --}}
@vite(['resources/css/app.css', 'resources/js/app.js'])

<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="icon" type="image/png"
    href="{{ asset('img/logo_bps_0.png') }}?v={{ filemtime(public_path('img/logo_bps_0.png')) }}">

<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<link href="{{ asset('css/override.css') }}" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/carousel.css') }}">

@stack('styles')
