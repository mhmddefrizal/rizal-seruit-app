@extends('layouts.info')

@section('content')
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 sm:p-8 md:p-10 bg-white border-b border-gray-200">

            {{-- Header --}}
            <div class="flex items-center justify-center gap-3 mb-6">
                <h1 class="text-2xl sm:text-3xl font-bold text-gray-800">Tentang SERUIT</h1>
            </div>

            {{-- Subtitle --}}
            <div
                class="mb-8 bg-gradient-to-r from-[#a51c31]/5 to-transparent rounded-lg py-4 pr-4 pl-0 sm:py-6 sm:pr-6 sm:pl-0 border-l-4 border-[#a51c31]">
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
                    yang dikembangkan dan digunakan oleh BPS, baik di tingkat pusat (BPS RI), provinsi (BPS Provinsi
                    Lampung),
                    kabupaten/kota se-Provinsi Lampung, maupun aplikasi dari Kementerian/Lembaga/Dinas/Instansi (KLDI)
                    terkait.
                </p>

                <h3 class="text-lg font-semibold text-gray-800 mt-6">Fitur Utama</h3>
                <ul class="list-disc pl-5 space-y-2">
                    <li><strong>Katalog Aplikasi</strong> — Daftar lengkap aplikasi berdasarkan kategori pembuat (BPS RI,
                        BPS Provinsi, BPS Kab/Kota, KLDI).</li>
                    <li><strong>Pencarian</strong> — Fitur pencarian untuk menemukan aplikasi berdasarkan nama, deskripsi,
                        atau kata kunci lainnya.</li>
                    <li><strong>Detail Aplikasi</strong> — Informasi lengkap setiap aplikasi termasuk deskripsi, jenis
                        akses, pengguna, dan statistik kunjungan.</li>
                    <li><strong>Statistik Hits</strong> — Menampilkan aplikasi terpopuler berdasarkan jumlah kunjungan.</li>
                </ul>

                <h3 class="text-lg font-semibold text-gray-800 mt-6">Tujuan</h3>
                <p>
                    SERUIT hadir sebagai solusi untuk mengintegrasikan informasi berbagai aplikasi di lingkungan BPS
                    ke dalam satu platform yang mudah diakses. Dengan SERUIT, pengguna dapat dengan cepat menemukan,
                    memahami, dan mengakses aplikasi yang mereka butuhkan tanpa harus mencari di berbagai sumber yang
                    berbeda.
                </p>
            </div>

            <!-- buat informasi tentang tim -->
            {{-- Tim Pengembang --}}
            <div class="mt-10">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Tim Pengembang</h3>

                <div class="bg-gray-50 rounded-lg p-6 border border-gray-200">
                    <p class="text-gray-700 leading-relaxed text-justify">
                        Aplikasi <strong>SERUIT</strong> merupakan hasil kolaborasi dari berbagai pihak yang berkontribusi
                        dalam
                        pengembangan sistem informasi di lingkungan Badan Pusat Statistik Provinsi Lampung.
                    </p>

                    <ul class="list-disc pl-5 mt-4 space-y-2 text-gray-700">
                        <li><strong>Tim IT BPS Provinsi Lampung</strong> — Sebagai pengarah dan pengembang utama sistem.
                        </li>
                        <li><strong>Mahasiswa Universitas Lampung (UNILA)</strong> — Berkontribusi dalam pengembangan fitur
                            utama dan implementasi awal aplikasi</li>
                        <li><strong>Mahasiswa Universitas Teknokrat Indonesia (UTI)</strong> — Mengembangkan tampilan,
                            navigasi kategori, pop-up, responsivitas, dan filter akses aplikasi.</li>
                    </ul>

                    <p class="mt-4 text-sm text-gray-500">
                        Kolaborasi ini diharapkan dapat menghasilkan inovasi digital yang bermanfaat dan berkelanjutan.
                    </p>
                </div>
            </div>
        </div>
    @endsection
