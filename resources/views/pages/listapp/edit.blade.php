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
      <div class="mt-5">
        <form action="{{ route('listapp.update', $app->slug) }}" method="POST" enctype="multipart/form-data">
          @csrf
          @method('PUT')
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="md:col-span-2">
              <label class="block text-gray-700">Nama</label>
              <input type="text" name="nama" id="nama"
                class="w-full mt-1 p-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                value="{{ old('nama', $app->nama) }}">
            </div>
            <div class="md:col-span-2">
              <label class="block text-gray-700">Deskripsi</label>
              <textarea id="deskripsi" name="deskripsi"
                class="w-full mt-1 p-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" rows="3">{{ old('deskripsi', $app->deskripsi) }}</textarea>
            </div>
            <div>
              <label class="block text-gray-700">Akses</label>
              <select name="akses" id="akses"
                class="w-full mt-1 p-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="none" {{ $app->akses == 'none' ? 'selected' : '' }}>Pilih Akses</option>
                <option value="vpn" {{ $app->akses == 'vpn' ? 'selected' : '' }}>VPN</option>
                <option value="publik" {{ $app->akses == 'publik' ? 'selected' : '' }}>Publik</option>
              </select>
            </div>
            <div>
              <label class="block text-gray-700">Pengguna</label>
              <select name="pengguna" id="pengguna"
                class="w-full mt-1 p-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="none" {{ $app->pengguna == 'none' ? 'selected' : '' }}>Pilih Pengguna</option>
                <option value="BPS Selindo" {{ $app->pengguna == 'BPS Selindo' ? 'selected' : '' }}>BPS Selindo</option>
                <option value="BPS Provinsi saja" {{ $app->pengguna == 'BPS Provinsi saja' ? 'selected' : '' }}>BPS
                  Provinsi saja</option>
                <option value="BPS Provinsi dan BPS Kab/Kota"
                  {{ $app->pengguna == 'BPS Provinsi dan BPS Kab/Kota' ? 'selected' : '' }}>BPS Provinsi dan BPS Kab/Kota
                </option>
                <option value="BPS Kab/Kota saja" {{ $app->pengguna == 'BPS Kab/Kota saja' ? 'selected' : '' }}>BPS
                  Kab/Kota saja</option>
                <option value="Lainnya" {{ $app->pengguna == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
              </select>
            </div>
            <div>
              <label class="block text-gray-700">Pembuat</label>
              <select name="pembuat" id="pembuat"
                class="w-full mt-1 p-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="none" {{ $app->pembuat == 'none' ? 'selected' : '' }}>Pilih Pembuat</option>
                <option value="BPS RI" {{ $app->pembuat == 'BPS RI' ? 'selected' : '' }}>BPS RI</option>
                <option value="BPS Provinsi Lampung" {{ $app->pembuat == 'BPS Provinsi Lampung' ? 'selected' : '' }}>BPS
                  Provinsi Lampung</option>
                <option value="BPS Kabupaten/Kota" {{ $app->pembuat == 'BPS Kabupaten/Kota' ? 'selected' : '' }}>BPS
                  Kabupaten/Kota
                </option>
                <option value="KLDI" {{ $app->pembuat == 'KLDI' ? 'selected' : '' }}>K/L/D/I
                </option>
              </select>
            </div>
            <div>
              <label class="block text-gray-700">Link</label>
              <input type="url" id="link" name="link"
                class="w-full mt-1 p-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                value="{{ old('link', $app->link) }}">
            </div>
            <div class="md:col-span-2">
              <label for="logo" class="block text-gray-700">Logo (Default: logo_bps.png)</label>
              <input type="file" name="logo" id="logo"
                class="w-full mt-1 p-2 border rounded-md
               file:mr-4 file:py-2 file:px-4
               file:rounded-md file:border-0
               file:text-sm file:font-semibold
               file:bg-blue-50 file:text-blue-700
               hover:file:bg-blue-100">

              {{-- Preview logo sekarang --}}
              @if ($app->logo)
                <div class="mt-3">
                  <p class="text-sm text-gray-600">Logo saat ini:</p>
                  <img src="{{ asset('img/' . $app->logo) }}" alt="Logo Aplikasi" class="h-16 mt-1 border rounded-md">
                </div>
              @else
                <div class="mt-3">
                  <p class="text-sm text-gray-600">Logo default digunakan:</p>
                  <img src="{{ asset('img/logo_bps.png') }}" alt="Default Logo" class="h-16 mt-1 border rounded-md">
                </div>
              @endif
            </div>
          </div>
          <div class="flex justify-end pt-4 mt-4 border-t">
            <a href="{{ route('listapp.index') }}" type="button"
              class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 mr-2">Kembali</a>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Perbarui</button>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection

@push('scripts')
@endpush
