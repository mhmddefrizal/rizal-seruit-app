@extends('layouts.auth')

@section('content')
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-semibold text-gray-800">Dashboard</h2>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="bg-red-200 rounded-lg shadow-md p-6">
                    <p class="text-sm font-medium text-gray-900">Apps BPS Selindo</p>
                    <p class="mt-1 text-2xl font-semibold text-gray-900">{{ $total_bps_ri }}</p>
                </div>

                <div class="bg-yellow-200 rounded-lg shadow-md p-6">
                    <p class="text-sm font-medium text-gray-900">Apps BPS Provinsi</p>
                    <p class="mt-1 text-2xl font-semibold text-gray-900">{{ $total_bps_prov }}</p>
                </div>

                <div class="bg-green-200 rounded-lg shadow-md p-6">
                    <p class="text-sm font-medium text-gray-900">Apps BPS Kab/Kota</p>
                    <p class="mt-1 text-2xl font-semibold text-gray-900">{{ $total_bps_kabkota }}</p>
                </div>

                <div class="bg-blue-200 rounded-lg shadow-md p-6">
                    <p class="text-sm font-medium text-gray-900">Apps K/L/D/I</p>
                    <p class="mt-1 text-2xl font-semibold text-gray-900">{{ $total_kldi }}</p>
                </div>
            </div>

            <div class="bg-gray-100 rounded-lg shadow-md p-6 mt-3">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Total Hits Harian</h2>
                <canvas id="hitsChart"></canvas>
            </div>

        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Ambil data dari variabel PHP yang dikirim oleh controller
        const labels = @json($labels);
        const data = @json($data);

        const ctx = document.getElementById('hitsChart').getContext('2d');
        const hitsChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Total Hits',
                    data: data,
                    // Mengubah warna garis menjadi hitam
                    borderColor: '#000000',
                    backgroundColor: 'rgba(0, 0, 0, 0.2)',
                    borderWidth: 2,
                    tension: 0.4,
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        // Memberikan jeda agar tidak di titik nol
                        beginAtZero: false,
                        suggestedMin: 10, // Nilai minimum yang disarankan
                    },
                    x: {
                        offset: true
                    }
                }
            }
        });
    </script>
@endpush
