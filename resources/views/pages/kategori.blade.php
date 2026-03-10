@extends('layouts.app')

@section('content')
    {{-- Search Bar --}}
    <div class="xl:relative xl:block hidden mt-2 mb-3 w-full">
        <input id="search_kategori" type="text" placeholder="Cari aplikasi.." class="w-full px-4 py-2 border border-neutral-200 rounded-lg
                         focus:outline-none focus:border-[#1ea05f98] focus:ring-1 focus:ring-[#1ea05f98]">
        <img src="{{ asset('img/search.svg') }}" alt="Search"
            class="absolute top-1/2 right-3 transform -translate-y-1/2 w-5 h-5">
    </div>

    {{-- Breadcrumb --}}
    <x-breadcrumb :route="'home'" :menu="'Beranda'" :submenu="$title" />

    {{-- Section title --}}
    <h2 class="font-bold md:text-2xl text-lg mb-4">{{ $title }}</h2>

    {{-- App Grid --}}
    <div id="app_grid" class="grid lg:grid-cols-3 md:grid-cols-3 sm:grid-cols-2 grid-cols-2 gap-4">
        @forelse ($apps as $item)
            <x-app-card :item="$item" :showPembuat="$showPembuat" />
        @empty
            <p class="text-gray-500 col-span-full">Belum ada aplikasi dalam kategori ini.</p>
        @endforelse
    </div>
@endsection