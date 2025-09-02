<?php

namespace App\Http\Controllers;

use App\Models\ListApp;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index()
    {
        $list_bps_ri = ListApp::where('pembuat', 'BPS RI')->orderBy('nama', 'asc')->get();
        $list_bps_lampung = ListApp::where('pembuat', 'BPS Provinsi Lampung')->orderBy('nama', 'asc')->get();
        $list_bps_kabkota = ListApp::where('pembuat', 'BPS Kabupaten/Kota')->orderBy('nama', 'asc')->get();

        $top_hits = ListApp::orderBy('hits', 'desc')->take(10)->get();

        $top_items = $top_hits->toArray();
        $last_element = array_pop($top_items);
        array_unshift($top_items, $last_element);
        $top_hits = collect($top_items);

        return view('pages.index', compact('list_bps_ri', 'list_bps_lampung', 'list_bps_kabkota', 'top_hits'));
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

        return response()->json([
            'list_bps_ri' => $list_bps_ri,
            'list_bps_lampung' => $list_bps_lampung,
            'list_bps_kabkota' => $list_bps_kabkota,
        ]);
    }

    public function update_hits(Request $request)
    {
        $app = ListApp::findOrFail($request->input('id'));
        $app->hits += 1;
        $app->save();

        return response()->json(['success' => true, 'hits' => $app->hits]);
    }

    public function admin()
    {
        $list_apps = ListApp::all();
        return view('admin.index', compact('list_apps'));
    }

    public function create()
    {
        return view('admin.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'akses' => 'required|string|max:255',
            'pengguna' => 'required|string|max:255',
            'pembuat' => 'required|string|max:255',
            'link' => 'required|url|max:255',
            'logo' => 'mime:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $app = new ListApp;
        $app->nama = $request->nama;
        $app->deskripsi = $request->deskripsi;
        $app->akses = $request->akses;
        $app->pengguna = $request->pengguna;
        $app->pembuat = $request->pembuat;
        $app->link = $request->link;
        $app->hits = 0;

        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $image = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('/img'), $image);
            $app->logo = $image;
        } else {
            $app->logo = 'logo_bps.png';
        }

        $app->save();
        return redirect()->route('admin.index')->with('success', 'Aplikasi berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $app = ListApp::findOrFail($id);
        return view('admin.edit', compact('app'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'akses' => 'required|string|max:255',
            'pengguna' => 'required|string|max:255',
            'pembuat' => 'required|string|max:255',
            'link' => 'required|url|max:255',
            'logo' => 'mime:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $app = ListApp::findOrFail($id);
        $app->nama = $request->nama;
        $app->deskripsi = $request->deskripsi;
        $app->akses = $request->akses;
        $app->pengguna = $request->pengguna;
        $app->pembuat = $request->pembuat;
        $app->link = $request->link;

        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $image = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('/img'), $image);
            $app->logo = $image;
        }

        $app->save();
        return redirect()->route('admin.index')->with('success', 'Aplikasi berhasil diperbarui.');
    }

    public function delete($id)
    {
        $app = ListApp::findOrFail($id);
        File::delete(public_path('/img/' . $app->logo));

        $app->delete();
        return redirect()->route('admin.index')->with('success', 'Aplikasi berhasil dihapus.');
    }
}
