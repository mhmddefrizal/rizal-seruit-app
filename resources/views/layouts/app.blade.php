<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('partials.head')

<body>
  <div class="lg:grid lg:grid-cols-12 lg:h-screen h-auto overflow-auto">
    <div class="lg:col-span-3">
      @include('partials.header')
      @include('partials.hits')
    </div>
    <div class="lg:col-span-9 lg:pr-3 lg:pl-5 lg:py-1 md:p-12 px-4 mt-1 pb-4 overflow-auto custom-scrollbar">
      @yield('content')
    </div>
  </div>
  @include('partials.footer')
</body>

</html>
