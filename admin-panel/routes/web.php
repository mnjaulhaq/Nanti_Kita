<?php

use App\Http\Controllers\Admin\WeddingController;
use App\Http\Controllers\WeddingViewController;
use App\Http\Controllers\RsvpController;
use Illuminate\Support\Facades\Route;

// 1. Halaman Utama / Landing Page Publik
Route::get('/', function () {
    return view('welcome');
});

// 2. Grouping URL untuk Admin Panel NantiKita.
Route::prefix('admin')->name('admin.')->group(function () {
    // Halaman Utama Dashboard Admin
    Route::get('/', [WeddingController::class, 'dashboard'])->name('dashboard');

    // RUTE BARU: RSVP Global (Taruh di atas weddings rsvps agar tidak bentrok)
    Route::get('rsvps', [WeddingController::class, 'globalRsvps'])->name('rsvps.global');
    
    // Jalur RSVP spesifik per client
    Route::get('weddings/{id}/rsvps', [WeddingController::class, 'showRsvps'])->name('weddings.rsvps');
    
    // Otomatis membuat rute CRUD weddings
    Route::resource('weddings', WeddingController::class);
});

// 3. Rute Publik untuk Undangan & Kirim RSVP (Akses Tamu)
Route::get('/wedding/{slug}', [WeddingViewController::class, 'show'])->name('wedding.show');
Route::post('/wedding/{slug}/rsvp', [RsvpController::class, 'store'])->name('rsvp.store');