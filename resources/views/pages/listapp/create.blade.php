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
        <form action="{{ route('listapp.store') }}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="md:col-span-2">
              <label class="block text-gray-700">Nama</label>
              <input type="text" name="nama" id="nama"
                class="w-full mt-1 p-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div class="md:col-span-2">
              <label class="block text-gray-700">Deskripsi</label>
              <textarea id="deskripsi" name="deskripsi"
                class="w-full mt-1 p-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" rows="3"></textarea>
            </div>
            <div>
              <label class="block text-gray-700">Akses</label>
              <select name="akses" id="akses"
                class="w-full mt-1 p-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="none">Pilih Akses</option>
                <option value="vpn">VPN</option>
                <option value="publik">Publik</option>
              </select>
            </div>
            <div>
              <label class="block text-gray-700">Pengguna</label>
              <select name="pengguna" id="pengguna"
                class="w-full mt-1 p-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="none">Pilih Pengguna</option>
                <option value="BPS Selindo">BPS Selindo</option>
                <option value="BPS Provinsi saja">BPS Provinsi saja</option>
                <option value="BPS Provinsi dan BPS Kab/Kota">BPS Provinsi dan BPS Kab/Kota</option>
                <option value="BPS Kab/Kota saja">BPS Kab/Kota saja</option>
                <option value="Lainnya">Lainnya</option>
              </select>
            </div>
            <div>
              <label class="block text-gray-700">Pembuat</label>
              <select name="pembuat" id="pembuat"
                class="w-full mt-1 p-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="none">Pilih Pembuat</option>
                <option value="BPS RI">BPS RI</option>
                <option value="BPS Provinsi Lampung">BPS Provinsi Lampung</option>
                <option value="BPS Kabupaten/Kota">BPS Kabupaten/Kota</option>
                <option value="KLDI">K/L/D/I</option>
              </select>
            </div>
            <div>
              <label class="block text-gray-700">Link</label>
              <input type="url" id="link" name="link"
                class="w-full mt-1 p-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div class="md:col-span-2">
              <label class="block text-gray-700">Logo (Default: logo_bps.png)</label>
              <input type="file" name="logo" id="logo"
                class="w-full mt-1 p-2 border rounded-md file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
            </div>
          </div>
          <div class="flex justify-end pt-4 mt-4 border-t">
            <a href="{{ route('listapp.index') }}" type="button"
              class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 mr-2">Kembali</a>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Simpan</button>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection

@push('scripts')
@endpush
