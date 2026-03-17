<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  @include('partials.head')
</head>

<body class="bg-green-100 min-h-screen flex flex-col">
  <div class="flex-grow flex items-center justify-center px-4 sm:px-6 lg:px-6">
    <div class="w-full max-w-md sm:max-w-lg rounded-2xl p-6 sm:p-6">
      @yield('content')
    </div>
  </div>

  @include('partials.footer-login')
</body>

</html>
