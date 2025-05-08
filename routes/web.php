<?php

use App\Http\Controllers\Admin\AuthenticationRequestController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;


Route::get('/',function () {
        return redirect()->route("login");
    }
);

// Route::prefix('/users')->middleware(['auth', 'verified'])->controller(UserController::class)->group(function () {
//     Route::get('/', 'index')->name('users.all');
//     Route::get('/create', 'create')->name('user.create');
//     Route::get('/edit/{id}','editUser')->name('user.edit');
//     Route::post('/update/{id}', 'updateUser')->name('user.update');
//     Route::delete('/delete/{id}','deleteUser')->name('user.delete');
// });
Route::get('/approval', function () {
    return Inertia::render('Approval');
})->middleware(['auth', 'verified'])->name('approval');


Route::prefix('/')->middleware(['auth', 'verified'])->group(function () {

    

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/chart-data', [DashboardController::class, 'userChartData'])->name('dashboard.chart.data');
    Route::get('/users', [UserController::class, 'index'])->middleware(['cookie.approvalConfirm'])->name('users.all');
    Route::get('/users/create', [UserController::class, 'create'])->name('user.create');
    Route::get('/users/edit/{id}', [UserController::class, 'editUser'])->name('user.edit');
    Route::post('/users/update/{id}', [UserController::class, 'updateUser'])->name('user.update');
    Route::delete('/users/delete/{id}', [UserController::class, 'deleteUser'])->name('user.delete');

    Route::prefix('/auth_request')->controller(AuthenticationRequestController::class)->group(function(){
        Route::get('/','index')->name('auth_request.index');
        Route::post('/update/{id}', 'update')->name('auth_request.update');
    });
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
