@extends('layouts.info')

@section('content')
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 sm:p-8 md:p-10 bg-white border-b border-gray-200">

            {{-- Header --}}
            <div class="flex items-center gap-3 mb-6">
                <span class="w-1.5 h-8 bg-[#a51c31] rounded-full inline-block"></span>
                <h1 class="text-2xl sm:text-3xl font-bold text-gray-800">Tentang SERUIT</h1>
            </div>

            {{-- Subtitle --}}
            <div class="mb-8 bg-gradient-to-r from-[#a51c31]/5 to-transparent rounded-lg p-4 sm:p-6 border-l-4 border-[#a51c31]">
                <p class="text-lg sm:text-xl font-semibold text-[#a51c31]">
                    Satu Ruang Informasi untuk Inovasi Terintegrasi
                </p>
                <p class="text-sm text-gray-500 mt-1">
                    Badan Pusat Statistik Provinsi Lampung
                </p>
            </div>

            {{-- Description --}}
            <div class="prose prose-gray max-w-none space-y-4 text-gray-700 text-justify leading-relaxed">
                <p>
                    <strong>SERUIT</strong> (Satu Ruang Informasi untuk Inovasi Terintegrasi) adalah platform digital yang
                    dikembangkan oleh Badan Pusat Statistik (BPS) Provinsi Lampung sebagai pusat informasi dan katalog
                    aplikasi yang digunakan di lingkungan BPS.
                </p>

                <p>
                    Platform ini bertujuan untuk mempermudah akses dan pengelolaan informasi terkait berbagai aplikasi
                    yang dikembangkan dan digunakan oleh BPS, baik di tingkat pusat (BPS RI), provinsi (BPS Provinsi Lampung),
                    kabupaten/kota se-Provinsi Lampung, maupun aplikasi dari Kementerian/Lembaga/Dinas/Instansi (KLDI) terkait.
                </p>

                <h3 class="text-lg font-semibold text-gray-800 mt-6">Fitur Utama</h3>
                <ul class="list-disc pl-5 space-y-2">
                    <li><strong>Katalog Aplikasi</strong> — Daftar lengkap aplikasi berdasarkan kategori pembuat (BPS RI, BPS Provinsi, BPS Kab/Kota, KLDI).</li>
                    <li><strong>Pencarian</strong> — Fitur pencarian untuk menemukan aplikasi berdasarkan nama, deskripsi, atau kata kunci lainnya.</li>
                    <li><strong>Detail Aplikasi</strong> — Informasi lengkap setiap aplikasi termasuk deskripsi, jenis akses, pengguna, dan statistik kunjungan.</li>
                    <li><strong>Statistik Hits</strong> — Menampilkan aplikasi terpopuler berdasarkan jumlah kunjungan.</li>
                </ul>

                <h3 class="text-lg font-semibold text-gray-800 mt-6">Tujuan</h3>
                <p>
                    SERUIT hadir sebagai solusi untuk mengintegrasikan informasi berbagai aplikasi di lingkungan BPS
                    ke dalam satu platform yang mudah diakses. Dengan SERUIT, pengguna dapat dengan cepat menemukan,
                    memahami, dan mengakses aplikasi yang mereka butuhkan tanpa harus mencari di berbagai sumber yang berbeda.
                </p>
            </div>

            {{-- Back button --}}
            <div class="mt-8 pt-6 border-t border-gray-200">
                <a href="{{ route('home') }}"
                   class="inline-flex items-center gap-2 px-5 py-2.5 bg-[#a51c31] text-white font-semibold rounded-lg
                          shadow-md hover:bg-[#8b1728] focus:outline-none focus:ring-2 focus:ring-[#a51c31] focus:ring-opacity-50
                          transition-colors duration-200">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Kembali ke Beranda
                </a>
            </div>

        </div>
    </div>
@endsection
