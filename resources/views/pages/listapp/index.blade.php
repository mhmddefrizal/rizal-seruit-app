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

    <!-- Search Bar -->
    <div class="mb-6">
      <form action="#" method="GET" class="relative w-full">
        <input type="text" name="search" id="search" placeholder="Search"
          class="w-full px-4 py-2 pr-10 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
          value="{{ request('search', '') }}">
        <button type="submit"
          class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600">
          <i class="fa fa-search"></i>
        </button>
      </form>
    </div>

    <!-- Judul -->
    <div class="flex justify-between items-center mb-6">
      <h2 class="text-2xl font-semibold text-gray-800 mb-4">{{ $apps_submenu }}</h2>
      <a href="{{ route('listapp.create') }}"
        class="px-4 py-2 bg-blue-600 text-white font-semibold rounded-lg shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-75">
        <i class="fa fa-plus mr-2"></i>Tambah Aplikasi
      </a>
    </div>

    @include('sweetalert2::index')
    <!-- Tabel Data -->
    <div class="overflow-x-auto">
      <table id="applications-table" class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
          <tr>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No
            </th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
              Nama Aplikasi</th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
              Pengguna</th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
              Pembuat</th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
              Akses</th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
              Hits</th>
            <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
              Aksi</th>
          </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
          @php
          $idx = 1;
          @endphp
          @foreach ($list_apps as $app)
          <tr>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $idx }}</td>
            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
              <a href="{{ $app['link'] }}" class="text-indigo-500" target="_blank">{{ $app['nama'] }}</a>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
              {{ $app['pengguna'] }}
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
              {{ $app['pembuat'] }}
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
              {{ $app['akses'] }}
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
              {{ $app['hits'] }}
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
              <a href="{{ route('listapp.show', $app['slug']) }}" class="text-green-600 hover:text-green-900 mx-2"><i
                  class="fa fa-eye"></i></a>
              <a href="{{ route('listapp.edit', $app['slug']) }}" class="text-indigo-600 hover:text-indigo-900 mx-2"><i
                  class="fa fa-edit"></i></a>
              <form action="{{ route('listapp.delete', $app['slug']) }}" method="POST" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-red-600 hover:text-red-900 mx-2">
                  <i class="fa fa-trash"></i>
                </button>
              </form>
            </td>
          </tr>
          @php
          $idx++;
          @endphp
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
  // Inisialisasi DataTables
  $('#applications-table').DataTable();
});
</script>
@endpush