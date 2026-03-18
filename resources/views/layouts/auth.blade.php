<!DOCTYPE html>
<html lang="id">

<head>
    @include('partials.head', ['title' => 'Dashboard'])
    <link href="{{ asset('css/datatables.min.css') }}" rel="stylesheet">
    <!-- Font Awesome untuk Ikon -->
    <link rel="stylesheet" href="{{ asset('css/all.min.css') }}">

    <style>
        /* Kustomisasi kecil untuk DataTables agar cocok dengan Tailwind */
        .dataTables_wrapper .dataTables_length,
        .dataTables_wrapper .dataTables_filter,
        .dataTables_wrapper .dataTables_info,
        .dataTables_wrapper .dataTables_paginate {
            margin-bottom: 1rem;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button {
            padding: 0.5rem 1rem;
            margin: 0 0.25rem;
            border-radius: 0.375rem;
            border: 1px solid #e2e8f0;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            background-color: #3b82f6;
            color: white;
            border-color: #3b82f6;
        }

        .dataTables_wrapper .dataTables_filter input {
            border: 1px solid #e2e8f0;
            padding: 0.5rem;
            border-radius: 0.375rem;
            margin-left: 0.5rem;
        }
    </style>
</head>

<body class="bg-gray-100 font-sans">

    <div class="min-h-screen">
        <!-- Header -->
        <header class="bg-white shadow-md">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between h-16">
                    <div class="flex items-center space-x-6">
                        <a href="{{ route('admin.index') }}" class="text-2xl font-bold text-gray-800">SERUIT-BPS</a>

                        <nav class="hidden md:flex space-x-6">
                            <a href="{{ route('admin.index') }}"
                                class="text-gray-600 hover:text-gray-900 transition duration-300">
                                Dashboard
                            </a>
                            <a href="{{ route('listapp.index') }}"
                                class="text-gray-600 hover:text-gray-900 transition duration-300">
                                Kelola Aplikasi
                            </a>
                            @if (Auth::user()->role == 'admin')
                                <a href="{{ route('users.index') }}"
                                    class="text-gray-600 hover:text-gray-900 transition duration-300">
                                    Kelola Pengguna
                                </a>
                            @endif
                        </nav>
                    </div>

                    <div class="flex items-center space-x-4">
                        <span class="text-gray-700 font-medium">{{ Auth::user()->name ?? 'Guest' }}</span>
                        <div class="w-10 h-10 rounded-full bg-gray-300 flex items-center justify-center">
                            <i class="fa fa-user text-gray-600"></i>
                        </div>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                        <a href="{{ route('logout') }}" class="text-gray-500 hover:text-gray-800"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fa fa-sign-out-alt fa-lg"></i>
                        </a>
                    </div>
                </div>
            </div>
        </header>

        <!-- Konten Utama -->
        <main class="py-10">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                @yield('content')
            </div>
        </main>
    </div>

    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/datatables.min.js') }}"></script>
    <script src="{{ asset('js/chart.js') }}"></script>
    <script src="{{ asset('js/all.min.js') }}"></script>

    <!-- Script tambahan per halaman -->
    @stack('scripts')

</body>

</html>
