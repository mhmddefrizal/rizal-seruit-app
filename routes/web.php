<?php

use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'index'])->name('home');
Route::post('/search', [PageController::class, 'search'])->name('search');
Route::post('/update-hits', [PageController::class, 'update_hits'])->name('update_hits');
