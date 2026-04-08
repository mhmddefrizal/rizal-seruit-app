@extends('layouts.auth')

@section('content')
<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
  <div class="p-6 bg-white border-b border-gray-200">
    <!-- Breadcrumb -->
    @include('components.breadcrumb', [
    'route' => 'users.index',
    'menu' => $users_menu,
    'submenu' => $users_submenu,
    ])

    <!-- Judul -->
    <div class="flex justify-between items-center mb-6">
      <h2 class="text-2xl font-semibold text-gray-800 mb-4">{{ $users_submenu }}</h2>
      <a href="{{ route('users.create') }}"
        class="px-4 py-2 bg-blue-600 text-white font-semibold rounded-lg shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-75">
        <i class="fa fa-plus mr-2"></i>Tambah Pengguna
      </a>
    </div>

    @include('sweetalert2::index')
    <!-- Tabel Data -->
    <div class="overflow-x-auto">
      <table id="users-table" class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
          <tr>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No
            </th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
              Nama Pengguna</th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
              Email</th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
              Role</th>
            <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
              Aksi</th>
          </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
          @php
          $idx = 1;
          @endphp
          @foreach ($users as $user)
          <tr>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $idx }}</td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
              {{ $user->name }}
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
              {{ $user->email }}
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
              {{ $user->role }}
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
              {{-- tombol view selalu bisa --}}
              <a href="{{ route('users.show', $user->slug) }}" class="text-green-600 hover:text-green-900 mx-2">
                <i class="fa fa-eye"></i>
              </a>

              @if (Auth::user()->role === 'admin')
              {{-- admin bisa edit & hapus semua --}}
              <a href="{{ route('users.edit', $user->slug) }}" class="text-indigo-600 hover:text-indigo-900 mx-2">
                <i class="fa fa-edit"></i>
              </a>
              <button class="text-red-600 hover:text-red-900 mx-2">
                <i class="fa fa-trash"></i>
              </button>
              @elseif(Auth::user()->role === 'user' && Auth::user()->id === $user->id)
              {{-- user biasa hanya bisa edit dirinya sendiri --}}
              <a href="{{ route('users.edit', $user->slug) }}" class="text-indigo-600 hover:text-indigo-900 mx-2">
                <i class="fa fa-edit"></i>
              </a>
              <button class="text-red-300 cursor-not-allowed mx-2" disabled>
                <i class="fa fa-trash"></i>
              </button>
              @else
              {{-- selain itu disable --}}
              <button class="text-indigo-300 cursor-not-allowed mx-2" disabled>
                <i class="fa fa-edit"></i>
              </button>
              <button class="text-red-300 cursor-not-allowed mx-2" disabled>
                <i class="fa fa-trash"></i>
              </button>
              @endif
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
  $('#users-table').DataTable();
});
</script>
@endpush