<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::prefix('/')->middleware(['auth', 'verified'])->controller(DashboardController::class)->group(function () {
    Route::get('dashboard', 'index')->name('dashboard');
    Route::get('create', 'create')->name('create');
    Route::get('edit/{id}','editUser')->name('editUser');
    Route::post('update/{id}', 'updateUser')->name('updateUser');
    Route::delete('delete/{id}','deleteUser')->name('deleteUser');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
