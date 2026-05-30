<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wedding extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug',
        'nama_pria',
        'nama_wanita',
        'tanggal_acara',
        'lokasi_acara',
        'tema',
        'paket',
        'musik_url'
    ];

    // Relasi ke RSVP (Satu pernikahan punya banyak konfirmasi RSVP)
    public function rsvps()
    {
        return $this->hasMany(Rsvp::class);
    }
}