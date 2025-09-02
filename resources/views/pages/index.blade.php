@extends('layouts.app')

@section('content')
  <div class="lg:block hidden bg-[#1EA05E] text-white rounded-lg py-1">
    <h3 class="text-4xl font-bold text-center">SERUIT</h3><br>
    <p class="-mt-5 text-lg text-center">Satu Ruang Informasi untuk Inovasi Terintegrasi</p>
  </div>

  <div class="lg:relative lg:block hidden mt-4 mb-3 w-full">
    <input id="search_0" type="text" placeholder="Cari aplikasi.."
      class="w-full px-4 py-2 border border-neutral-200 rounded-lg
             focus:outline-none focus:border-[#1ea05f98] focus:ring-1 focus:ring-[#1ea05f98]">
    <img src="/img/search.svg" alt="Search" class="absolute top-1/2 right-3 transform -translate-y-1/2 w-5 h-5">
  </div>

  {{-- Bagian BPS RI --}}
  <div class="">
    <div class="flex items-center justify-between rounded-lg pt-1 ">
      <h3 class="font-semibold md:text-xl text-base mb-2">BPS RI</h3>
      <button id="toggle-chevron" class="focus:outline-none">
        <svg class="w-6 h-6 chevron chevron-down" fill="none" stroke="currentColor" viewBox="0 0 24 24"
          xmlns="http://www.w3.org/2000/svg">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
        </svg>
      </button>
    </div>
    <p id="res_bps_ri"></p>
    <div id="bps_ri"
      class="grid lg:grid-cols-5 md:grid-cols-4 sm:grid-cols-3 grid-cols-2 gap-2
                          custom-scrollbar transition-max-height duration-500 ease-in-out">
      @foreach ($list_bps_ri as $item)
        <div class="rounded-lg border border-neutral-200 p-2 hit-button" data-id={{ $item->id }}>
          <a href="{{ $item->link }}" target="_blank">
            <div class="flex flex-row justify-between items-center">
              <img src="img/{{ $item->logo }}" alt="" class="rounded-lg h-12">
              <span
                class="{{ $item->akses == 'publik' ? 'border-[#43a4d4]' : 'border-[#e7a861]' }}
                           border text-black rounded-xl text-[10px] flex items-center justify-center px-2">
                {{ $item->akses }}
              </span>
            </div>
            <div class="flex flex-row justify-between items-center">
              <p class="mt-4 text-base font-semibold">{{ $item->nama }}</p>
              <p class="mt-4 text-xs text-gray-500 w-1/4">
                Hits: <span id="hits-count-{{ $item->id }}">{{ $item->hits }}</span>
              </p>
            </div>
            <p class="text-sm text-gray-500">{{ $item->deskripsi }}</p>
          </a>
        </div>
      @endforeach
    </div>
  </div>

  {{-- Bagian BPS Provinsi Lampung --}}
  <div class="my-3">
    <div class="flex items-center justify-between rounded-lg pt-1 mb-1">
      <h3 class="font-semibold md:text-xl text-base mb-2">BPS PROVINSI LAMPUNG</h3>
      <button id="toggle-chevron-lampung" class="focus:outline-none">
        <svg class="w-6 h-6 chevron chevron-down" fill="none" stroke="currentColor" viewBox="0 0 24 24"
          xmlns="http://www.w3.org/2000/svg">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
        </svg>
      </button>
    </div>
    <p id="res_bps_lampung"></p>
    <div id="bps_lampung"
      class="grid lg:grid-cols-5 md:grid-cols-4 sm:grid-cols-3 grid-cols-2 gap-2
                                custom-scrollbar transition-max-height duration-500 ease-in-out">
      @foreach ($list_bps_lampung as $item)
        <div class="rounded-lg border border-neutral-200 p-2 hit-button" data-id={{ $item->id }}>
          <a href="{{ $item->link }}" target="_blank">
            <div class="flex flex-row justify-between items-center">
              <img src="img/{{ $item->logo }}" alt="" class="rounded-lg h-10">
              <span
                class="{{ $item->akses == 'publik' ? 'border-[#43a4d4]' : 'border-[#e7a861]' }}
                           border text-black rounded-xl text-[10px] flex items-center justify-center px-2">
                {{ $item->akses }}
              </span>
            </div>
            <div class="flex flex-row justify-between items-center">
              <p class="mt-4 text-base font-semibold">{{ $item->nama }}</p>
              <p class="mt-4 text-xs text-gray-500 w-1/4">
                Hits: <span id="hits-count-{{ $item->id }}">{{ $item->hits }}</span>
              </p>
            </div>
            <p class="text-sm text-gray-500">{{ $item->deskripsi }}</p>
          </a>
        </div>
      @endforeach
    </div>
  </div>

  {{-- Bagian BPS Kabupaten/Kota --}}
  <div class="">
    <div class="flex items-center justify-between pt-1 mb-1">
      <h3 class="font-semibold md:text-xl text-base mb-2">BPS KABUPATEN/KOTA SE-PROVINSI LAMPUNG</h3>
      <button id="toggle-chevron-kab" class="focus:outline-none">
        <svg class="w-6 h-6 chevron chevron-up" fill="none" stroke="currentColor" viewBox="0 0 24 24"
          xmlns="http://www.w3.org/2000/svg">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
        </svg>
      </button>
    </div>
    <p id="res_bps_kabkota"></p>
    <div id="bps_kabkota"
      class="grid lg:grid-cols-5 md:grid-cols-4 sm:grid-cols-3 grid-cols-2 gap-2
                                custom-scrollbar max-height-full transition-max-height duration-500 ease-in-out">
      @foreach ($list_bps_kabkota as $item)
        <div class="rounded-lg border border-neutral-200 p-2 hit-button" data-id={{ $item->id }}>
          <a href="{{ $item->link }}" target="_blank">
            <div class="flex flex-row justify-between items-center mb-2">
              <img src="img/{{ $item->logo }}" alt="" class="rounded-lg h-10">
              <span
                class="{{ $item->akses == 'publik' ? 'border-[#43a4d4]' : 'border-[#e7a861]' }}
                           border text-black rounded-xl text-[10px] flex items-center justify-center px-2">
                {{ $item->akses }}
              </span>
            </div>
            <span class="bg-[#1EA05E] text-white rounded-xl text-[10px] px-2">{{ $item->pembuat }}</span>
            <div class="flex flex-row justify-between items-center">
              <p class="text-base font-semibold">{{ $item->nama }}</p>
              <p class="mt-4 text-xs text-gray-500 w-1/4">
                Hits: <span id="hits-count-{{ $item->id }}">{{ $item->hits }}</span>
              </p>
            </div>
            <p class="text-sm text-gray-500">{{ $item->deskripsi }}</p>
          </a>
        </div>
      @endforeach
    </div>
  </div>
@endsection
