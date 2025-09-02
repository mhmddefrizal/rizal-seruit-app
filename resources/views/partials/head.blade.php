<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ config('app.name', 'SERUIT-BPS') }}</title>
  @vite('resources/css/app.css')

  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="shortcut icon" href="{{ asset('img/logo_bps.png') }}" type="image/x-icon">

  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <link href="{{ asset('css/override.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/carousel.css') }}">

  @stack('styles')
</head>
