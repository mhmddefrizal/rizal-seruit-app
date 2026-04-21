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

            <div class="mt-3 sm:mt-5 flex flex-col md:flex-row items-center md:items-start gap-4 sm:gap-6">
                <!-- Avatar -->
                <div class="flex-shrink-0">
                    <img src="{{ asset('img/user.png') }}" alt="Logo {{ $user->name }}" style="width: 200px ;height: 200px;"
                        class="sm:w-40 sm:h-40 object-contain rounded-lg">
                </div>

                <!-- Detail Info -->
                <div class="flex-1 w-full">
                    <!-- Desktop: Table layout -->
                    <div class="desktop-only overflow-x-auto mb-3">
                        <table class="min-w-full border border-gray-200 rounded-lg">
                            <tbody class="divide-y divide-gray-200">
                                <tr>
                                    <td class="px-4 py-2 font-semibold text-gray-700 w-40">Nama</td>
                                    <td class="text-gray-500 w-4">:</td>
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

                    <!-- Mobile: Stacked list layout -->
                    <div class="mobile-only space-y-3">
                        <div class="border-b border-gray-100 pb-2">
                            <span class="block text-xs font-semibold text-gray-500 uppercase tracking-wide">Nama</span>
                            <span class="block text-sm text-gray-800 mt-0.5">{{ $user->name }}</span>
                        </div>
                        <div class="border-b border-gray-100 pb-2">
                            <span class="block text-xs font-semibold text-gray-500 uppercase tracking-wide">Email</span>
                            <span class="block text-sm text-gray-800 mt-0.5 break-all">{{ $user->email }}</span>
                        </div>
                        <div class="grid grid-cols-2 gap-3">
                            <div class="border-b border-gray-100 pb-2">
                                <span class="block text-xs font-semibold text-gray-500 uppercase tracking-wide">Role</span>
                                <span class="block text-sm text-gray-800 mt-0.5">{{ $user->role }}</span>
                            </div>
                            <div class="border-b border-gray-100 pb-2">
                                <span
                                    class="block text-xs font-semibold text-gray-500 uppercase tracking-wide">Status</span>
                                <span
                                    class="block text-sm text-gray-800 mt-0.5">{{ $user->status ? 'Aktif' : 'Tidak Aktif' }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
@endpush
