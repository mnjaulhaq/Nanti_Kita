<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Undangan Pernikahan {{ $wedding->nama_pria }} & {{ $wedding->nama_wanita }}</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <!-- Bootstrap Icons untuk ikon peta -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Alex+Brush&family=Montserrat:wght@300;400;500;600&display=swap');

        .font-wedding {
            font-family: 'Alex Brush', cursive;
        }

        .font-body {
            font-family: 'Montserrat', sans-serif;
        }
    </style>
</head>

<body class="font-body bg-[#f4ede4] text-[#5c4d3c] antialiased">

    <!-- LAYER SAMPUL DEPAN -->
    <div id="theme-sampul"
        class="min-h-screen flex flex-col justify-center items-center p-6 text-center bg-cover bg-center relative z-40">

        <p class="text-xs uppercase tracking-[0.3em] text-[#8c765c] font-medium mb-2">Selamat Datang di Undangan</p>
        <h1 class="font-wedding text-6xl md:text-8xl text-[#4a3b2c] my-4">
            {{ $wedding->nama_pria }} & {{ $wedding->nama_wanita }}
        </h1>

        <div class="my-6">
            <p class="text-xs tracking-widest text-[#8c765c] uppercase">To:</p>
            <h2 class="text-2xl font-semibold text-[#4a3b2c] mt-1">{{ $tamuDariUrl }}</h2>
        </div>

        <button onclick="bukaUndanganUtama()"
            class="mt-8 bg-[#4a3b2c] hover:bg-[#33281d] text-white px-8 py-3 rounded-full text-xs tracking-widest uppercase shadow transition cursor-pointer font-medium">
            Lihat Isi Undangan
        </button>
    </div>

    <!-- LAYER KONTEN UTAMA (Sembunyi di Awal) -->
    <div id="theme-konten-utama" class="hidden min-h-screen flex flex-col items-center p-6 space-y-12 pb-24">

        <!-- Blok Mempelai & Informasi Peta Lokasi -->
        <div class="max-w-xl w-full text-center py-12 bg-white/40 border border-[#d1c2b0] rounded-2xl p-6 shadow-xs mt-12 space-y-6">
            <div>
                <h2 class="font-wedding text-5xl text-[#4a3b2c] mb-4">Mempelai Pernikahan</h2>
                <p class="text-lg font-semibold text-gray-800">{{ $wedding->nama_pria }}</p>
                <p class="text-xs text-gray-500 my-2">&</p>
                <p class="text-lg font-semibold text-gray-800">{{ $wedding->nama_wanita }}</p>
            </div>

            <!-- FITUR SPECIAL: MINI MAPS INTERAKTIF GOOGLE MAPS -->
            <div class="border-t border-[#d1c2b0]/40 pt-6 space-y-3">
                <p class="text-xs font-semibold uppercase tracking-wider text-[#8c765c]">
                    <i class="bi bi-geo-alt-fill text-amber-700"></i> Lokasi Acara Pernikahan
                </p>

                <!-- Wadah Pembungkus Mini Maps Statis yang Bisa Diklik -->
                <div class="max-w-xs mx-auto overflow-hidden rounded-xl border border-[#d1c2b0] shadow-xs group transition-all duration-300 hover:shadow-md">
                    <!-- Link langsung mengarah ke URL Google Maps hasil input admin panel -->
                    <a href="{{ $wedding->lokasi_acara }}" target="_blank" rel="noopener noreferrer" class="block relative">
                        
                        <!-- Gambar Representasi Peta Visual -->
                        <img src="https://images.unsplash.com/photo-1524661135-423995f22d0b?auto=format&fit=crop&w=400&q=80" 
                             alt="Peta Lokasi" 
                             class="w-full h-32 object-cover filter sepia-[0.2] group-hover:scale-105 transition-transform duration-500">
                        
                        <!-- Lapisan Overlay Hover Ringan -->
                        <div class="absolute inset-0 bg-black/20 flex flex-col items-center justify-center transition-colors group-hover:bg-black/30">
                            <span class="bg-white/90 text-[#4a3b2c] text-[11px] font-semibold px-3 py-1.5 rounded-full shadow-sm flex items-center gap-1 uppercase tracking-wider">
                                <i class="bi bi-map"></i> Lihat di Google Maps
                            </span>
                        </div>
                    </a>
                </div>
                
                <p class="text-[10px] text-gray-400 italic">*Klik gambar peta di atas untuk membuka navigasi rute langsung</p>
            </div>
        </div>

        <!-- Blok Input Ucapan / Doa Restu (RSVP Bersih) -->
        <div class="bg-white/80 backdrop-blur-sm border border-[#d1c2b0] p-6 rounded-xl max-w-md w-full shadow-sm text-left">
            <h4 class="text-lg font-semibold text-[#4a3b2c] mb-4 text-center tracking-wide border-b border-[#d1c2b0]/40 pb-2">
                Berikan Ucapan & Doa Restu
            </h4>

            <form action="{{ route('rsvp.store', $wedding->slug) }}" method="POST" class="space-y-4">
                @csrf

                <!-- DATA GAIB: Otomatis Menangkap Parameter Dari URL Gerbang Depan -->
                <input type="hidden" name="nama_tamu" value="{{ $tamuDariUrl }}">
                <input type="hidden" name="alamat" value="{{ request('asal', '-') }}">
                <input type="hidden" name="status" value="{{ request('status', 'hadir') }}">
                <input type="hidden" name="jumlah_hadir" value="{{ request('jumlah_hadir', 1) }}">

                <!-- DATA UTAMA: HANYA KOLOM UCAPAN -->
                <div>
                    <label class="block text-xs font-semibold uppercase tracking-widest text-[#8c765c] mb-2 text-center">
                        ✨ Tulis Ucapan & Doa Restu
                    </label>
                    <textarea name="ucapan" rows="4" required
                        placeholder="Tuliskan ucapan selamat dan doa tulus Anda untuk kedua mempelai..."
                        class="w-full bg-[#f4ede4]/40 border border-[#d1c2b0] rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-[#6b5843] focus:border-transparent text-[#4a3b2c] placeholder-[#c4b5a3] transition-all"></textarea>
                </div>

                <!-- Tombol Kirim -->
                <button type="submit"
                    class="w-full bg-[#6b5843] hover:bg-[#534333] text-white py-3 rounded-xl text-xs tracking-widest uppercase shadow transition font-medium cursor-pointer flex items-center justify-center gap-2">
                    <span>🕊️ Kirim Ucapan</span>
                </button>
            </form>
        </div>

        <a href="{{ url('/katalog') }}" class="text-xs text-gray-400 hover:text-gray-600 transition underline">
            ⬅️ Kembali ke Halaman Katalog
        </a>
    </div>

    <!-- JAVASCRIPT LOGIKA SAKLAR HALAMAN -->
    <script>
        function bukaUndanganUtama() {
            // Sembunyikan sampul bertuliskan nama tamu
            document.getElementById('theme-sampul').classList.add('hidden');
            // Tampilkan isi utama undangan
            document.getElementById('theme-konten-utama').classList.remove('hidden');
            window.scrollTo(0, 0);
        }
    </script>
</body>

</html>