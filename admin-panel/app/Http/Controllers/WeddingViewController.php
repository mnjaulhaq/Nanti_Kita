<?php

namespace App\Http\Controllers;

use App\Models\Wedding;
use Illuminate\Http\Request;

class WeddingViewController extends Controller
{
    public function show($slug, Request $request)
    {
        $wedding = Wedding::where('slug', $slug)->firstOrFail();
        
        $theme = $request->query('theme', 'rustic');
        $paket = $request->query('paket', 'basic');
        $tamuDariUrl = $request->query('to');

        // Menangkap parameter tambahan dari gerbang depan untuk diteruskan ke view tema
        $asal = $request->query('asal', '-');
        $status = $request->query('status', 'hadir');
        $jumlah_hadir = $request->query('jumlah_hadir', 1);

        // Pengambilan data RSVP teratas agar bisa dipakai di semua halaman
        $rsvps = $wedding->rsvps()->latest()->get();

        // 1. JIKA DIAKSES DARI KATALOG (Mode Demo)
        if ($request->has('from_katalog') || strtolower($tamuDariUrl) == 'john doe') {
            $tamuFinal = "John Doe";
            return view("themes.{$theme}", compact('wedding', 'paket', 'rsvps', 'asal', 'status', 'jumlah_hadir'))->with('tamuDariUrl', $tamuFinal);
        }

        // 2. JIKA DIAKSES DARI LINK GENERATE ADMIN PANEL (Undangan Asli Kosongan)
        if (empty($tamuDariUrl) || $tamuDariUrl == 'NamaTamu') {
            return view('themes.dashboard_tamu', compact('wedding', 'theme', 'paket', 'rsvps'));
        }

        // 3. JIKA TAMU SUDAH INPUT NAMA & DATA LAIN DI GERBANG DEPAN
        $tamuFinal = $tamuDariUrl;
        return view("themes.{$theme}", compact('wedding', 'paket', 'rsvps', 'asal', 'status', 'jumlah_hadir'))->with('tamuDariUrl', $tamuFinal);
    }
}