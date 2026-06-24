<?php

namespace App\Http\Controllers;

use App\Models\Rsvp;
use App\Models\Wedding;
use Illuminate\Http\Request;

class RsvpController extends Controller
{
    public function store(Request $request, $slug)
    {
        // Masukkan manipulasi input sebelum validasi agar spasi di awal/akhir nama otomatis terpotong (di-trim)
        $request->merge([
            'nama_tamu' => trim($request->nama_tamu),
            'alamat' => trim($request->alamat),
        ]);

        // 1. Validasi input dengan tambahan aturan regex dan alamat
        $request->validate([
            'nama_tamu' => [
                'required',
                'string',
                'min:2',
                'max:255',
                'regex:/^[a-zA-Z\s]+$/' // Hanya boleh huruf dan spasi biasa
            ],
            'alamat' => 'required|string|min:3|max:255', // Menambahkan wajib alamat
            'jumlah_hadir' => 'required|integer|min:1|max:10',
            'status' => 'required|in:hadir,tidak_hadir',
            'ucapan' => 'nullable|string|max:1000', // Ucapan dibebaskan (boleh emoji/simbol)
        ], [
            // Custom pesan error bahasa Indonesia
            'nama_tamu.required' => 'Nama tamu tidak boleh kosong atau cuma spasi.',
            'nama_tamu.regex'    => 'Nama hanya boleh diisi huruf dan spasi saja (tidak boleh angka/simbol/emoji).',
            'nama_tamu.min'      => 'Nama minimal terdiri dari 2 karakter.',
            'alamat.required'    => 'Alamat wajib diisi, ya.',
        ]);

        // 2. Cari data pernikahan berdasarkan slug
        $wedding = Wedding::where('slug', $slug)->firstOrFail();

        // 3. Simpan data RSVP ke database (pastikan model Rsvp & migrasinya sudah siap menampung 'alamat')
        Rsvp::create([
            'wedding_id' => $wedding->id,
            'nama_tamu' => $request->nama_tamu,
            'alamat' => $request->alamat, // Menyimpan alamat tamu ke database
            'jumlah_hadir' => $request->status == 'tidak_hadir' ? 0 : $request->jumlah_hadir,
            'status' => $request->status,
            'ucapan' => $request->ucapan,
        ]);

        // 4. Kembali ke halaman undangan dengan pesan sukses
        return redirect()->back()->with('rsvp_success', 'Terima kasih! Konfirmasi kehadiran dan ucapan Anda telah tersimpan.');
    }
}