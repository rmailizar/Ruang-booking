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

    //History booking
    Route::get('/my-bookings', [RoomBookingController::class, 'myBookings'])->name('bookings.myBookings');
    Route::get('/admin/my-bookings', [RoomBookingController::class, 'myBookings'])->name('admin.my_bookings');
    Route::get('/user/my-bookings', [RoomBookingController::class, 'myBookings'])->name('user.my_bookings');


    //Crud Room Booking
    Route::get('/rooms/show', [RoomController::class, 'index'])->name('rooms.index');
    // Admin - lihat semua booking
    Route::get('/bookings', [RoomBookingController::class, 'index'])->name('bookings.index');
    
    // Halaman daftar ruangan untuk dipinjam (dengan tombol "Pinjam")
    Route::get('/booking-ruangan', [RoomBookingController::class, 'roomList'])->name('bookings.roomList');

    // Ajukan booking
    Route::get('/bookings/create', [RoomBookingController::class, 'create'])->name('bookings.create');
    Route::post('/bookings', [RoomBookingController::class, 'store'])->name('bookings.store');

    // Admin - update status atau hapus
    Route::put('/bookings/{booking}/status', [RoomBookingController::class, 'updateStatus'])->name('bookings.updateStatus');
    Route::delete('/bookings/{booking}', [RoomBookingController::class, 'destroy'])->name('bookings.destroy');

    //logout
    Route::get('/logout', [SesiController::class, 'logout'])->name('logout');
});

Route::prefix('admin')->middleware(['auth', 'userAkses:admin'])->group(function () {
    // Admin Dashboard
    Route::get('/', [AdminController::class, 'index'])->name('admin.dashboard');

    //Download History Booking
    Route::get('/export-bookings', [RoomBookingController::class, 'export'])->name('bookings.export');

    //Crud Room
    Route::get('/rooms/create', [RoomController::class, 'create'])->name('rooms.create');
    Route::post('/rooms/store', [RoomController::class, 'store'])->name('rooms.store');
    Route::get('/rooms/{room}/edit', [RoomController::class, 'edit'])->name('rooms.edit');
    Route::put('/rooms/{room}', [RoomController::class, 'update'])->name('rooms.update');
    Route::delete('/rooms/{room}', [RoomController::class, 'destroy'])->name('rooms.destroy');

    //Crud User
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
    //User Dashboard
    Route::get('/', [UserController::class, 'user'])->name('user.dashboard');
});

