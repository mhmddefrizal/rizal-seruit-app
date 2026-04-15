<!DOCTYPE html>
<html lang="id">

<head>
    @php
        $pageTitle = match (true) {
            request()->routeIs('admin.index') => 'Dashboard',
            request()->routeIs('listapp.*') => 'Kelola Aplikasi',
            request()->routeIs('users.*') => 'Kelola Pengguna',
            default => 'SERUIT-BPS',
        };
    @endphp
    @include('partials.head', ['title' => $pageTitle])
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
           Auth Header — Fluid Sizing
           ======================================== */
        .header-main-row {
            display: flex;
            align-items: center;
            /* Fluid height: 3.5rem (56px) → 4rem (64px) */
            height: clamp(3.5rem, 3.25rem + 0.75vw, 4rem);
            width: 100%;
        }

        .header-left {
            display: flex;
            align-items: center;
            gap: 1.5rem;
            flex: 1;
            min-width: 0;
        }

        .header-right {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-left: auto;
            padding-right: 0.5rem;
        }

        /* ========================================
           Mobile Navigation
           ======================================== */

        /* Desktop nav: hidden on <=925px, visible on >925px */
        .nav-desktop {
            display: none;
        }

        /* Hamburger button: visible on <=925px, hidden on >925px */
        .hamburger-btn {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            gap: 0.3125rem;
            padding: 0.5rem;
            background: none;
            border: 1px solid #e5e7eb;
            border-radius: 0.5rem;
            cursor: pointer;
            transition: background-color 0.2s ease;
        }

        .hamburger-btn:hover {
            background-color: #f3f4f6;
        }

        .hamburger-btn .hamburger-line {
            display: block;
            width: 1.25rem;
            height: 0.125rem;
            background-color: #374151;
            border-radius: 0.125rem;
            transition: all 0.3s ease;
        }

        .hamburger-btn.active .hamburger-line:nth-child(1) {
            transform: translateY(0.4375rem) rotate(45deg);
        }

        .hamburger-btn.active .hamburger-line:nth-child(2) {
            opacity: 0;
        }

        .hamburger-btn.active .hamburger-line:nth-child(3) {
            transform: translateY(-0.4375rem) rotate(-45deg);
        }

        /* Mobile menu panel */
        .mobile-nav {
            display: none;
            position: fixed;
            right: 0;
            background: #fff;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            z-index: 49;
        }

        .mobile-nav.open {
            display: block;
        }

        .mobile-nav-link:hover {
            background-color: #f3f4f6;
        }

        /* Username on mobile only */
        .user-name-desktop {
            display: none;
        }

        @media (min-width: 926px) {
            .nav-desktop {
                display: flex;
                gap: 1.5rem;
            }

            .hamburger-btn {
                display: none !important;
            }

            .mobile-nav {
                display: none !important;
            }

            .user-name-desktop {
                display: inline;
            }

            .header-main-row {
                position: static;
            }

            .header-left {
                padding-right: 0;
            }

            .header-right {
                position: static;
                top: auto;
                right: auto;
                transform: none;
                margin-left: auto;
                padding-right: 0.5rem;
            }
        }

        /* ========================================
           Responsive Visibility Helpers
           ======================================== */
        .desktop-only {
            display: none !important;
        }

        .mobile-only {
            display: block !important;
        }

        @media (max-width: 925px) {
            .header-left {
                padding-right: 8.5rem !important;
            }

            .header-right {
                position: absolute !important;
                right: 0.25rem !important;
                top: 50% !important;
                transform: translateY(-50%) !important;
                margin-left: 0 !important;
                padding-right: 0 !important;
            }
        }

        @media (min-width: 640px) {
            .desktop-only {
                display: block !important;
            }

            .mobile-only {
                display: none !important;
            }
        }
    </style>
</head>

<body class="bg-gray-100 font-sans">

    <div class="min-h-screen">
        <!-- Header -->
        <header class="bg-white shadow-md" style="position: relative; z-index: 50;">
            <div class="w-full px-4" style="padding-left: 1rem; padding-right: 0;">
                <div class="header-main-row">
                    <!-- Logo + Desktop Nav -->
                    <div class="header-left">
                        <a href="{{ route('admin.index') }}"
                            style="font-size: 1.25rem; font-weight: 700; color: #1f2937; white-space: nowrap; text-decoration: none;">SERUIT-BPS</a>

                        <nav class="nav-desktop">
                            <a href="{{ route('admin.index') }}"
                                style="color: #4b5563; text-decoration: none; transition: color 0.3s;">Dashboard</a>
                            <a href="{{ route('listapp.index') }}"
                                style="color: #4b5563; text-decoration: none; transition: color 0.3s;">Kelola
                                Aplikasi</a>
                            @if (Auth::user()->role == 'admin')
                                <a href="{{ route('users.index') }}"
                                    style="color: #4b5563; text-decoration: none; transition: color 0.3s;">Kelola
                                    Pengguna</a>
                            @endif
                        </nav>
                    </div>

                    <!-- Right side -->
                    <div class="header-right">
                        <span class="user-name-desktop"
                            style="color: #374151; font-weight: 500;">{{ Auth::user()->name ?? 'Guest' }}</span>
                        <div
                            style="width: 36px; height: 36px; border-radius: 50%; background-color: #d1d5db; display: flex; align-items: center; justify-content: center;">
                            <i class="fa fa-user" style="color: #4b5563; font-size: 14px;"></i>
                        </div>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                        <a href="{{ route('logout') }}" style="color: #6b7280; text-decoration: none;"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fa fa-sign-out-alt" style="font-size: 18px;"></i>
                        </a>

                        <!-- Hamburger Button -->
                        <button type="button" class="hamburger-btn" id="hamburger-btn" aria-label="Toggle navigation">
                            <span class="hamburger-line"></span>
                            <span class="hamburger-line"></span>
                            <span class="hamburger-line"></span>
                        </button>
                    </div>
                </div>
            </div>
        </header>

        <!-- Mobile Navigation Menu (outside header) -->
        <div class="mobile-nav" id="mobile-menu">
            <div style="padding: 0.5rem 1rem 0.75rem; border-top: 1px solid #e5e7eb;">
                <div
                    style="padding: 0.5rem 0.75rem; margin-bottom: 0.25rem; font-size: 0.8125rem; color: #9ca3af; font-weight: 500; text-transform: uppercase; letter-spacing: 0.05em;">
                    {{ Auth::user()->name ?? 'Guest' }}
                </div>
                <a href="{{ route('admin.index') }}" class="mobile-nav-link"
                    style="display: flex; align-items: center; padding: 0.625rem 0.75rem; border-radius: 8px; color: #374151; text-decoration: none; font-size: 0.9375rem; transition: background-color 0.2s;">
                    <i class="fa fa-tachometer-alt"
                        style="margin-right: 0.625rem; width: 20px; text-align: center; color: #6b7280;"></i>Dashboard
                </a>
                <a href="{{ route('listapp.index') }}" class="mobile-nav-link"
                    style="display: flex; align-items: center; padding: 0.625rem 0.75rem; border-radius: 8px; color: #374151; text-decoration: none; font-size: 0.9375rem; transition: background-color 0.2s;">
                    <i class="fa fa-th-list"
                        style="margin-right: 0.625rem; width: 20px; text-align: center; color: #6b7280;"></i>Kelola
                    Aplikasi
                </a>
                @if (Auth::user()->role == 'admin')
                    <a href="{{ route('users.index') }}" class="mobile-nav-link"
                        style="display: flex; align-items: center; padding: 0.625rem 0.75rem; border-radius: 8px; color: #374151; text-decoration: none; font-size: 0.9375rem; transition: background-color 0.2s;">
                        <i class="fa fa-users"
                            style="margin-right: 0.625rem; width: 20px; text-align: center; color: #6b7280;"></i>Kelola
                        Pengguna
                    </a>
                @endif
            </div>
        </div>

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
            var mobileBreakpoint = 925;

            if (hamburger && mobileMenu) {
                var closeMobileMenu = function() {
                    hamburger.classList.remove('active');
                    mobileMenu.classList.remove('open');
                };

                hamburger.addEventListener('click', function(e) {
                    e.stopPropagation();
                    hamburger.classList.toggle('active');
                    mobileMenu.classList.toggle('open');
                });

                // Close menu when clicking outside
                document.addEventListener('click', function(e) {
                    if (!hamburger.contains(e.target) && !mobileMenu.contains(e.target)) {
                        closeMobileMenu();
                    }
                });

                // Ensure mobile menu closes when switching to desktop width
                window.addEventListener('resize', function() {
                    if (window.innerWidth > mobileBreakpoint) {
                        closeMobileMenu();
                    }
                });
            }
        });
    </script>

    <!-- Script tambahan per halaman -->
    @stack('scripts')

</body>

</html>
