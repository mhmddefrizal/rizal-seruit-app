<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('partials.head')

<body class="overflow-x-hidden">
    {{-- Green desktop header removed — red header now shows at all screen sizes --}}

    <!-- <div class="max-w-screen-xl mt-6 mb-4 pt-8"> -->
    <div class="xl:grid xl:grid-cols-12 xl:h-[calc(100vh-72px)] h-auto overflow-y-auto overflow-x-hidden">
        <div
            class="xl:col-span-8 min-w-0 xl:pr-4 xl:pl-5 xl:py-1 px-4 mt-4 pb-4 overflow-y-auto overflow-x-hidden custom-scrollbar">
            @include('partials.search')

            {{-- Search results (hidden by default, shown when searching) --}}
            <div id="search-results" class="hidden">
                <div class="mb-4">
                    <h2 class="text-lg font-bold text-gray-800 flex items-center gap-2">
                        <span class="w-1 h-5 bg-[#1EA05E] rounded-full inline-block"></span>
                        Hasil Pencarian
                    </h2>
                    <p id="search-info" class="text-xs text-gray-400 mt-0.5 ml-3"></p>
                </div>
                <div id="search-results-grid"
                    class="grid lg:grid-cols-3 md:grid-cols-3 sm:grid-cols-2 grid-cols-2 gap-4">
                </div>
            </div>

            <div id="main-content">
                @yield('content')
            </div>
        </div>
        <div class="xl:col-span-4 min-w-0 xl:overflow-hidden">
            @include('partials.header')
            <div class="hits-offset">
                @include('partials.hits')
            </div>
        </div>
    </div>
    <!-- </div> -->
    @include('partials.confirm-modal')
    @include('partials.footer')
</body>

</html>
