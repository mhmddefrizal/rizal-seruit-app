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

  /* Desktop nav: hidden on mobile, flex on md+ */
  .nav-desktop {
    display: none;
  }

  /* Hamburger button: visible on mobile, hidden on md+ */
  .hamburger-btn {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    gap: 5px;
    padding: 8px;
    background: none;
    border: 1px solid #e5e7eb;
    border-radius: 8px;
    cursor: pointer;
    transition: background-color 0.2s ease;
  }

  .hamburger-btn:hover {
    background-color: #f3f4f6;
  }

  .hamburger-btn .hamburger-line {
    display: block;
    width: 20px;
    height: 2px;
    background-color: #374151;
    border-radius: 2px;
    transition: all 0.3s ease;
  }

  .hamburger-btn.active .hamburger-line:nth-child(1) {
    transform: translateY(7px) rotate(45deg);
  }

  .hamburger-btn.active .hamburger-line:nth-child(2) {
    opacity: 0;
  }

  .hamburger-btn.active .hamburger-line:nth-child(3) {
    transform: translateY(-7px) rotate(-45deg);
  }

  /* Mobile menu panel */
  .mobile-nav {
    display: block;
    max-height: 0;
    overflow: hidden;
    transition: max-height 0.3s ease;
    border-top: 1px solid #e5e7eb;
  }

  .mobile-nav.open {
    max-height: 400px;
  }

  /* Username on mobile only */
  .user-name-desktop {
    display: none;
  }

  @media (min-width: 768px) {
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
      <div class="max-w-7xl mx-auto px-4" style="padding-left: 1rem; padding-right: 1rem;">
        <div style="display: flex; align-items: center; justify-content: space-between; height: 64px;">
          <!-- Logo + Desktop Nav -->
          <div style="display: flex; align-items: center; gap: 1.5rem;">
            <a href="{{ route('admin.index') }}"
              style="font-size: 1.25rem; font-weight: 700; color: #1f2937; white-space: nowrap; text-decoration: none;">SERUIT-BPS</a>

            <nav class="nav-desktop">
              <a href="{{ route('admin.index') }}"
                style="color: #4b5563; text-decoration: none; transition: color 0.3s;">Dashboard</a>
              <a href="{{ route('listapp.index') }}"
                style="color: #4b5563; text-decoration: none; transition: color 0.3s;">Kelola Aplikasi</a>
              @if (Auth::user()->role == 'admin')
              <a href="{{ route('users.index') }}"
                style="color: #4b5563; text-decoration: none; transition: color 0.3s;">Kelola Pengguna</a>
              @endif
            </nav>
          </div>

          <!-- Right side -->
          <div style="display: flex; align-items: center; gap: 0.75rem;">
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

      <!-- Mobile Navigation Menu -->
      <div class="mobile-nav" id="mobile-menu">
        <div style="padding: 0.75rem 1rem; background: #fff;">
          <div
            style="padding: 0.5rem 0.75rem; margin-bottom: 0.25rem; font-size: 0.875rem; color: #6b7280; font-weight: 500;">
            {{ Auth::user()->name ?? 'Guest' }}
          </div>
          <a href="{{ route('admin.index') }}"
            style="display: block; padding: 0.625rem 0.75rem; border-radius: 8px; color: #374151; text-decoration: none; font-size: 0.9375rem; transition: background-color 0.2s;">
            <i class="fa fa-tachometer-alt" style="margin-right: 0.5rem; width: 20px; text-align: center;"></i>Dashboard
          </a>
          <a href="{{ route('listapp.index') }}"
            style="display: block; padding: 0.625rem 0.75rem; border-radius: 8px; color: #374151; text-decoration: none; font-size: 0.9375rem; transition: background-color 0.2s;">
            <i class="fa fa-th-list" style="margin-right: 0.5rem; width: 20px; text-align: center;"></i>Kelola Aplikasi
          </a>
          @if (Auth::user()->role == 'admin')
          <a href="{{ route('users.index') }}"
            style="display: block; padding: 0.625rem 0.75rem; border-radius: 8px; color: #374151; text-decoration: none; font-size: 0.9375rem; transition: background-color 0.2s;">
            <i class="fa fa-users" style="margin-right: 0.5rem; width: 20px; text-align: center;"></i>Kelola Pengguna
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
      hamburger.addEventListener('click', function(e) {
        e.stopPropagation();
        hamburger.classList.toggle('active');
        mobileMenu.classList.toggle('open');
      });

      // Close menu when clicking outside
      document.addEventListener('click', function(e) {
        if (!hamburger.contains(e.target) && !mobileMenu.contains(e.target)) {
          hamburger.classList.remove('active');
          mobileMenu.classList.remove('open');
        }
      });
    }
  });
  </script>

  <!-- Script tambahan per halaman -->
  @stack('scripts')

</body>

</html>