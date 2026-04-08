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
      <div class="mt-3 sm:mt-5">
        <form action="{{ route('listapp.store') }}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="md:col-span-2">
              <label class="block text-sm sm:text-base text-gray-700 font-medium mb-1">Nama</label>
              <input type="text" name="nama" id="nama"
                class="w-full p-2 sm:p-2.5 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm sm:text-base">
            </div>
            <div class="md:col-span-2">
              <label class="block text-sm sm:text-base text-gray-700 font-medium mb-1">Deskripsi Singkat</label>
              <textarea id="deskripsi" name="deskripsi"
                class="w-full p-2 sm:p-2.5 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm sm:text-base" rows="2"></textarea>
            </div>
            <div class="md:col-span-2">
              <label class="block text-sm sm:text-base text-gray-700 font-medium mb-1">Deskripsi Panjang (Ambil narasi di aplikasi)</label>
              <textarea id="detail" name="detail"
                class="w-full p-2 sm:p-2.5 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm sm:text-base" rows="5"></textarea>
            </div>
            <div>
              <label class="block text-sm sm:text-base text-gray-700 font-medium mb-1">Akses</label>
              <select name="akses" id="akses"
                class="w-full p-2 sm:p-2.5 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm sm:text-base">
                <option value="none">Pilih Akses</option>
                <option value="vpn">VPN</option>
                <option value="publik">Publik</option>
              </select>
            </div>
            <div>
              <label class="block text-sm sm:text-base text-gray-700 font-medium mb-1">Pengguna</label>
              <select name="pengguna" id="pengguna"
                class="w-full p-2 sm:p-2.5 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm sm:text-base">
                <option value="none">Pilih Pengguna</option>
                <option value="BPS Selindo">BPS Selindo</option>
                <option value="BPS Provinsi saja">BPS Provinsi saja</option>
                <option value="BPS Provinsi dan BPS Kab/Kota">BPS Provinsi dan BPS Kab/Kota</option>
                <option value="BPS Kab/Kota saja">BPS Kab/Kota saja</option>
                <option value="Lainnya">Lainnya</option>
              </select>
            </div>
            <div>
              <label class="block text-sm sm:text-base text-gray-700 font-medium mb-1">Pembuat</label>
              <select name="pembuat" id="pembuat"
                class="w-full p-2 sm:p-2.5 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm sm:text-base">
                <option value="none">Pilih Pembuat</option>
                <option value="BPS RI">BPS RI</option>
                <option value="BPS Provinsi Lampung">BPS Provinsi Lampung</option>
                <option value="BPS Kabupaten/Kota">BPS Kabupaten/Kota</option>
                <option value="KLDI">K/L/D/I</option>
              </select>
            </div>
            <div>
              <label class="block text-sm sm:text-base text-gray-700 font-medium mb-1">Link</label>
              <input type="url" id="link" name="link"
                class="w-full p-2 sm:p-2.5 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm sm:text-base">
            </div>
            <div class="md:col-span-2">
              <label class="block text-sm sm:text-base text-gray-700 font-medium mb-1">Logo (Default: logo_bps.png)</label>
              <input type="file" name="logo" id="logo"
                class="w-full p-2 border border-gray-300 rounded-md file:mr-3 file:py-1.5 file:px-3 sm:file:py-2 sm:file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 text-sm">
            </div>
          </div>
          <div class="flex flex-col-reverse sm:flex-row sm:justify-end gap-2 sm:gap-0 pt-4 mt-4 border-t">
            <a href="{{ route('listapp.index') }}" type="button"
              class="px-4 py-2.5 sm:py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 text-center text-sm sm:text-base sm:mr-2">Kembali</a>
            <button type="submit" class="px-4 py-2.5 sm:py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 text-sm sm:text-base">Simpan</button>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection

@push('scripts')
@endpush
