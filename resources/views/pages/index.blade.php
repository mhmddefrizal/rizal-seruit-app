@extends('layouts.app')

@section('content')
    {{-- Section heading --}}
    <div class="max-w-screen-xl mb-4">
        <h2 class="text-lg font-bold text-gray-800 flex items-center gap-2">
            <span class="w-1 h-5 bg-[#1EA05E] rounded-full inline-block"></span>
            Kategori Aplikasi
        </h2>
        <p class="text-xs text-gray-400 mt-0.5 ml-3">Pilih kategori untuk melihat daftar aplikasi</p>
    </div>

    {{-- Category Cards — 4 per row --}}
    <div class="grid grid-cols-2 sm:grid-cols-4 gap-6">
        <x-category-card href="{{ route('kategori', 'bps-ri') }}" title="BPS RI"
            description="Aplikasi yang dikembangkan dan dikelola oleh BPS Pusat (BPS RI)" :count="count($list_bps_ri)"
            color="#1EA05E" icon="ri" />

        <x-category-card href="{{ route('kategori', 'bps-provinsi-lampung') }}" title="BPS PROVINSI LAMPUNG"
            description="Aplikasi yang dikembangkan dan dikelola oleh BPS Provinsi Lampung"
            :count="count($list_bps_lampung)" color="#2B7CB3" icon="provinsi" />

        <x-category-card href="{{ route('kategori', 'bps-kabkota') }}" title="BPS KAB/KOTA SE-PROV. LAMPUNG"
            description="Aplikasi yang dikembangkan oleh BPS Kabupaten/Kota se-Provinsi Lampung"
            :count="count($list_bps_kabkota)" color="#E57A25" icon="kabkota" />

        <x-category-card href="{{ route('kategori', 'kldi') }}" title="KEMENTRIAN/LEMBAGA/DINAS/INSTANSI"
            description="Aplikasi dari Kementerian, Lembaga, Dinas, dan Instansi terkait" :count="count($list_kldi)"
            color="#8B5CF6" icon="kldi" />
    </div>
@endsection