<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SERUIT-BPS | Information</title>
  @vite('resources/css/app.css')
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="shortcut icon" href="{{ asset('img/logo_bps.png') }}" type="image/x-icon">
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <link href="{{ asset('css/datatables.min.css') }}" rel="stylesheet">
  <!-- Font Awesome untuk Ikon -->
  <link rel="stylesheet" href="{{ asset('css/all.min.css') }}">
</head>

<body class="bg-gray-100 font-sans">

  <div class="min-h-screen">

    <!-- Konten Utama -->
    <main class="py-10">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        @yield('content')
      </div>
    </main>
  </div>

</body>

</html>
