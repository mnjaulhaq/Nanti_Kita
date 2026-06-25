<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Wedding;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class HapusUndanganExpired extends Command
{
    /**
     * Nama perintah yang akan dipanggil via terminal/cron
     */
    protected $signature = 'wedding:clear-expired';

    /**
     * Deskripsi singkat perintah
     */
    protected $signature_description = 'Menghapus data pernikahan dan RSVP yang sudah lewat 2 bulan dari tanggal acara.';

    /**
     * Eksekusi perintah di sini
     */
    public function handle()
    {
        // Ambil batas waktu: Hari ini dikurangi 2 bulan (60 hari)
        $batasWaktu = Carbon::now()->subMonths(2);

        // Cari pernikahan yang tanggal_acara-nya lebih lampau dari batas waktu
        $weddings = Wedding::where('tanggal_acara', '<', $batasWaktu)->get();

        if ($weddings->isEmpty()) {
            $this->info('Tidak ada data undangan pernikahan yang expired hari ini.');
            return Command::SUCCESS;
        }

        $jumlahTerhapus = 0;

        foreach ($weddings as $wedding) {
            // Karena di database biasanya ada relasi cascade (atau kita hapus manual RSVP-nya),
            // Kita hapus RSVP terkait terlebih dahulu jika belum diset cascade di migrasi
            $wedding->rsvps()->delete(); 
            
            // Hapus data pernikahan utama
            $wedding->delete();
            
            $jumlahTerhapus++;
        }

        // Catat ke log Laravel sebagai bukti fungsionalitas berjalan di latar belakang
        Log::info("Sistem Pembersihan Otomatis: Sukses menghapus {$jumlahTerhapus} data pernikahan yang telah kedaluwarsa.");
        
        $this->info("Sukses menghapus {$jumlahTerhapus} data pernikahan yang expired!");
        return Command::SUCCESS;
    }
}