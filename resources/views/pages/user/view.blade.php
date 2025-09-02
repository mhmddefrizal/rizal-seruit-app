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
      <h2 class="text-2xl font-semibold text-gray-800 mb-4">{{ $users_submenu }}</h2>

      <div class="mt-5 flex flex-col md:flex-row items-start gap-6">
        <!-- Logo di kiri -->
        <div class="flex-shrink-0">
          <img src="{{ asset('img/boy.png') }}" alt="Logo {{ $user->name }}"
            class="w-40 h-40 object-contain border border-gray-200 rounded-lg shadow-sm">
        </div>

        <!-- Deskripsi di kanan -->
        <div class="flex-1 overflow-x-auto mb-3">
          <table class="min-w-full border border-gray-200 rounded-lg">
            <tbody class="divide-y divide-gray-200">
              <tr>
                <td class="px-4 py-2 font-semibold text-gray-700 w-40">Nama</td>
                <td class="text-gray-500">:</td>
                <td class="px-4 py-2 text-gray-800">{{ $user->name }}</td>
              </tr>
              <tr>
                <td class="px-4 py-2 font-semibold text-gray-700">Email</td>
                <td class="text-gray-500">:</td>
                <td class="px-4 py-2 text-gray-800">{{ $user->email }}</td>
              </tr>
              <tr>
                <td class="px-4 py-2 font-semibold text-gray-700">Role</td>
                <td class="text-gray-500">:</td>
                <td class="px-4 py-2 text-gray-800">{{ $user->role }}</td>
              </tr>
              <tr>
                <td class="px-4 py-2 font-semibold text-gray-700">Status</td>
                <td class="text-gray-500">:</td>
                <td class="px-4 py-2 text-gray-800">{{ $user->status ? 'Aktif' : 'Tidak Aktif' }}</td>
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
