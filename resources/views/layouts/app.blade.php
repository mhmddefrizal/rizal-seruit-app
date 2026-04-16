<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('partials.head')

<body class="overflow-x-hidden">
    {{-- Green desktop header removed — red header now shows at all screen sizes --}}

    @php
        $contentShellClass = 'w-full max-w-[1600px] 2xl:max-w-[1720px] mx-auto min-w-0 px-4 sm:px-6 lg:px-8 xl:px-10';
    @endphp
    <!-- <div class="max-w-screen-xl mt-6 mb-4 pt-8"> -->
    <div class="h-auto overflow-y-auto overflow-x-hidden">
        <div class="{{ $contentShellClass }} mt-4 pb-4 overflow-y-auto overflow-x-hidden custom-scrollbar">
            @include('partials.search')

            {{-- Search results (hidden by default, shown when searching) --}}
            <div id="search-results" class="hidden">
                <div class="mb-4">
                    <h2 class="text-lg font-bold text-gray-800 flex items-center gap-2">
                        <span class="w-1 h-5 rounded-full inline-block"></span>
                        Hasil Pencarian
                    </h2>
                    <p id="search-info" class="text-xs text-gray-400 mt-0.5 ml-3"></p>
                </div>
                <div id="search-results-grid"
                    class="grid 2xl:grid-cols-5 xl:grid-cols-4 lg:grid-cols-4 md:grid-cols-3 sm:grid-cols-2 grid-cols-1 gap-4">
                </div>
            </div>

            <div id="main-content">
                @yield('content')
            </div>
        </div>
        <div class="min-w-0">
            @include('partials.header')

            <div class="{{ $contentShellClass }}">
                <div class="hits-offset">
                    @include('partials.hits')
                </div>
            </div>
        </div>
    </div>
    <!-- </div> -->
    @include('partials.confirm-modal')
    @include('partials.footer')
</body>

</html>
