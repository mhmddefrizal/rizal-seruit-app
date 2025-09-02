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
      <div class="mt-5">
        <form action="{{ route('users.update', $user->slug) }}" method="POST">
          @csrf
          @method('PUT')
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
              <label class="block text-gray-700">Nama</label>
              <input type="text" name="name" id="name"
                class="w-full mt-1 p-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                value="{{ old('name', $user->name) }}">
            </div>
            <div>
              <label class="block text-gray-700">Email</label>
              <input type="text" name="email" id="email"
                class="w-full mt-1 p-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                value="{{ old('email', $user->email) }}">
            </div>
            <div>
              <label class="block text-gray-700">Password <span class="text-gray-500 text-sm">(kosongkan jika tidak
                  diganti)</span></label>
              <input type="password" name="password" id="password"
                class="w-full mt-1 p-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
              <label class="block text-gray-700">Role</label>
              <select name="role" id="role"
                class="w-full mt-1 p-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="none" {{ $user->role == 'none' ? 'selected' : '' }}>Pilih Role</option>
                <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
              </select>
            </div>
          </div>
          <div class="flex justify-end pt-4 mt-4 border-t">
            <a href="{{ route('users.index') }}" type="button"
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
