<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\RoomBookingController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\SesiController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserDBController;
use Illuminate\Support\Facades\Route;
use PHPUnit\Framework\Attributes\Group;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::redirect('/', '/auth/login');
Route::middleware(['guest'])->group(function(){
    Route::get('/auth/login', [SesiController::class, 'index'])->name('login');
    Route::post('/auth/login', [SesiController::class, 'login']);
    Route::get('/auth/register', [RegisterController::class, 'showRegisterForm'])->name('register');
    Route::post('/auth/register', [RegisterController::class, 'register'])->name('register.post');
});

Route::middleware(['auth'])->group(function(){
    // History booking
    Route::get('/my-bookings', [RoomBookingController::class, 'myBookings'])->name('bookings.myBookings');

    // Batalkan booking
    Route::delete('/bookings/{booking}', [RoomBookingController::class, 'cancel'])->name('bookings.cancel');

    // Lihat Room 
    Route::get('/rooms/show', [RoomController::class, 'index'])->name('rooms.index');

    // Halaman daftar ruangan untuk dipinjam (dengan tombol "Pinjam")
    Route::get('/booking-ruangan', [RoomBookingController::class, 'roomList'])->name('bookings.roomList');

    // Detail Ruangan
    Route::get('/rooms/{id}/detail', [RoomBookingController::class, 'roomDetail'])->name('rooms.detail');

    // Ajukan booking
    Route::get('/bookings/create', [RoomBookingController::class, 'create'])->name('bookings.create');
    Route::post('/bookings', [RoomBookingController::class, 'store'])->name('bookings.store');

    // Profile
    Route::get('/biodata', [SesiController::class, 'biodata'])->name('biodata');

    // Edit profile/biodata
    Route::get('/profile/edit', [UserDBController::class, 'editProfile'])->name('profile.edit');
    Route::put('/profile/update', [UserDBController::class, 'updateProfile'])->name('profile.update');

    // logout
    Route::get('/logout', [SesiController::class, 'logout'])->name('logout');
});

Route::prefix('admin')->middleware(['auth', 'userAkses:admin'])->group(function () {
    // Admin Dashboard
    Route::get('/', [AdminController::class, 'index'])->name('admin.dashboard');
        
    // Admin - lihat semua booking
    Route::get('/bookings', [RoomBookingController::class, 'index'])->name('bookings.index');

    // Admin - Edit Booking
    Route::get('/bookings/{booking}/edit', [RoomBookingController::class, 'edit'])->name('bookings.edit');
    Route::put('/bookings/{booking}', [RoomBookingController::class, 'update'])->name('bookings.update');
    
    // Admin - update status booking atau hapus booking
    Route::put('/bookings/{booking}/status', [RoomBookingController::class, 'updateStatus'])->name('bookings.updateStatus');
    Route::delete('/bookings/{booking}', [RoomBookingController::class, 'destroy'])->name('bookings.destroy');

    Route::get('/bookings/{id}/approve', [RoomBookingController::class, 'approve'])->name('approve');
    Route::post('/bookings/{id}/reject', [RoomBookingController::class, 'reject'])->name('reject');


    // Admin - Download History Booking
    Route::get('/export-bookings', [RoomBookingController::class, 'export'])->name('bookings.export');

    // Admin - Crud Room
    Route::get('/rooms/create', [RoomController::class, 'create'])->name('rooms.create');
    Route::post('/rooms/store', [RoomController::class, 'store'])->name('rooms.store');
    Route::get('/rooms/{room}/edit', [RoomController::class, 'edit'])->name('rooms.edit');
    Route::put('/rooms/{room}', [RoomController::class, 'update'])->name('rooms.update');
    Route::delete('/rooms/{room}', [RoomController::class, 'destroy'])->name('rooms.destroy');

    // Admin - Crud User
    Route::resource('users', UserDBController::class)->names([
        'index' => 'admin.users.index',
        'create' => 'admin.users.create',
        'store' => 'admin.users.store',
        'edit' => 'admin.users.edit',
        'update' => 'admin.users.update',
        'destroy' => 'admin.users.destroy',
    ]);
});

Route::prefix('user')->middleware(['auth', 'userAkses:user'])->group(function () {
    // User Dashboard
    Route::get('/', [UserController::class, 'user'])->name('user.dashboard');
});

