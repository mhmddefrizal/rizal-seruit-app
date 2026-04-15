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

            <!-- Search Bar -->
            <div class="mb-4 sm:mb-6 sm:hidden">
                <form action="{{ url()->current() }}" method="GET" class="relative w-full mobile-search-form">
                    <input type="text" name="search" id="search" placeholder="Search"
                        class="mobile-search-input w-full px-4 py-2 pr-10 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        value="{{ request('search', '') }}">
                    <button type="submit"
                        class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600">
                        <i class="fa fa-search"></i>
                    </button>
                </form>
            </div>

            <!-- Judul -->
            <div class="flex justify-between items-center gap-3 mb-4 sm:mb-6">
                <h2 class="text-xl sm:text-2xl font-semibold text-gray-800">{{ $users_submenu }}</h2>
                <a href="{{ route('users.create') }}"
                    class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 text-white font-semibold rounded-lg shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-75 text-sm sm:text-base sm:w-auto">
                    <i class="fa fa-plus mr-2"></i>Tambah Pengguna
                </a>
            </div>

            @include('sweetalert2::index')

            <!-- Tabel Data (Desktop) -->
            <div class="desktop-only overflow-x-auto">
                <table id="users-table" class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col"
                                class="px-4 lg:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                No</th>
                            <th scope="col"
                                class="px-4 lg:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Nama Pengguna</th>
                            <th scope="col"
                                class="px-4 lg:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Email</th>
                            <th scope="col"
                                class="px-4 lg:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Role</th>
                            <th scope="col"
                                class="px-4 lg:px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @php $idx = 1; @endphp
                        @foreach ($users as $user)
                            <tr class="hover:bg-gray-50 transition-colors duration-150">
                                <td class="px-4 lg:px-6 py-3 lg:py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $idx }}</td>
                                <td class="px-4 lg:px-6 py-3 lg:py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $user->name }}</td>
                                <td class="px-4 lg:px-6 py-3 lg:py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $user->email }}</td>
                                <td class="px-4 lg:px-6 py-3 lg:py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $user->role }}</td>
                                <td class="px-4 lg:px-6 py-3 lg:py-4 whitespace-nowrap text-center text-sm font-medium">
                                    <a href="{{ route('users.show', $user->slug) }}"
                                        class="text-green-600 hover:text-green-900 mx-1 sm:mx-2">
                                        <i class="fa fa-eye"></i>
                                    </a>

                                    @if (Auth::user()->role === 'admin')
                                        <a href="{{ route('users.edit', $user->slug) }}"
                                            class="text-indigo-600 hover:text-indigo-900 mx-1 sm:mx-2">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <button class="text-red-600 hover:text-red-900 mx-1 sm:mx-2">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    @elseif(Auth::user()->role === 'user' && Auth::user()->id === $user->id)
                                        <a href="{{ route('users.edit', $user->slug) }}"
                                            class="text-indigo-600 hover:text-indigo-900 mx-1 sm:mx-2">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <button class="text-red-300 cursor-not-allowed mx-1 sm:mx-2" disabled>
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    @else
                                        <button class="text-indigo-300 cursor-not-allowed mx-1 sm:mx-2" disabled>
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        <button class="text-red-300 cursor-not-allowed mx-1 sm:mx-2" disabled>
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    @endif
                                </td>
                            </tr>
                            @php $idx++; @endphp
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Card Layout (Mobile) -->
            <div class="mobile-only mobile-card-stack">
                @php $idx = 1; @endphp
                @foreach ($users as $user)
                    <div class="mobile-card bg-white border border-gray-200 rounded-lg p-4 shadow-sm">
                        <div class="flex items-start justify-between mb-2">
                            <div class="flex-1 min-w-0">
                                <span class="text-xs text-gray-400 font-medium">#{{ $idx }}</span>
                                <h3 class="text-sm font-semibold text-gray-900 truncate">{{ $user->name }}</h3>
                                <p class="text-xs text-gray-500 truncate">{{ $user->email }}</p>
                            </div>
                            <div class="flex items-center gap-3 ml-3">
                                <a href="{{ route('users.show', $user->slug) }}"
                                    class="text-green-600 hover:text-green-900"><i class="fa fa-eye"></i></a>
                                @if (Auth::user()->role === 'admin')
                                    <a href="{{ route('users.edit', $user->slug) }}"
                                        class="text-indigo-600 hover:text-indigo-900"><i class="fa fa-edit"></i></a>
                                    <button class="text-red-600 hover:text-red-900"><i class="fa fa-trash"></i></button>
                                @elseif(Auth::user()->role === 'user' && Auth::user()->id === $user->id)
                                    <a href="{{ route('users.edit', $user->slug) }}"
                                        class="text-indigo-600 hover:text-indigo-900"><i class="fa fa-edit"></i></a>
                                    <button class="text-red-300 cursor-not-allowed" disabled><i
                                            class="fa fa-trash"></i></button>
                                @else
                                    <button class="text-indigo-300 cursor-not-allowed" disabled><i
                                            class="fa fa-edit"></i></button>
                                    <button class="text-red-300 cursor-not-allowed" disabled><i
                                            class="fa fa-trash"></i></button>
                                @endif
                            </div>
                        </div>
                        <div class="text-xs text-gray-500">
                            <span
                                class="inline-block px-2 py-0.5 bg-gray-100 text-gray-700 rounded-full font-medium">{{ $user->role }}</span>
                        </div>
                    </div>
                    @php $idx++; @endphp
                @endforeach

                <div id="mobile-empty-users" class="mobile-empty-state hidden">Pengguna tidak ditemukan.</div>
                <div id="mobile-pagination-users" class="mobile-pagination"></div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .mobile-card-stack .mobile-card {
            margin-bottom: 1.5rem;
        }

        .mobile-card-stack .mobile-card:last-child {
            margin-bottom: 0;
        }

        .mobile-pagination {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 0.5rem;
            margin-top: 1rem;
        }

        .mobile-pagination .page-btn {
            min-width: 2rem;
            height: 2rem;
            padding: 0 0.625rem;
            border: 1px solid #d1d5db;
            border-radius: 0.5rem;
            background: #fff;
            color: #374151;
            font-size: 0.875rem;
            line-height: 1;
        }

        .mobile-pagination .page-btn.active {
            background: #2563eb;
            border-color: #2563eb;
            color: #fff;
        }

        .mobile-pagination .page-btn:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        .mobile-empty-state {
            margin-top: 0.75rem;
            padding: 0.75rem;
            border: 1px solid #e5e7eb;
            border-radius: 0.5rem;
            background: #f9fafb;
            color: #6b7280;
            text-align: center;
            font-size: 0.875rem;
        }

        .hidden {
            display: none;
        }
    </style>
@endpush

@push('scripts')
    <script>
        $(document).ready(function() {
            // Inisialisasi DataTables (desktop table only)
            // matchMedia stays in sync with CSS breakpoints at any zoom level
            if (window.matchMedia('(min-width: 640px)').matches) {
                $('#users-table').DataTable();
            }

            // Search + pagination untuk card mobile (0-639px)
            function initMobileCardSearchPagination(options) {
                if (window.matchMedia('(min-width: 640px)').matches) {
                    return;
                }

                var $stack = $(options.stackSelector);
                var $cards = $stack.find('.mobile-card');
                var $pager = $(options.pagerSelector);
                var $searchForm = $(options.searchFormSelector);
                var $searchInput = $(options.searchInputSelector);
                var $emptyState = $(options.emptyStateSelector);
                var filteredCards = $cards;

                function renderPage(page) {
                    var totalItems = filteredCards.length;
                    var totalPages = Math.ceil(totalItems / options.itemsPerPage);

                    if (totalPages === 0) {
                        $cards.hide();
                        $pager.empty();
                        $emptyState.removeClass('hidden');
                        return;
                    }

                    $emptyState.addClass('hidden');

                    if (page > totalPages) {
                        page = totalPages;
                    }

                    var start = (page - 1) * options.itemsPerPage;
                    var end = start + options.itemsPerPage;

                    $cards.hide();
                    filteredCards.slice(start, end).show();

                    var buttons = '';
                    buttons += '<button type="button" class="page-btn" data-page="' + (page - 1) + '" ' +
                        (page === 1 ? 'disabled' : '') + '>Prev</button>';

                    for (var i = 1; i <= totalPages; i++) {
                        buttons += '<button type="button" class="page-btn ' + (i === page ? 'active' : '') +
                            '" data-page="' + i + '">' + i + '</button>';
                    }

                    buttons += '<button type="button" class="page-btn" data-page="' + (page + 1) + '" ' +
                        (page === totalPages ? 'disabled' : '') + '>Next</button>';

                    $pager.html(buttons);
                }

                renderPage(1);

                function applySearch() {
                    var query = $.trim($searchInput.val()).toLowerCase();

                    if (!query) {
                        filteredCards = $cards;
                    } else {
                        filteredCards = $cards.filter(function() {
                            return $(this).text().toLowerCase().indexOf(query) !== -1;
                        });
                    }

                    renderPage(1);
                }

                $pager.on('click', '.page-btn', function() {
                    var page = parseInt($(this).data('page'), 10);
                    if (!isNaN(page) && page >= 1) {
                        renderPage(page);
                    }
                });

                $searchForm.on('submit', function(e) {
                    e.preventDefault();
                    applySearch();
                });

                $searchInput.on('input', function() {
                    applySearch();
                });

                if ($.trim($searchInput.val()) !== '') {
                    applySearch();
                }
            }

            initMobileCardSearchPagination({
                stackSelector: '.mobile-card-stack',
                pagerSelector: '#mobile-pagination-users',
                searchFormSelector: '.mobile-search-form',
                searchInputSelector: '.mobile-search-input',
                emptyStateSelector: '#mobile-empty-users',
                itemsPerPage: 5
            });
        });
    </script>
@endpush
