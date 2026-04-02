@extends('layouts.info')

@section('content')
<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
  <div class="p-6 bg-white border-b border-gray-200">

    <div class="mt-5 flex flex-col md:flex-row items-start gap-6">
      <!-- Logo di kiri -->
      <div class="flex-shrink-0">

        <div class="flex flex-col">
          <img src="{{ asset('img/' . $app->logo) }}" alt="Logo {{ $app->nama }}"
            class="w-40 h-40 object-contain border border-gray-200 rounded-lg shadow-sm">
          <a href="{{ $app->link }}"
            class="mt-3 mb-3 text-center px-4 py-2 bg-[#1EA05E] text-white font-semibold rounded-lg shadow-md hover:bg-[#1EA05E] focus:outline-none focus:ring-2 focus:ring-[#1EA05E] focus:ring-opacity-75">
            <i class="fa fa-globe mr-2"></i>Kunjungi
          </a>
        </div>

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
              <td class="px-4 py-2 font-semibold text-gray-700">Deskripsi</td>
              <td class="text-gray-500">:</td>
              <td class="px-4 py-2 text-gray-800 text-justify">
                {{ $validation }}
              </td>
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