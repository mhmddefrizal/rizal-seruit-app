@extends('layouts.auth')

@section('content')
<div class="bg-white overflow-hidden shadow-sm rounded-lg">
  <div class="p-4 sm:p-6 bg-white border-b border-gray-200">
    <!-- Breadcrumb -->
    @include('components.breadcrumb', [
    'route' => 'listapp.index',
    'menu' => $apps_menu,
    'submenu' => $apps_submenu,
    ])

    <!-- Judul -->
    <h2 class="text-xl sm:text-2xl font-semibold text-gray-800 mb-4">{{ $apps_submenu }}</h2>

    <div class="mt-3 sm:mt-5 flex flex-col md:flex-row items-center md:items-start gap-4 sm:gap-6">
      <!-- Logo -->
      <div class="flex-shrink-0">
        <img src="{{ asset('img/' . $app->logo) }}" alt="Logo {{ $app->nama }}"
          class="w-28 h-28 sm:w-40 sm:h-40 object-contain border border-gray-200 rounded-lg shadow-sm">
      </div>

      <!-- Detail Info -->
      <div class="flex-1 w-full">
        <!-- Desktop: Table layout -->
        <div class="hidden sm:block overflow-x-auto mb-3">
          <table class="min-w-full border border-gray-200 rounded-lg">
            <tbody class="divide-y divide-gray-200">
              <tr>
                <td class="px-4 py-2 font-semibold text-gray-700 w-40">Nama</td>
                <td class="text-gray-500 w-4">:</td>
                <td class="px-4 py-2 text-gray-800">{{ $app->nama }}</td>
              </tr>
              <tr>
                <td class="px-4 py-2 font-semibold text-gray-700">Deskripsi Singkat</td>
                <td class="text-gray-500">:</td>
                <td class="px-4 py-2 text-gray-800">{{ $app->deskripsi }}</td>
              </tr>
              <tr>
                <td class="px-4 py-2 font-semibold text-gray-700">Detail</td>
                <td class="text-gray-500">:</td>
                <td class="px-4 py-2 text-gray-800">{{ $app->detail }}</td>
              </tr>
              <tr>
                <td class="px-4 py-2 font-semibold text-gray-700">Akses</td>
                <td class="text-gray-500">:</td>
                <td class="px-4 py-2 text-gray-800">{{ $app->akses }}</td>
              </tr>
              <tr>
                <td class="px-4 py-2 font-semibold text-gray-700">Pengguna</td>
                <td class="text-gray-500">:</td>
                <td class="px-4 py-2 text-gray-800">{{ $app->pengguna }}</td>
              </tr>
              <tr>
                <td class="px-4 py-2 font-semibold text-gray-700">Pembuat</td>
                <td class="text-gray-500">:</td>
                <td class="px-4 py-2 text-gray-800">{{ $app->pembuat }}</td>
              </tr>
              <tr>
                <td class="px-4 py-2 font-semibold text-gray-700">Link</td>
                <td class="text-gray-500">:</td>
                <td class="px-4 py-2 text-gray-800">
                  <a href="{{ $app->link }}" class="text-indigo-600 hover:underline break-all" target="_blank">
                    {{ $app->link }}
                  </a>
                </td>
              </tr>
              <tr>
                <td class="px-4 py-2 font-semibold text-gray-700">Total Hits</td>
                <td class="text-gray-500">:</td>
                <td class="px-4 py-2 text-gray-800">{{ $app->hits }}</td>
              </tr>
            </tbody>
          </table>
        </div>

        <!-- Mobile: Stacked list layout -->
        <div class="sm:hidden space-y-3">
          <div class="border-b border-gray-100 pb-2">
            <span class="block text-xs font-semibold text-gray-500 uppercase tracking-wide">Nama</span>
            <span class="block text-sm text-gray-800 mt-0.5">{{ $app->nama }}</span>
          </div>
          <div class="border-b border-gray-100 pb-2">
            <span class="block text-xs font-semibold text-gray-500 uppercase tracking-wide">Deskripsi Singkat</span>
            <span class="block text-sm text-gray-800 mt-0.5">{{ $app->deskripsi }}</span>
          </div>
          <div class="border-b border-gray-100 pb-2">
            <span class="block text-xs font-semibold text-gray-500 uppercase tracking-wide">Detail</span>
            <span class="block text-sm text-gray-800 mt-0.5">{{ $app->detail }}</span>
          </div>
          <div class="grid grid-cols-2 gap-3">
            <div class="border-b border-gray-100 pb-2">
              <span class="block text-xs font-semibold text-gray-500 uppercase tracking-wide">Akses</span>
              <span class="block text-sm text-gray-800 mt-0.5">{{ $app->akses }}</span>
            </div>
            <div class="border-b border-gray-100 pb-2">
              <span class="block text-xs font-semibold text-gray-500 uppercase tracking-wide">Hits</span>
              <span class="block text-sm text-gray-800 mt-0.5">{{ $app->hits }}</span>
            </div>
          </div>
          <div class="border-b border-gray-100 pb-2">
            <span class="block text-xs font-semibold text-gray-500 uppercase tracking-wide">Pengguna</span>
            <span class="block text-sm text-gray-800 mt-0.5">{{ $app->pengguna }}</span>
          </div>
          <div class="border-b border-gray-100 pb-2">
            <span class="block text-xs font-semibold text-gray-500 uppercase tracking-wide">Pembuat</span>
            <span class="block text-sm text-gray-800 mt-0.5">{{ $app->pembuat }}</span>
          </div>
          <div>
            <span class="block text-xs font-semibold text-gray-500 uppercase tracking-wide">Link</span>
            <a href="{{ $app->link }}" class="block text-sm text-indigo-600 hover:underline mt-0.5 break-all" target="_blank">
              {{ $app->link }}
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@push('scripts')
@endpush