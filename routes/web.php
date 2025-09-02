<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ListAppController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'index'])->name('home');
Route::post('/search', [PageController::class, 'search'])->name('search');
Route::post('/update-hits', [PageController::class, 'update_hits'])->name('update_hits');

Route::prefix('admin')->middleware(['auth', 'verified'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('admin.index');

    Route::prefix('listapp')->group(function () {
        Route::get('/', [ListAppController::class, 'index'])->name('listapp.index');
        Route::get('/create', [ListAppController::class, 'create'])->name('listapp.create');
        Route::post('/create', [ListAppController::class, 'store'])->name('listapp.store');
        Route::get('/show', [ListAppController::class, 'show'])->name('listapp.show');
        Route::get('/edit', [ListAppController::class, 'edit'])->name('listapp.edit');
        Route::post('/update', [ListAppController::class, 'update'])->name('listapp.update');
        Route::post('/delete', [ListAppController::class, 'delete'])->name('listapp.delete');
    });
});
