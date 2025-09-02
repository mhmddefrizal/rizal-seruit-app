<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ config('app.name', 'SERUIT-BPS') }}</title>
  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
  <script async src="https://www.googletagmanager.com/gtag/js?id=G-002CQCMVP4"></script>

  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="shortcut icon" href="img/logo_bps.png" type="image/x-icon">

  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <link href="{{ asset('css/override.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="/css/carousel.css">
</head>
