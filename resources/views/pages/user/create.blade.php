@extends('layouts.auth')

@section('content')
<div class="bg-white overflow-hidden shadow-sm rounded-lg">
  <div class="p-4 sm:p-6 bg-white border-b border-gray-200">
    <!-- Breadcrumb -->
    @include('components.breadcrumb', [
    'route' => 'users.index',
    'menu' => $users_menu,
    'submenu' => $users_submenu,
    ])

    <!-- Judul -->
    <h2 class="text-xl sm:text-2xl font-semibold text-gray-800 mb-4">{{ $users_submenu }}</h2>
    <div class="mt-3 sm:mt-5">
      <form action="{{ route('users.store') }}" method="POST">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          <div>
            <label class="block text-sm sm:text-base text-gray-700 font-medium mb-1">Nama</label>
            <input type="text" name="name" id="name"
              class="w-full p-2 sm:p-2.5 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm sm:text-base">
          </div>
          <div>
            <label class="block text-sm sm:text-base text-gray-700 font-medium mb-1">Email</label>
            <input type="text" name="email" id="email"
              class="w-full p-2 sm:p-2.5 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm sm:text-base">
          </div>
          <div>
            <label class="block text-sm sm:text-base text-gray-700 font-medium mb-1">Password</label>
            <input type="password" name="password" id="password"
              class="w-full p-2 sm:p-2.5 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm sm:text-base">
          </div>
          <div>
            <label class="block text-sm sm:text-base text-gray-700 font-medium mb-1">Role</label>
            <select name="role" id="role"
              class="w-full p-2 sm:p-2.5 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm sm:text-base">
              <option value="none">Pilih Role</option>
              <option value="admin">Admin</option>
              <option value="user">User</option>
            </select>
          </div>
        </div>
        <div class="flex flex-col-reverse sm:flex-row sm:justify-end gap-2 sm:gap-0 pt-4 mt-4 border-t">
          <a href="{{ route('users.index') }}" type="button"
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