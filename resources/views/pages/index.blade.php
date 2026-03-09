@extends('layouts.app')

@section('content')
  {{-- Category Cards --}}
  <div class="grid lg:grid-cols-3 sm:grid-cols-2 grid-cols-1 gap-4 mt-2">
    <x-category-card href="{{ route('kategori', 'bps-ri') }}" title="BPS RI"
      description="Aplikasi yang dikembangkan dan dikelola oleh BPS Pusat (BPS RI)" :count="count($list_bps_ri)"
      color="#1EA05E" />
    <x-category-card href="{{ route('kategori', 'bps-provinsi-lampung') }}" title="BPS PROVINSI LAMPUNG"
      description="Aplikasi yang dikembangkan dan dikelola oleh BPS Provinsi Lampung" :count="count($list_bps_lampung)"
      color="#2B7CB3" />
    <x-category-card href="{{ route('kategori', 'bps-kabkota') }}" title="BPS KABUPATEN/KOTA SE-PROVINSI LAMPUNG"
      description="Aplikasi yang dikembangkan oleh BPS Kabupaten/Kota se-Provinsi Lampung"
      :count="count($list_bps_kabkota)" color="#E57A25" />
    <x-category-card href="{{ route('kategori', 'kldi') }}" title="KEMENTRIAN/LEMBAGA/DINAS/INSTANSI"
      description="Aplikasi dari Kementerian, Lembaga, Dinas, dan Instansi terkait" :count="count($list_kldi)"
      color="#8B5CF6" />
  </div>
@endsection