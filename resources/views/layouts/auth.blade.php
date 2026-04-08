<!DOCTYPE html>
<html lang="id">

<head>
    @include('partials.head', ['title' => 'Dashboard'])
    <link href="{{ asset('css/datatables.min.css') }}" rel="stylesheet">
    <!-- Font Awesome untuk Ikon -->
    <link rel="stylesheet" href="{{ asset('css/all.min.css') }}">

    <style>
        /* ========================================
           DataTables Responsive Overrides
           ======================================== */
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

        /* Mobile: Stack DataTables controls */
        @media (max-width: 639px) {
            .dataTables_wrapper .dataTables_length,
            .dataTables_wrapper .dataTables_filter {
                float: none !important;
                text-align: left !important;
                margin-bottom: 0.75rem;
            }

            .dataTables_wrapper .dataTables_filter input {
                width: 100% !important;
                margin-left: 0 !important;
                margin-top: 0.5rem;
                display: block;
            }

            .dataTables_wrapper .dataTables_filter label {
                display: block;
            }

            .dataTables_wrapper .dataTables_info,
            .dataTables_wrapper .dataTables_paginate {
                float: none !important;
                text-align: center !important;
            }

            .dataTables_wrapper .dataTables_paginate {
                display: flex;
                flex-wrap: wrap;
                justify-content: center;
                gap: 0.25rem;
            }

            .dataTables_wrapper .dataTables_paginate .paginate_button {
                padding: 0.4rem 0.75rem;
                font-size: 0.8rem;
            }
        }

        /* ========================================
           Mobile Navigation
           ======================================== */
        .mobile-menu {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease;
        }

        .mobile-menu.open {
            max-height: 300px;
        }

        .hamburger-line {
            display: block;
            width: 24px;
            height: 2px;
            background-color: #374151;
            border-radius: 2px;
            transition: all 0.3s ease;
        }

        .hamburger.active .hamburger-line:nth-child(1) {
            transform: translateY(8px) rotate(45deg);
        }

        .hamburger.active .hamburger-line:nth-child(2) {
            opacity: 0;
        }

        .hamburger.active .hamburger-line:nth-child(3) {
            transform: translateY(-8px) rotate(-45deg);
        }
    </style>
</head>

<body class="bg-gray-100 font-sans">

    <div class="min-h-screen">
        <!-- Header -->
        <header class="bg-white shadow-md relative z-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between h-16">
                    <!-- Logo + Desktop Nav -->
                    <div class="flex items-center space-x-6">
                        <a href="{{ route('admin.index') }}" class="text-xl sm:text-2xl font-bold text-gray-800 whitespace-nowrap">SERUIT-BPS</a>

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

                    <!-- Right side: User info + Logout + Hamburger -->
                    <div class="flex items-center space-x-3 sm:space-x-4">
                        <span class="hidden sm:inline text-gray-700 font-medium">{{ Auth::user()->name ?? 'Guest' }}</span>
                        <div class="w-8 h-8 sm:w-10 sm:h-10 rounded-full bg-gray-300 flex items-center justify-center">
                            <i class="fa fa-user text-gray-600 text-sm sm:text-base"></i>
                        </div>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                        <a href="{{ route('logout') }}" class="text-gray-500 hover:text-gray-800"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fa fa-sign-out-alt fa-lg"></i>
                        </a>

                        <!-- Hamburger Button (Mobile only) -->
                        <button type="button" class="md:hidden hamburger flex flex-col justify-center items-center gap-[6px] p-2 -mr-2"
                            id="hamburger-btn" aria-label="Toggle navigation">
                            <span class="hamburger-line"></span>
                            <span class="hamburger-line"></span>
                            <span class="hamburger-line"></span>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Mobile Navigation Menu -->
            <div class="md:hidden mobile-menu border-t border-gray-200" id="mobile-menu">
                <div class="px-4 py-3 space-y-2 bg-white">
                    <span class="block px-3 py-2 text-sm text-gray-500 font-medium sm:hidden">
                        {{ Auth::user()->name ?? 'Guest' }}
                    </span>
                    <a href="{{ route('admin.index') }}"
                        class="block px-3 py-2 rounded-lg text-gray-700 hover:bg-gray-100 transition duration-200">
                        <i class="fa fa-tachometer-alt mr-2 w-5 text-center"></i>Dashboard
                    </a>
                    <a href="{{ route('listapp.index') }}"
                        class="block px-3 py-2 rounded-lg text-gray-700 hover:bg-gray-100 transition duration-200">
                        <i class="fa fa-th-list mr-2 w-5 text-center"></i>Kelola Aplikasi
                    </a>
                    @if (Auth::user()->role == 'admin')
                        <a href="{{ route('users.index') }}"
                            class="block px-3 py-2 rounded-lg text-gray-700 hover:bg-gray-100 transition duration-200">
                            <i class="fa fa-users mr-2 w-5 text-center"></i>Kelola Pengguna
                        </a>
                    @endif
                </div>
            </div>
        </header>

        <!-- Konten Utama -->
        <main class="py-6 sm:py-10">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                @yield('content')
            </div>
        </main>
    </div>

    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/datatables.min.js') }}"></script>
    <script src="{{ asset('js/chart.js') }}"></script>
    <script src="{{ asset('js/all.min.js') }}"></script>

    <!-- Mobile Menu Toggle -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        var hamburger = document.getElementById('hamburger-btn');
        var mobileMenu = document.getElementById('mobile-menu');

        if (hamburger && mobileMenu) {
            hamburger.addEventListener('click', function() {
                hamburger.classList.toggle('active');
                mobileMenu.classList.toggle('open');
            });
        }
    });
    </script>

    <!-- Script tambahan per halaman -->
    @stack('scripts')

</body>

</html>
