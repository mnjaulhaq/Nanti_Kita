<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Wedding;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Rsvp;

class WeddingController extends Controller
{
    // 1. Menampilkan Semua Klien Wedding
    public function index()
    {
        $weddings = Wedding::latest()->get();
        return view('admin.weddings.index', compact('weddings'));
    }

    // 2. Menampilkan Form Tambah Klien
    public function create()
    {
        return view('admin.weddings.create');
    }

    // 3. Menyimpan Data Klien Baru
    public function store(Request $request)
    {
        // 1. Validasi Input yang Ketat
        $validated = $request->validate([
            'nama_pria' => 'required|string|max:255',
            'nama_wanita' => 'required|string|max:255',
            'tanggal_acara' => 'required|date',
            'lokasi_acara' => 'required|string|max:500',
            'paket' => 'required|in:basic,premium',
            'tema' => 'required|string',
        ]);

        // 2. Otomatisasi Pembuatan Slug yang Unik
        // Contoh: "Andi" & "Siti" otomatis menjadi "andi-dan-siti"
        $slugMentah = Str::slug($request->nama_pria . '-dan-' . $request->nama_wanita);

        // Antispasasi jika ada nama pengantin yang mirip, tambahkan string acak di ujung slug
        $slugFinal = Wedding::where('slug', $slugMentah)->exists()
            ? $slugMentah . '-' . Str::lower(Str::random(4))
            : $slugMentah;

        // 3. Simpan ke Database
        Wedding::create([
            'nama_pria' => $request->nama_pria,
            'nama_wanita' => $request->nama_wanita,
            'slug' => $slugFinal,
            'tanggal_acara' => $request->tanggal_acara,
            'lokasi_acara' => $request->lokasi_acara,
            'paket' => $request->paket,
            'tema' => $request->tema,
        ]);

        return redirect()->route('admin.weddings.index')->with('success', 'Data Undangan Client Berhasil Dibuat!');
    }

    // 4. Menampilkan Form Edit Klien
    public function edit(Wedding $wedding)
    {
        return view('admin.weddings.edit', compact('wedding'));
    }

    // 5. Mengupdate Data Klien
    public function update(Request $request, $id)
    {
        $wedding = Wedding::findOrFail($id);

        // Validasi saat update data
        $request->validate([
            'nama_pria' => 'required|string|max:255',
            'nama_wanita' => 'required|string|max:255',
            'tanggal_acara' => 'required|date',
            'lokasi_acara' => 'required|string|max:500',
            'paket' => 'required|in:basic,premium',
            'tema' => 'required|string',
        ]);

        // Update data tanpa mengubah slug awal (agar link yang sudah disebar tidak rusak)
        $wedding->update([
            'nama_pria' => $request->nama_pria,
            'nama_wanita' => $request->nama_wanita,
            'tanggal_acara' => $request->tanggal_acara,
            'lokasi_acara' => $request->lokasi_acara,
            'paket' => $request->paket,
            'tema' => $request->tema,
        ]);

        return redirect()->route('admin.weddings.index')->with('success', 'Data Undangan Client Berhasil Diperbarui!');
    }

    // 6. Menghapus Klien
    public function destroy(Wedding $wedding)
    {
        $wedding->delete();
        return redirect()->route('admin.weddings.index')->with('success', 'Klien berhasil dihapus.');
    }

    public function showRsvps($id)
    {
        // Cari data pernikahan beserta semua data rsvp-nya sekaligus
        $wedding = Wedding::with('rsvps')->findOrFail($id);

        return view('admin.rsvps.index', compact('wedding'));
    }

    public function dashboard()
    {
        // 1. Hitung total klien pengantin yang terdaftar
        $totalWeddings = Wedding::count();

        // 2. Hitung akumulasi omzet kasar bisnis (Simulasi: Paket Basic 500k, Premium 1 Juta)
        $totalRevenue = (Wedding::where('paket', 'basic')->count() * 500000) +
            (Wedding::where('paket', 'premium')->count() * 1000000);

        // 3. Hitung total konfirmasi tamu yang fix hadir dari semua undangan
        $totalGuestsHadir = Rsvp::where('status', 'hadir')->sum('jumlah_hadir');

        // 4. Ambil 4 data klien yang paling baru didaftarkan
        $recentWeddings = Wedding::latest()->take(4)->get();

        // 5. Lempar semua data statistik ke halaman view dashboard
        return view('admin.dashboard', compact('totalWeddings', 'totalRevenue', 'totalGuestsHadir', 'recentWeddings'));
    }

    public function globalRsvps()
    {
        // Mengambil semua data RSVP digabung dengan data nama pengantinnya (Eager Loading)
        $rsvps = Rsvp::with('wedding')->latest()->get();

        return view('admin.rsvps.global', compact('rsvps'));
    }
}
