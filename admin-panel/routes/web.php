<?php

use App\Http\Controllers\Admin\WeddingController;
use App\Http\Controllers\WeddingViewController;
use App\Http\Controllers\RsvpController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

// 1. Halaman Utama / Landing Page Publik
Route::get('/', function () {
    return view('welcome');
});

// 2. RUTE AUTH (Hanya bisa diakses jika belum login / guest)
Route::middleware('guest')->group(function () {
    // Jalur Login
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    // Rute tunggal untuk pendaftaran bertahap (URL tetap bersih)
    Route::get('/register-admin', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register-admin', [AuthController::class, 'register'])->name('register.store');

    Route::post('/check-username', [AuthController::class, 'checkUsername'])->name('register.checkUsername');
    Route::post('/check-email', [AuthController::class, 'checkEmail'])->name('register.checkEmail');

    // Jalur Verifikasi OTP
    Route::get('/verify-otp', [AuthController::class, 'showOtpForm'])->name('otp.view');
    Route::post('/verify-otp', [AuthController::class, 'verifyOtp'])->name('otp.verify');
});

// 3. Grouping URL untuk Admin Panel NantiKita (Harus Login / auth)
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {

    // Halaman Utama Dashboard Admin
    Route::get('/', [WeddingController::class, 'dashboard'])->name('dashboard');

    // RSVP Global (Taruh di atas weddings rsvps agar tidak bentrok)
    Route::get('rsvps', [WeddingController::class, 'globalRsvps'])->name('rsvps.global');

    // Jalur RSVP spesifik per client
    Route::get('weddings/{id}/rsvps', [WeddingController::class, 'showRsvps'])->name('weddings.rsvps');

    // Otomatis membuat rute CRUD weddings
    Route::resource('weddings', WeddingController::class);

    // Jalur Keluar Sistem / Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

// 4. Rute Publik untuk Undangan & Kirim RSVP (Akses Tamu)
Route::get('/wedding/{slug}', [WeddingViewController::class, 'show'])->name('wedding.show');
Route::post('/wedding/{slug}/rsvp', [RsvpController::class, 'store'])->name('rsvp.store');

// 5. Rute Katalog Undangan
Route::get('/katalog', function () {
    return view('katalog');
});

// Hapus atau komen route ini kalau UI sudah beres dan mau production
Route::get('/preview-otp', function () {
    return view('auth.otp');
});