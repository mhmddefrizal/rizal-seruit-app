@extends('layouts.auth')

@section('content')
<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
  <div class="p-6 bg-white border-b border-gray-200">
    <!-- Breadcrumb -->
    @include('components.breadcrumb', [
    'route' => 'listapp.index',
    'menu' => $apps_menu,
    'submenu' => $apps_submenu,
    ])

    <!-- Judul -->
    <h2 class="text-2xl font-semibold text-gray-800 mb-4">{{ $apps_submenu }}</h2>

    <div class="mt-5 flex flex-col md:flex-row items-start gap-6">
      <!-- Logo di kiri -->
      <div class="flex-shrink-0">
        <img src="{{ asset('img/' . $app->logo) }}" alt="Logo {{ $app->nama }}"
          class="w-40 h-40 object-contain border border-gray-200 rounded-lg shadow-sm">
      </div>

      <!-- Deskripsi di kanan -->
      <div class="flex-1 overflow-x-auto mb-3">
        <table class="min-w-full border border-gray-200 rounded-lg">
          <tbody class="divide-y divide-gray-200">
            <tr>
              <td class="px-4 py-2 font-semibold text-gray-700 w-40">Nama</td>
              <td class="text-gray-500">:</td>
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
                <a href="{{ $app->link }}" class="text-indigo-600 hover:underline" target="_blank">
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
    </div>
  </div>
</div>
@endsection

@push('scripts')
@endpush