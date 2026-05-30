<?php

namespace App\Http\Controllers;

use App\Models\Wedding;
use Illuminate\Http\Request;

class WeddingViewController extends Controller
{
    public function show(Request $request, $slug)
    {
        // 1. Cari data pernikahan berdasarkan slug di URL. Jika tidak ada, otomatis memunculkan error 404 (Not Found)
        $wedding = Wedding::where('slug', $slug)->firstOrFail();

        // 2. Tangkap nama tamu dari parameter '?to=Nama+Tamu'
        // Jika parameter ?to kosong/tidak ada di URL, maka default-nya adalah 'Tamu Undangan'
        $namaTamu = $request->query('to', 'Tamu Undangan');

        // 3. Ambil data semua ucapan/RSVP yang sudah masuk untuk pernikahan ini (untuk ditampilkan di buku tamu)
        $rsvps = $wedding->rsvps()->latest()->get();

        // 4. Arahkan ke folder view berdasarkan nama tema yang dipilih di admin panel
        // Contoh: jika tema = rustic, maka akan memanggil view: resources/views/themes/rustic.blade.php
        return view('themes.' . $wedding->tema, compact('wedding', 'namaTamu', 'rsvps'));
    }
}