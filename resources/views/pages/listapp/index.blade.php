@extends('layouts.auth')

@section('content')
    <div class="bg-white overflow-hidden shadow-sm rounded-lg">
        <div class="p-4 sm:p-6 bg-white border-b border-gray-200">
            <!-- Breadcrumb -->
            @include('components.breadcrumb', [
                'route' => 'listapp.index',
                'menu' => $apps_menu,
                'submenu' => $apps_submenu,
            ])

            <!-- Search Bar -->
            <div class="mb-4 sm:mb-6 sm:hidden">
                <form action="#" method="GET" class="relative w-full">
                    <input type="text" name="search" id="search" placeholder="Search"
                        class="w-full px-4 py-2 pr-10 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        value="{{ request('search', '') }}">
                    <button type="submit"
                        class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600">
                        <i class="fa fa-search"></i>
                    </button>
                </form>
            </div>

            <!-- Judul -->
            <div class="flex justify-between items-center gap-3 mb-4 sm:mb-6">
                <h2 class="text-xl sm:text-2xl font-semibold text-gray-800">{{ $apps_submenu }}</h2>
                <a href="{{ route('listapp.create') }}"
                    class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 text-white font-semibold rounded-lg shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-75 text-sm sm:text-base sm:w-auto">
                    <i class="fa fa-plus mr-2"></i>Tambah Aplikasi
                </a>
            </div>

            @include('sweetalert2::index')

            <!-- Tabel Data (Desktop) -->
            <div class="desktop-only overflow-x-auto">
                <table id="applications-table" class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col"
                                class="px-4 lg:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                No</th>
                            <th scope="col"
                                class="px-4 lg:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Nama
                                Aplikasi</th>
                            <th scope="col"
                                class="px-4 lg:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Pengguna
                            </th>
                            <th scope="col"
                                class="px-4 lg:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Pembuat
                            </th>
                            <th scope="col"
                                class="px-4 lg:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Akses</th>
                            <th scope="col"
                                class="px-4 lg:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Hits</th>
                            <th scope="col"
                                class="px-4 lg:px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @php $idx = 1; @endphp
                        @foreach ($list_apps as $app)
                            <tr class="hover:bg-gray-50 transition-colors duration-150">
                                <td class="px-4 lg:px-6 py-3 lg:py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $idx }}</td>
                                <td class="px-4 lg:px-6 py-3 lg:py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    <a href="{{ $app['link'] }}" class="text-indigo-500 hover:text-indigo-700"
                                        target="_blank">{{ $app['nama'] }}</a>
                                </td>
                                <td class="px-4 lg:px-6 py-3 lg:py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $app['pengguna'] }}</td>
                                <td class="px-4 lg:px-6 py-3 lg:py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $app['pembuat'] }}</td>
                                <td class="px-4 lg:px-6 py-3 lg:py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $app['akses'] }}</td>
                                <td class="px-4 lg:px-6 py-3 lg:py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $app['hits'] }}</td>
                                <td class="px-4 lg:px-6 py-3 lg:py-4 whitespace-nowrap text-center text-sm font-medium">
                                    <a href="{{ route('listapp.show', $app['slug']) }}"
                                        class="text-green-600 hover:text-green-900 mx-1 sm:mx-2"><i
                                            class="fa fa-eye"></i></a>
                                    <a href="{{ route('listapp.edit', $app['slug']) }}"
                                        class="text-indigo-600 hover:text-indigo-900 mx-1 sm:mx-2"><i
                                            class="fa fa-edit"></i></a>
                                    <form action="{{ route('listapp.delete', $app['slug']) }}" method="POST"
                                        class="inline form-delete" data-name="{{ $app['nama'] }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900 mx-1 sm:mx-2">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
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
                @foreach ($list_apps as $app)
                    <div class="mobile-card bg-white border border-gray-200 rounded-lg p-4 shadow-sm">
                        <div class="flex items-start justify-between mb-2">
                            <div class="flex-1 min-w-0">
                                <span class="text-xs text-gray-400 font-medium">#{{ $idx }}</span>
                                <h3 class="text-sm font-semibold text-gray-900 truncate">
                                    <a href="{{ $app['link'] }}" class="text-indigo-600 hover:text-indigo-800"
                                        target="_blank">{{ $app['nama'] }}</a>
                                </h3>
                            </div>
                            <div class="flex items-center gap-3 ml-3">
                                <a href="{{ route('listapp.show', $app['slug']) }}"
                                    class="text-green-600 hover:text-green-900"><i class="fa fa-eye"></i></a>
                                <a href="{{ route('listapp.edit', $app['slug']) }}"
                                    class="text-indigo-600 hover:text-indigo-900"><i class="fa fa-edit"></i></a>
                                <form action="{{ route('listapp.delete', $app['slug']) }}" method="POST"
                                    class="inline form-delete" data-name="{{ $app['nama'] }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900"><i
                                            class="fa fa-trash"></i></button>
                                </form>
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-x-4 gap-y-1 text-xs text-gray-500">
                            <div><span class="font-medium text-gray-600">Pengguna:</span> {{ $app['pengguna'] }}</div>
                            <div><span class="font-medium text-gray-600">Pembuat:</span> {{ $app['pembuat'] }}</div>
                            <div><span class="font-medium text-gray-600">Akses:</span> {{ $app['akses'] }}</div>
                            <div><span class="font-medium text-gray-600">Hits:</span> {{ $app['hits'] }}</div>
                        </div>
                    </div>
                    @php $idx++; @endphp
                @endforeach

                <div id="mobile-pagination-listapp" class="mobile-pagination"></div>
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
    </style>
@endpush

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            // Inisialisasi DataTables (desktop table only)
            if ($(window).width() >= 640) {
                $('#applications-table').DataTable();
            }

            // Pagination sederhana untuk card mobile (0-639px)
            function initMobileCardPagination(stackSelector, pagerSelector, itemsPerPage) {
                if ($(window).width() >= 640) {
                    return;
                }

                var $stack = $(stackSelector);
                var $cards = $stack.find('.mobile-card');
                var $pager = $(pagerSelector);
                var totalItems = $cards.length;
                var totalPages = Math.ceil(totalItems / itemsPerPage);

                if (totalPages <= 1) {
                    $pager.empty();
                    return;
                }

                function renderPage(page) {
                    var start = (page - 1) * itemsPerPage;
                    var end = start + itemsPerPage;

                    $cards.hide().slice(start, end).show();

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

                $pager.on('click', '.page-btn', function() {
                    var page = parseInt($(this).data('page'), 10);
                    if (!isNaN(page) && page >= 1 && page <= totalPages) {
                        renderPage(page);
                    }
                });
            }

            initMobileCardPagination('.mobile-card-stack', '#mobile-pagination-listapp', 5);

            // Konfirmasi Delete dengan SweetAlert2
            $(document).on('submit', '.form-delete', function(e) {
                e.preventDefault();
                var form = this;
                var name = $(this).data('name');

                Swal.fire({
                    title: 'Hapus Data',
                    text: "Apakah anda yakin Data dengan nama aplikasi '" + name +
                        "' ingin dihapus?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#dc2626',
                    cancelButtonColor: '#6b7280',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Tidak',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    </script>
@endpush
