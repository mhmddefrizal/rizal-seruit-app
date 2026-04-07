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

{{-- Section title + Filter row --}}
<div class="flex flex-col sm:flex-row sm:justify-between gap-3 mb-4">
  <h2 class="font-bold md:text-2xl text-lg">{{ $title }}</h2>

  {{-- Akses Filter --}}
  <div class="flex items-center justify-end gap-2 w-full sm:w-auto">
    <label for="filter_akses" class="text-sm text-gray-500 font-medium whitespace-nowrap">
      <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 inline-block mr-1 -mt-0.5" viewBox="0 0 24 24" fill="none"
        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3" />
      </svg>
      Akses:
    </label>
    <select id="filter_akses" class="px-3 py-1.5 text-sm border border-neutral-200 rounded-lg bg-white text-gray-700
                       focus:outline-none focus:border-[#1ea05f98] focus:ring-1 focus:ring-[#1ea05f98]
                       cursor-pointer transition-colors duration-200">
      <option value="semua">Semua</option>
      <option value="vpn">VPN</option>
      <option value="publik">Publik</option>
    </select>
  </div>
</div>

{{-- Filter info text --}}
<p id="filter_info" class="text-xs text-gray-400 mb-3 hidden">
  <span id="filter_count"></span> aplikasi ditampilkan
</p>

{{-- App Grid --}}
<div id="app_grid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
  @forelse ($apps as $item)
  <x-app-card :item="$item" :showPembuat="$showPembuat" :borderColor="$borderColor" />
  @empty
  <p class="text-gray-500 col-span-full">Belum ada aplikasi dalam kategori ini.</p>
  @endforelse
</div>

{{-- Empty state for filter results --}}
<p id="filter_empty" class="text-gray-400 text-sm text-center py-8 hidden">
  Tidak ada aplikasi dengan akses yang dipilih.
</p>
@endsection