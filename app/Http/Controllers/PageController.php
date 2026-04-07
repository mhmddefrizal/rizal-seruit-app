<?php

namespace App\Http\Controllers;

use App\Models\ListApp;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index()
    {
        $list_bps_ri = ListApp::where('pembuat', 'BPS RI')->orderBy('nama', 'asc')->get();
        $list_bps_lampung = ListApp::where('pembuat', 'BPS Provinsi Lampung')->orderBy('nama', 'asc')->get();
        $list_bps_kabkota = ListApp::where('pembuat', 'BPS Kabupaten/Kota')->orderBy('nama', 'asc')->get();
        $list_kldi = ListApp::where('pembuat', 'KLDI')->orderBy('nama', 'asc')->get();

        $top_hits = ListApp::orderBy('hits', 'desc')->take(10)->get();

        $top_items = $top_hits->toArray();
        $last_element = array_pop($top_items);
        array_unshift($top_items, $last_element);
        $top_hits = collect($top_items);

        return view('pages.index', compact('list_bps_ri', 'list_bps_lampung', 'list_bps_kabkota', 'top_hits', 'list_kldi'));
    }

    public function kategori($slug)
    {
        $categories = [
            'bps-ri' => [
                'pembuat' => 'BPS RI',
                'title' => 'BPS RI',
                'showPembuat' => false,
                'borderColor' => '#EF4444',
            ],
            'bps-provinsi-lampung' => [
                'pembuat' => 'BPS Provinsi Lampung',
                'title' => 'BPS PROVINSI LAMPUNG',
                'showPembuat' => false,
                'borderColor' => '#8100D1',
            ],
            'bps-kabkota' => [
                'pembuat' => 'BPS Kabupaten/Kota',
                'title' => 'BPS KABUPATEN/KOTA SE-PROVINSI LAMPUNG',
                'showPembuat' => true,
                'borderColor' => '#66D0BC',
            ],
            'kldi' => [
                'pembuat' => 'KLDI',
                'title' => 'KEMENTRIAN/LEMBAGA/DINAS/INSTANSI',
                'showPembuat' => true,
                'borderColor' => '#57595B',
            ],
        ];

        if (! isset($categories[$slug])) {
            abort(404);
        }

        $category = $categories[$slug];
        $apps = ListApp::where('pembuat', $category['pembuat'])->orderBy('nama', 'asc')->get();

        $top_hits = ListApp::orderBy('hits', 'desc')->take(10)->get();
        $top_items = $top_hits->toArray();
        $last_element = array_pop($top_items);
        array_unshift($top_items, $last_element);
        $top_hits = collect($top_items);

        return view('pages.kategori', [
            'apps' => $apps,
            'title' => $category['title'],
            'showPembuat' => $category['showPembuat'],
            'borderColor' => $category['borderColor'],
            'top_hits' => $top_hits,
        ]);
    }

    public function search(Request $request)
    {
        $keyword = $request->keyword;
        $list_bps_ri = ListApp::where('pembuat', 'BPS RI')
            ->where(function ($query) use ($keyword) {
                $query->where('nama', 'like', "%$keyword%")
                    ->orWhere('deskripsi', 'like', "%$keyword%")
                    ->orWhere('akses', 'like', "%$keyword%")
                    ->orWhere('pengguna', 'like', "%$keyword%")
                    ->orWhere('pembuat', 'like', "%$keyword%");
            })
            ->orderBy('nama', 'asc')
            ->get();

        $list_bps_lampung = ListApp::where('pembuat', 'BPS Provinsi Lampung')
            ->where(function ($query) use ($keyword) {
                $query->where('nama', 'like', "%$keyword%")
                    ->orWhere('deskripsi', 'like', "%$keyword%")
                    ->orWhere('akses', 'like', "%$keyword%")
                    ->orWhere('pengguna', 'like', "%$keyword%")
                    ->orWhere('pembuat', 'like', "%$keyword%");
            })
            ->orderBy('nama', 'asc')
            ->get();

        $list_bps_kabkota = ListApp::where('pembuat', 'BPS Kabupaten/Kota')
            ->where(function ($query) use ($keyword) {
                $query->where('nama', 'like', "%$keyword%")
                    ->orWhere('deskripsi', 'like', "%$keyword%")
                    ->orWhere('akses', 'like', "%$keyword%")
                    ->orWhere('pengguna', 'like', "%$keyword%")
                    ->orWhere('pembuat', 'like', "%$keyword%");
            })
            ->orderBy('nama', 'asc')
            ->get();

        $list_kldi = ListApp::where('pembuat', 'KLDI')
            ->where(function ($query) use ($keyword) {
                $query->where('nama', 'like', "%$keyword%")
                    ->orWhere('deskripsi', 'like', "%$keyword%")
                    ->orWhere('akses', 'like', "%$keyword%")
                    ->orWhere('pengguna', 'like', "%$keyword%")
                    ->orWhere('pembuat', 'like', "%$keyword%");
            })
            ->orderBy('nama', 'asc')
            ->get();

        return response()->json([
            'list_bps_ri' => $list_bps_ri,
            'list_bps_lampung' => $list_bps_lampung,
            'list_bps_kabkota' => $list_bps_kabkota,
            'list_kldi' => $list_kldi,
        ]);
    }

    public function update_hits(Request $request)
    {
        $app = ListApp::findOrFail($request->item_id);
        $app->hits += 1;
        $app->save();

        return response()->json([
            'success' => true,
            'hits' => $app->hits,
            'url' => $app->link,
            'slug' => $app->slug,
            'id' => $app->id,
        ]);
    }

    public function tentang()
    {
        return view('pages.tentang');
    }

    public function info($slug)
    {

        $app = ListApp::where('slug', $slug)->first();
        $validation = $app->detail ? $app->detail : $app->deskripsi;

        return view('pages.detail', compact('app', 'validation'));
    }
}
