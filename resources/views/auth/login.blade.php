@extends('layouts.guest')

@section('content')
  <div class="flex justify-center items-center min-h-screen">
    <div class="w-full max-w-md bg-white rounded-lg shadow-md p-6">
      <h2 class="text-2xl font-bold mb-6 text-center">Masuk </h2>
      @if (session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
          {{ session('error') }}
        </div>
      @endif
      <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="mb-4">
          <label for="email" class="block text-gray-700 font-semibold mb-2">Email</label>
          <input id="email" type="email" name="email" value="{{ old('email') }}" required
            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
          @error('email')
            <span class="text-red-500 text-sm">{{ $message }}</span>
          @enderror
        </div>
        <div class="mb-6">
          <label for="password" class="block text-gray-700 font-semibold mb-2">Password</label>
          <input id="password" type="password" name="password" required
            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
          @error('password')
            <span class="text-red-500 text-sm">{{ $message }}</span>
          @enderror
        </div>
        <button type="submit"
          class="w-full bg-blue-500 text-white font-semibold py-2 px-4 rounded-lg hover:bg-blue-600 transition duration-200">
          Login
        </button>
      </form>
    </div>
  </div>
@endsection
