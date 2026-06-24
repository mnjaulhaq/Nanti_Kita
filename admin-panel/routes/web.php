<?php

use App\Http\Controllers\Admin\WeddingController;
use App\Http\Controllers\WeddingViewController;
use App\Http\Controllers\RsvpController;
use App\Http\Controllers\AuthController; // <-- 1. TAMBAHKAN IMPORT INI
use Illuminate\Support\Facades\Route;

// // 1. Halaman Utama / Landing Page Publik
Route::get('/', function () {
    return view('welcome');
});

// <-- 2. TAMBAHKAN RUTE AUTH (GUEST) DI SINI
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    // Rute untuk mendaftarkan akun admin pertama kali
    Route::get('/register-admin', [AuthController::class, 'showRegister']);
    Route::post('/register-admin', [AuthController::class, 'register'])->name('register.store');

    // TAMBAHKAN DUA RUTE OTP INI DI SINI
    Route::get('/verify-otp', [AuthController::class, 'showOtpForm'])->name('otp.view');
    Route::post('/verify-otp', [AuthController::class, 'verifyOtp'])->name('otp.verify');
});

// // 2. Grouping URL untuk Admin Panel NantiKita.
// <-- 3. TAMBAHKAN middleware('auth') di grup ini agar aman
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {

    Route::get('/', [WeddingController::class, 'dashboard'])->name('dashboard');

    Route::get('rsvps', [WeddingController::class, 'globalRsvps'])->name('rsvps.global');

    Route::get('weddings/{id}/rsvps', [WeddingController::class, 'showRsvps'])->name('weddings.rsvps');

    Route::resource('weddings', WeddingController::class);

    // FITUR PDF MILIKMU
    Route::get(
        'weddings/{id}/download-pdf',
        [WeddingController::class, 'downloadPdf']
    )->name('weddings.download_pdf');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

// // 3. Rute Publik untuk Undangan & Kirim RSVP (Akses Tamu)
Route::get('/wedding/{slug}', [WeddingViewController::class, 'show'])->name('wedding.show');
Route::post('/wedding/{slug}/rsvp', [RsvpController::class, 'store'])->name('rsvp.store');

// Katalog
Route::get('/katalog', function () {
    return view('katalog');
});