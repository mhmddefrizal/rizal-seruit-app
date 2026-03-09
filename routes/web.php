<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ListAppController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'index'])->name('home');
Route::get('/kategori/{slug}', [PageController::class, 'kategori'])->name('kategori');
Route::post('/search', [PageController::class, 'search'])->name('search');
Route::post('/update-hits', [PageController::class, 'update_hits'])->name('update_hits');

// Detail tiap app
Route::get('/info/{slug}', [PageController::class, 'info'])->name('info');

Route::prefix('admin')->middleware(['auth', 'verified'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('admin.index');

    Route::prefix('listapp')->group(function () {
        Route::get('/', [ListAppController::class, 'index'])->name('listapp.index');
        Route::get('/create', [ListAppController::class, 'create'])->name('listapp.create');
        Route::post('/create', [ListAppController::class, 'store'])->name('listapp.store');
        Route::get('/{slug}/show', [ListAppController::class, 'show'])->name('listapp.show');
        Route::get('/{slug}/edit', [ListAppController::class, 'edit'])->name('listapp.edit');
        Route::put('/{slug}', [ListAppController::class, 'update'])->name('listapp.update');
        Route::delete('/{slug}', [ListAppController::class, 'destroy'])->name('listapp.delete');
    });

    Route::prefix('users')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('users.index');
        Route::get('/create', [UserController::class, 'create'])->name('users.create');
        Route::post('/create', [UserController::class, 'store'])->name('users.store');
        Route::get('/{slug}/show', [UserController::class, 'show'])->name('users.show');
        Route::get('/{slug}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::put('/{slug}', [UserController::class, 'update'])->name('users.update');
        Route::delete('/{slug}', [UserController::class, 'destroy'])->name('users.delete');
    });
});
