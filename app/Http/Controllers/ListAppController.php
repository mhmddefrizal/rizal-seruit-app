<?php

namespace App\Http\Controllers;

use App\Models\ListApp;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class ListAppController extends Controller
{

    public function index()
    {
        $list_apps = ListApp::latest()->get();
        return view('pages.listapp.index', compact('list_apps'));
    }

    public function create()
    {
        return view('pages.listapp.create');
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
        $app->slug = Str::uuid();
        $app->user_id = auth()->id();

        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $image = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('/img'), $image);
            $app->logo = $image;
        } else {
            $app->logo = 'logo_bps.png';
        }

        $app->save();
        return redirect()->route('listapp.index')->with('success', 'Aplikasi berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $app = ListApp::findOrFail($id);
        return view('listapp.edit', compact('app'));
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
        return redirect()->route('dashboard.index')->with('success', 'Aplikasi berhasil diperbarui.');
    }

    public function delete($id)
    {
        $app = ListApp::findOrFail($id);
        File::delete(public_path('/img/' . $app->logo));

        $app->delete();
        return redirect()->route('dashboard.index')->with('success', 'Aplikasi berhasil dihapus.');
    }
}
