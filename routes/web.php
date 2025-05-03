<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoomController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\AdminReservationController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\CheckRole;


// Halaman Landing
Route::get('/', [LandingController::class, 'index'])->name('landing');

// Rute login dan register untuk user yang belum login
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store']);
    Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('/register', [RegisteredUserController::class, 'store']);
});

Route::middleware(['auth'])->group(function () {

    Route::get('/users/profile', [UserController::class, 'profile'])->name('users.profile');

    // Admin Routes
    // Route::middleware(['role:admin'])->group(function () {
    // Route::get('/admin/reservations', [AdminReservationController::class, 'index'])->name('admin.reservations');
    // });
});

Route::middleware([CheckRole::class . ':admin'])->group(function () {
    Route::get('/admin/reservations', [AdminReservationController::class, 'index'])->name('admin.reservations');
});

// Rute dashboard hanya untuk user yang sudah login
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::resource('rooms', RoomController::class);
    Route::resource('reservations', ReservationController::class);
});

require __DIR__ . '/auth.php';
