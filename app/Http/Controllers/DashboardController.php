<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\ListApp;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Mendapatkan data hits untuk 7 hari terakhir
        $hits = DB::table('list_apps')
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('COUNT(hits) as total'))
            ->where('created_at', '>=', Carbon::now()->subDays(6))
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();

        // Mengubah data menjadi format yang siap untuk Chart.js
        $labels = $hits->pluck('date');
        $data = $hits->pluck('total');

        // Mendapatkan total aplikasi, total aplikasi berdasarkan akses, total aplikasi berdasarkan pengguna, dan total aplikasi berdasarkan pembuat
        $total_apps = ListApp::all()->count();
        $total_bps_ri = ListApp::where('pembuat', 'BPS RI')->count();
        $total_bps_prov = ListApp::where('pembuat', 'BPS Provinsi Lampung')->count();
        $total_bps_kabkota = ListApp::where('pembuat', 'BPS Kabupaten/Kota')->count();
        $total_kldi = ListApp::where('pembuat', 'KLDI')->count();

        return view('pages.dashboard', compact(['labels', 'data', 'total_apps', 'total_bps_ri', 'total_bps_prov', 'total_bps_kabkota', 'total_kldi']));
    }
}
