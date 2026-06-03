<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SuperAdmin\UserController;
use App\Http\Controllers\SuperAdmin\HotelController;
use App\Http\Controllers\AdminHotel\DashboardController;
use App\Http\Controllers\AdminHotel\RoomController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\PublicHotelController;

// RUTA HOME
Route::get('/', function () {
    if (auth()->check()) {
        if (auth()->user()->role === 'admin_hotel') return redirect()->route('admin.hotel.dashboard');
        if (auth()->user()->role === 'super_admin') return redirect()->route('superadmin.dashboard');
    }
    return app(PublicHotelController::class)->index();
})->name('home');

// RUTAS PÚBLICAS
Route::get('/hotels/{hotel}', [PublicHotelController::class, 'show'])->name('hotels.show');

// SUPER ADMIN
Route::middleware(['auth', 'role:super_admin'])->prefix('super-admin')->group(function () {
    Route::get('/dashboard', fn() => view('superadmin.dashboard'))->name('superadmin.dashboard');
    Route::resource('hotels', HotelController::class)->names('superadmin.hotels');
    Route::resource('users', UserController::class)->names('superadmin.users');
});

// ADMIN HOTEL
Route::middleware(['auth', 'role:admin_hotel'])->prefix('admin-hotel')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.hotel.dashboard');
    Route::resource('rooms', RoomController::class)->names('admin.rooms');
    
    // Gestión de reservas recibidas
    Route::get('/reservations', [ReservationController::class, 'adminIndex'])->name('admin.reservations.index');
    
    // ✅ RUTAS DE APROBAR / RECHAZAR
    Route::patch('/reservations/{reservation}/approve', [ReservationController::class, 'approve'])->name('admin.reservations.approve');
    Route::patch('/reservations/{reservation}/reject', [ReservationController::class, 'reject'])->name('admin.reservations.reject');
    
    Route::get('/hotel-info', function () {
        $hotel = auth()->user()->hotel;
        if (! $hotel) abort(403, 'No tienes hotel asignado');
        return view('admin.hotel.show', compact('hotel'));
    })->name('admin.hotel.show');
});

// USER (CLIENTES)
Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/hotels-list', [PublicHotelController::class, 'index'])->name('hotels.index');
    
    // Mis reservas del cliente
    Route::get('/my-reservations', [ReservationController::class, 'index'])->name('reservations.index');
    
    Route::get('/rooms/{room}/reservar', [ReservationController::class, 'create'])->name('reservations.create');
    Route::post('/rooms/{room}/reservar', [ReservationController::class, 'store'])->name('reservations.store');
});

// PERFIL Y CANCELACIÓN (Compartido)
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::patch('/reservations/{reservation}/cancel', [ReservationController::class, 'cancel'])->name('reservations.cancel');
});

require __DIR__.'/auth.php';