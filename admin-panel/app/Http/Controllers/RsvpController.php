<?php

namespace App\Http\Controllers;

use App\Models\Rsvp;
use App\Models\Wedding;
use Illuminate\Http\Request;

class RsvpController extends Controller
{
    public function store(Request $request, $slug)
    {
        // 1. Validasi input dari form rsvp
        $request->validate([
            'nama_tamu' => 'required|string|max:255',
            'jumlah_hadir' => 'required|integer|min:1|max:10',
            'status' => 'required|in:hadir,tidak_hadir',
            'ucapan' => 'nullable|string|max:1000',
        ]);

        // 2. Cari data pernikahan berdasarkan slug untuk mendapatkan wedding_id
        $wedding = Wedding::where('slug', $slug)->firstOrFail();

        // 3. Simpan data RSVP ke database
        Rsvp::create([
            'wedding_id' => $wedding->id,
            'nama_tamu' => $request->nama_tamu,
            'jumlah_hadir' => $request->status == 'tidak_hadir' ? 0 : $request->jumlah_hadir,
            'status' => $request->status,
            'ucapan' => $request->ucapan,
        ]);

        // 4. Kembali ke halaman undangan dengan pesan sukses
        return redirect()->back()->with('rsvp_success', 'Terima kasih! Konfirmasi kehadiran dan ucapan Anda telah tersimpan.');
    }
}