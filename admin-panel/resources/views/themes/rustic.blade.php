<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Undangan Pernikahan {{ $wedding->nama_pria }} & {{ $wedding->nama_wanita }}</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Alex+Brush&family=Montserrat:wght@300;400;500;600&display=swap');
        .font-wedding { font-family: 'Alex Brush', cursive; }
        .font-body { font-family: 'Montserrat', sans-serif; }
    </style>
</head>

<body class="font-body bg-[#f4ede4] text-[#5c4d3c] antialiased">

    <div id="cover-page" class="min-h-screen flex flex-col justify-center items-center p-6 text-center bg-cover bg-center relative z-50">
        
        <p class="text-xs uppercase tracking-[0.3em] text-[#8c765c] font-medium mb-4">The Wedding of</p>
        <h1 class="font-wedding text-6xl md:text-8xl text-[#4a3b2c] my-4">
            {{ $wedding->nama_pria }} & {{ $wedding->nama_wanita }}
        </h1>
        <p class="text-sm tracking-widest text-[#8c765c] mb-12">
            {{ \Carbon\Carbon::parse($wedding->tanggal_acara)->translatedFormat('l, d F Y') }}
        </p>

        <div class="bg-white/60 backdrop-blur-sm border border-[#d1c2b0] px-8 py-6 rounded-xl max-w-sm w-full shadow-sm mb-6">
            <p class="text-[11px] uppercase tracking-wider text-[#8c765c] mb-2">Kepada Yth. Bapak/Ibu/Saudara/i:</p>
            
            <div class="flex items-center border-b border-[#a89682] focus-within:border-[#4a3b2c] transition">
                <input type="text" id="input-nama-mandiri" placeholder="Ketik nama Anda di sini..."
                    class="w-full px-2 py-1 text-center text-xl font-semibold focus:outline-none bg-transparent placeholder-[#c4b5a3] text-[#4a3b2c]">
            </div>
            <p class="text-[10px] text-[#8c765c] mt-1.5 italic">*Ketik nama lalu klik tombol Buka Undangan di bawah</p>
        </div>

        @if (session('rsvp_success'))
            <div class="mb-4 max-w-md w-full bg-emerald-50 text-emerald-800 border border-emerald-200 p-4 rounded-xl text-sm shadow-sm">
                🎉 {{ session('rsvp_success') }}
            </div>
        @endif

        <button onclick="prosesAksesUndangan()" class="bg-[#6b5843] hover:bg-[#534333] text-white px-8 py-3 rounded-full text-xs tracking-widest uppercase shadow transition cursor-pointer font-medium">
            Buka Undangan
        </button>
    </div>


    <div id="client-table-page" class="hidden min-h-screen flex flex-col justify-center items-center p-6 bg-white">
        <div class="max-w-4xl w-full space-y-6">
            <div class="flex justify-between items-center border-b border-gray-200 pb-4">
                <div>
                    <h2 class="text-2xl font-bold text-gray-800">Log Pesan & Kehadiran Tamu 🌿</h2>
                    <p class="text-xs text-gray-500">Halo Client/Admin, berikut data ucapan untuk pernikahan {{ $wedding->nama_pria }} & {{ $wedding->nama_wanita }}</p>
                </div>
                <a href="{{ route('admin.weddings.download_pdf', $wedding->id) }}" class="bg-amber-600 hover:bg-amber-700 text-white text-xs px-4 py-2 rounded-lg font-medium shadow transition">
                    📄 Unduh Laporan PDF
                </a>
            </div>

            <div class="bg-gray-50 rounded-2xl border border-gray-100 p-4 overflow-x-auto shadow-xs">
                <table class="w-full text-left border-collapse text-sm">
                    <thead>
                        <tr class="border-b border-gray-200 text-gray-400 uppercase tracking-wider text-[11px] font-bold">
                            <th class="py-3 px-2">Nama Tamu</th>
                            <th class="py-3 px-2">Alamat</th>
                            <th class="py-3 px-2 text-center">Status</th>
                            <th class="py-3 px-2 text-center">Jumlah</th>
                            <th class="py-3 px-2">Ucapan / Doa</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 text-gray-700">
                        @forelse($rsvps as $rv)
                            <tr>
                                <td class="py-3 px-2 font-semibold text-gray-900">{{ $rv->nama_tamu }}</td>
                                <td class="py-3 px-2 text-gray-500">{{ $rv->alamat ?? '-' }}</td>
                                <td class="py-3 px-2 text-center">
                                    <span class="px-2.5 py-0.5 rounded-full text-xs font-medium {{ $rv->status == 'hadir' ? 'bg-emerald-50 text-emerald-700' : 'bg-rose-50 text-rose-700' }}">
                                        {{ $rv->status == 'hadir' ? 'Hadir' : 'Absen' }}
                                    </span>
                                </td>
                                <td class="py-3 px-2 text-center font-medium">{{ $rv->jumlah_hadir }}</td>
                                <td class="py-3 px-2 text-gray-600 italic">"{{ $rv->ucapan ?? 'Memberikan doa restu.' }}"</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="py-6 text-center text-gray-400 italic">Belum ada ucapan dari tamu undangan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <button onclick="lokasiMundur()" class="text-xs text-gray-400 hover:text-gray-600 transition underline cursor-pointer">Kembali ke Halaman Utama</button>
        </div>
    </div>


    <div id="main-wedding-content" class="hidden min-h-screen flex flex-col items-center p-6 space-y-12">
        
        <div class="max-w-xl w-full text-center py-20 bg-white/40 border border-[#d1c2b0] rounded-2xl p-6 shadow-xs">
            <h2 class="font-wedding text-5xl text-[#4a3b2c] mb-4">Mempelai Pernikahan</h2>
            <p class="text-sm font-semibold text-gray-800">{{ $wedding->nama_pria }}</p>
            <p class="text-xs text-gray-500 my-2">dengan</p>
            <p class="text-sm font-semibold text-gray-800">{{ $wedding->nama_wanita }}</p>
            
            <p class="text-xs text-gray-600 mt-8 max-w-sm mx-auto">
                Lokasi Acara:<br>
                <span class="font-medium text-gray-800">{{ $wedding->lokasi_acara }}</span>
            </p>
        </div>

        <div class="bg-white/80 backdrop-blur-sm border border-[#d1c2b0] p-6 rounded-xl max-w-md w-full shadow-sm text-left">
            <h4 class="text-lg font-semibold text-[#4a3b2c] mb-4 text-center tracking-wide border-b border-[#d1c2b0]/40 pb-2">
                Konfirmasi Kehadiran (RSVP)
            </h4>

            <form action="{{ route('rsvp.store', $wedding->slug) }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="block text-xs font-semibold uppercase tracking-wider text-[#8c765c] mb-1">Nama Anda</label>
                    <input type="text" name="nama_tamu" id="rsvp-nama" required readonly
                        class="w-full bg-gray-100 border border-[#d1c2b0] text-gray-500 rounded-lg px-3 py-2 text-sm focus:outline-none cursor-not-allowed">
                </div>

                <div class="mb-4">
                    <label class="block text-xs font-semibold uppercase tracking-wider text-[#8c765c] mb-1">Alamat / Asal Kota</label>
                    <input type="text" name="alamat" required placeholder="Contoh: Katapang, Bandung"
                        class="w-full bg-[#f4ede4]/50 border border-[#d1c2b0] rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-[#6b5843]">
                </div>

                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-xs font-semibold uppercase tracking-wider text-[#8c765c] mb-1">Konfirmasi</label>
                        <select name="status" required
                            class="w-full bg-[#f4ede4]/50 border border-[#d1c2b0] rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-[#6b5843]">
                            <option value="hadir">Akan Hadir</option>
                            <option value="tidak_hadir">Berhalangan</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold uppercase tracking-wider text-[#8c765c] mb-1">Jumlah Orang</label>
                        <input type="number" name="jumlah_hadir" value="1" min="1" max="10" required
                            class="w-full bg-[#f4ede4]/50 border border-[#d1c2b0] rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-[#6b5843]">
                    </div>
                </div>

                <div class="mb-4">
                    <label class="block text-xs font-semibold uppercase tracking-wider text-[#8c765c] mb-1">Ucapan & Doa Restu</label>
                    <textarea name="ucapan" rows="3" placeholder="Tuliskan ucapan selamat Anda..."
                        class="w-full bg-[#f4ede4]/50 border border-[#d1c2b0] rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-[#6b5843]"></textarea>
                </div>

                <button type="submit" class="w-full bg-[#6b5843] hover:bg-[#534333] text-white py-2 rounded-lg text-xs tracking-widest uppercase shadow transition font-medium cursor-pointer">
                    Kirim Konfirmasi
                </button>
            </form>
        </div>
    </div>


    <script>
        function prosesAksesUndangan() {
            const namaInput = document.getElementById('input-nama-mandiri').value.trim();

            if (namaInput === "") {
                alert("Silakan ketik nama Anda terlebih dahulu!");
                return;
            }

            // PERCABANGAN UTAMA SESUAI REQUEST JAUL & JAY
            if (namaInput.toLowerCase() === "admin" || namaInput.toLowerCase() === "client") {
                // 1. Sembunyikan Cover
                document.getElementById('cover-page').classList.add('hidden');
                // 2. Munculkan Halaman Tabel Pesan Tamu
                document.getElementById('client-table-page').classList.remove('hidden');
            } else {
                // VALIDASI NAMA TAMU BIASA (Anti Simbol & Angka)
                const regex = /^[a-zA-Z\s]+$/;
                if (!regex.test(namaInput)) {
                    alert("Nama hanya boleh berisi huruf dan spasi saja (tanpa simbol/angka)!");
                    return;
                }

                // 1. Kunci nama ke dalam form RSVP di bawah surat undangan
                document.getElementById('rsvp-nama').value = namaInput;
                // 2. Sembunyikan Cover
                document.getElementById('cover-page').classList.add('hidden');
                // 3. Langsung Masuk ke Isi Surat Undangan Utama
                document.getElementById('main-wedding-content').classList.remove('hidden');
            }
        }

        function lokasiMundur() {
            // Mengembalikan ke tampilan cover input nama
            document.getElementById('client-table-page').classList.add('hidden');
            document.getElementById('cover-page').classList.remove('hidden');
        }

        // Aktifkan fungsi enter pada input field
        document.getElementById('input-nama-mandiri')?.addEventListener('keypress', function (e) {
            if (e.key === 'Enter') {
                prosesAksesUndangan();
            }
        });
    </script>

</body>
</html>