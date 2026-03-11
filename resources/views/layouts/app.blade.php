<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('partials.head')

<body>
    {{-- Full-width desktop header --}}
    <div class="xl:block hidden bg-[#1EA05E] text-white py-3 px-6">
        <div class="flex items-center justify-center gap-4">
            <img src="{{ asset('img/logo_bps.png') }}" alt="Logo BPS" class="h-12">
            <div class="text-center">
                <h3 class="text-4xl font-bold"><a href="{{ route('home') }}">SERUIT</a></h3>
                <p class="text-lg -mt-1">Satu Ruang Informasi untuk Inovasi Terintegrasi</p>
            </div>
        </div>
    </div>

    <!-- <div class="max-w-screen-xl mt-6 mb-4 pt-8"> -->
    <div class=" xl:grid xl:grid-cols-12 xl:h-[calc(100vh-72px)] h-auto overflow-auto">
        <div class="xl:col-span-8 xl:pr-4 xl:pl-5 xl:py-1 md:p-12 px-4 mt-4 pb-4 overflow-auto custom-scrollbar">
            @include('partials.search')
            @yield('content')
        </div>
        <div class="xl:col-span-4 xl:overflow-hidden">
            @include('partials.header')
            @include('partials.hits')
        </div>
    </div>
    <!-- </div> -->
    @include('partials.footer')
</body>

</html>
