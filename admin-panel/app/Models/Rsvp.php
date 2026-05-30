<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rsvp extends Model
{
    use HasFactory;

    // KUNCI PERBAIKAN: Izinkan kolom-kolom ini diisi secara massal melalui form
    protected $fillable = [
        'wedding_id',
        'nama_tamu',
        'jumlah_hadir',
        'status',
        'ucapan'
    ];

    // Relasi balik (Satu data RSVP ini dimiliki oleh satu pernikahan tertentu)
    public function wedding()
    {
        return $this->belongsTo(Wedding::class);
    }
}