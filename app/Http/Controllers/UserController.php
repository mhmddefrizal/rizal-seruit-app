<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use SweetAlert2\Laravel\Swal;

class UserController extends Controller
{
    public function index()
    {
        $users_menu = 'Kelola Pengguna';
        $users_submenu = 'Daftar Pengguna';
        $users = User::latest()->get();
        return view('pages.user.index', compact('users', 'users_menu', 'users_submenu'));
    }

    public function show($slug)
    {
        $users_menu = 'Kelola Pengguna';
        $users_submenu = 'Tambah Pengguna';
        $user = User::where('slug', $slug)->firstOrFail();
        return view('pages.user.view', compact('user', 'users_menu', 'users_submenu'));
    }

    public function create()
    {
        $users_menu = 'Kelola Pengguna';
        $users_submenu = 'Tambah Pengguna';
        return view('pages.user.create', compact('users_menu', 'users_submenu'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email',
            'password' => 'required|string|max:255',
            'role' => 'required|string|max:255',
        ]);

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->pasword);
        $user->role = $request->role;
        $user->slug = Str::uuid();
        $user->status = true;

        $user->save();
        Swal::fire([
            'title' => 'Informasi',
            'text' => 'Pengguna ' . $user->name . ' berhasil ditambahkan!',
            'icon' => 'success',
            'confirmButtonText' => 'Tutup'
        ]);
        return redirect()->route('users.index');
    }

    public function edit($slug)
    {
        $user = User::where('slug', $slug)->firstOrFail();
        $users_menu = 'Kelola Pengguna';
        $users_submenu = 'Edit Pengguna';
        return view('pages.user.edit', compact('user', 'users_menu', 'users_submenu'));
    }

    public function update(Request $request, $slug)
    {
        $user = User::where('slug', $slug)->firstOrFail();
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string',
            'role' => 'required|string|max:255',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        // Cek apakah user mengisi password baru
        if (!empty($request->password)) {
            $user->password = bcrypt($request->password);
        }
        $user->role = $request->role;

        $user->save();
        Swal::fire([
            'title' => 'Informasi',
            'text' => 'Pengguna ' . $user->name . ' berhasil diperbaharui!',
            'icon' => 'success',
            'confirmButtonText' => 'Tutup'
        ]);
        return redirect()->route('users.index');
    }

    public function destroy($slug)
    {
        $user = User::where('slug', $slug)->firstOrFail();
        $user->delete();
        Swal::fire([
            'title' => 'Informasi',
            'text' => 'Aplikasi ' . $user->name . ' berhasil dihapus!',
            'icon' => 'success',
            'confirmButtonText' => 'Tutup'
        ]);
        return redirect()->route('users.index');
    }
}
