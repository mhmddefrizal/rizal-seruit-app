<?php

namespace App\Http\Controllers;

use App\Models\ListApp;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use SweetAlert2\Laravel\Swal;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class ListAppController extends Controller
{

    public function index()
    {
        $apps_menu = 'Kelola Aplikasi';
        $apps_submenu = 'Daftar Aplikasi';
        $list_apps = ListApp::latest()->get();
        return view('pages.listapp.index', compact('list_apps', 'apps_menu', 'apps_submenu'));
    }

    public function create()
    {
        $apps_menu = 'Kelola Aplikasi';
        $apps_submenu = 'Tambah Aplikasi';
        return view('pages.listapp.create', compact('apps_menu', 'apps_submenu'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'detail' => 'required|string',
            'akses' => 'required|string|max:255',
            'pengguna' => 'required|string|max:255',
            'pembuat' => 'required|string|max:255',
            'link' => 'required|url|max:255',
            'logo' => 'mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $app = new ListApp;
        $app->nama = $request->nama;
        $app->deskripsi = $request->deskripsi;
        $app->detail = $request->detail;
        $app->akses = $request->akses;
        $app->pengguna = $request->pengguna;
        $app->pembuat = $request->pembuat;
        $app->link = $request->link;
        $app->hits = 0;
        $app->slug = Str::uuid();
        $app->user_id = Auth::id();

        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $image = time() . '_' . $file->getClientOriginalName();
            $destination = public_path('img');
            if ($file->move($destination, $image)) {
                $app->logo = $image;
            } else {
                $app->logo = 'logo_bps.png';
            }
        }

        $app->save();
        Swal::fire([
            'title' => 'Informasi',
            'text' => 'Aplikasi ' . $app->nama . ' berhasil ditambahkan!',
            'icon' => 'success',
            'confirmButtonText' => 'Tutup'
        ]);
        return redirect()->route('listapp.index');
    }

    public function show($slug)
    {
        $apps_menu = 'Kelola Aplikasi';
        $apps_submenu = 'Detail Aplikasi';
        $app = ListApp::where('slug', $slug)->firstOrFail();
        return view('pages.listapp.view', compact('app', 'apps_menu', 'apps_submenu'));
    }

    public function edit($slug)
    {
        $apps_menu = 'Kelola Aplikasi';
        $apps_submenu = 'Edit Aplikasi';
        $app = ListApp::where('slug', $slug)->firstOrFail();
        return view('pages.listapp.edit', compact('app', 'apps_menu', 'apps_submenu'));
    }

    public function update(Request $request, $slug)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'detail' => 'required|string',
            'akses' => 'required|string|max:255',
            'pengguna' => 'required|string|max:255',
            'pembuat' => 'required|string|max:255',
            'link' => 'required|url|max:255',
            'logo' => 'mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $app = ListApp::where('slug', $slug)->firstOrFail();
        $app->nama = $request->nama;
        $app->deskripsi = $request->deskripsi;
        $app->detail = $request->detail;
        $app->akses = $request->akses;
        $app->pengguna = $request->pengguna;
        $app->pembuat = $request->pembuat;
        $app->link = $request->link;

        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $image = time() . '_' . $file->getClientOriginalName();
            $destination = public_path('img');
            if ($file->move($destination, $image)) {
                $app->logo = $image;
            } else {
                $app->logo = 'logo_bps.png';
            }
        }

        $app->save();
        Swal::fire([
            'title' => 'Informasi',
            'text' => 'Aplikasi ' . $app->nama . ' berhasil diperbaharui!',
            'icon' => 'success',
            'confirmButtonText' => 'Tutup'
        ]);
        return redirect()->route('listapp.index');
    }

    public function destroy($slug)
    {
        $app = ListApp::where('slug', $slug)->firstOrFail();
        if ($app->logo != 'logo_bps.png') {
            File::delete(public_path('/img/' . $app->logo));
        }

        $app->delete();
        Swal::fire([
            'title' => 'Informasi',
            'text' => 'Aplikasi ' . $app->nama . ' berhasil dihapus!',
            'icon' => 'success',
            'confirmButtonText' => 'Tutup'
        ]);
        return redirect()->route('listapp.index');
    }
}
