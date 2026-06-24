<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Undangan Pernikahan {{ $wedding->nama_pria }} & {{ $wedding->nama_wanita }}</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
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
        <p class="text-sm tracking-widest text-[#8c765c] mb-8">
            {{ \Carbon\Carbon::parse($wedding->tanggal_acara)->translatedFormat('l, d F Y') }}
        </p>

        <form id="form-dashboard-tamu" action="{{ url()->current() }}" method="GET" class="max-w-sm w-full space-y-4">
            <input type="hidden" name="theme" value="{{ request('theme', $theme ?? 'rustic') }}">
            <input type="hidden" name="paket" value="{{ request('paket', $paket ?? 'basic') }}">

            <div class="bg-white/60 backdrop-blur-sm border border-[#d1c2b0] px-6 py-5 rounded-xl shadow-sm text-left">
                <div id="badge-verifikasi" class="hidden flex items-center justify-between mb-2 transition-all">
                    <p class="text-[10px] uppercase tracking-wider text-[#8c765c] font-semibold flex items-center gap-1">
                        <i class="bi bi-patch-check-fill text-amber-600"></i> Tamu Eksklusif Terverifikasi
                    </p>
                    <span class="text-[9px] bg-amber-100 text-amber-800 px-2 py-0.5 rounded-full font-medium">Verified</span>
                </div>

                <p id="label-kepada" class="text-[11px] uppercase tracking-wider text-[#8c765c] mb-2">Kepada Yth. Bapak/Ibu/Saudara/i:</p>

                <div class="flex items-center border-b border-[#a89682] focus-within:border-[#4a3b2c] transition py-1">
                    <input type="text" id="input-nama-mandiri" name="to" placeholder="Ketik nama Anda di sini..." required autocomplete="off"
                        class="w-full text-lg font-semibold focus:outline-none bg-transparent placeholder-[#c4b5a3] text-[#4a3b2c]">
                    <i id="icon-pensil" class="bi bi-pencil-fill text-xs text-[#a89682] ml-2 hidden"></i>
                </div>
            </div>

            <div id="card-opsi-tamu" class="hidden bg-white/60 backdrop-blur-sm border border-[#d1c2b0] px-6 py-5 rounded-xl shadow-sm text-left space-y-3 transition-all duration-500">
                <div>
                    <label class="block text-[10px] uppercase tracking-wider text-[#8c765c] font-semibold mb-1">Asal / Kota</label>
                    <input type="text" id="input-asal" name="asal" placeholder="Contoh: Katapang, Bandung"
                        class="w-full bg-white/50 border border-[#d1c2b0] rounded-lg px-3 py-2 text-sm focus:outline-none focus:border-[#4a3b2c] text-[#4a3b2c]">
                </div>

                <div>
                    <label class="block text-[10px] uppercase tracking-wider text-[#8c765c] font-semibold mb-1">Konfirmasi Kehadiran</label>
                    <select id="select-konfirmasi" name="status" onchange="toggleJumlahOrang()"
                        class="w-full bg-white/50 border border-[#d1c2b0] rounded-lg px-3 py-2 text-sm focus:outline-none focus:border-[#4a3b2c] text-[#4a3b2c]">
                        <option value="" disabled selected>-- Pilih Kehadiran --</option>
                        <option value="hadir">Akan Hadir</option>
                        <option value="tidak_hadir">Berhalangan</option>
                    </select>
                </div>

                <div>
                    <label class="block text-[10px] uppercase tracking-wider text-[#8c765c] font-semibold mb-1">Jumlah Orang Yang Hadir</label>
                    <input type="number" id="input-jumlah" name="jumlah_hadir" value="1" min="1" max="10" disabled
                        class="w-full bg-gray-200 border border-[#d1c2b0] rounded-lg px-3 py-2 text-sm focus:outline-none text-gray-400 font-medium cursor-not-allowed transition-all">
                </div>
            </div>
        </form>
        
        <p class="text-[10px] text-[#8c765c] mt-4 italic mb-2">*Ketik nama lalu klik tombol Lanjutkan</p>

        <button id="btn-utama" onclick="eksekusiTahapSatu()" class="bg-[#6b5843] hover:bg-[#534333] text-white px-8 py-3 rounded-full text-xs tracking-widest uppercase shadow transition cursor-pointer font-medium">
            Lanjutkan
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

    <script>
        // Tahap 1: Cek nama saat tombol "Lanjutkan" pertama kali diklik
        function eksekusiTahapSatu() {
            const namaInput = document.getElementById('input-nama-mandiri').value.trim();

            if (namaInput === "") {
                alert("Silakan ketik nama Anda terlebih dahulu!");
                return;
            }

            // 1. JIKA KETIK ADMIN / CLIENT -> LANGSUNG DIALIKHAKAN KE LOG TABEL
            if (namaInput.toLowerCase() === "admin" || namaInput.toLowerCase() === "client") {
                document.getElementById('cover-page').classList.add('hidden');
                document.getElementById('client-table-page').classList.remove('hidden');
                return;
            }

            // VALIDASI REGEX HURUF & SPASI UNTUK TAMU BIASA
            const regex = /^[a-zA-Z\s]+$/;
            if (!regex.test(namaInput)) {
                alert("Nama hanya boleh berisi huruf dan spasi saja!");
                return;
            }

            // 2. JIKA TAMU BIASA -> MUNCULKAN CARD TAMBAHAN SECARA INTERAKTIF
            document.getElementById('label-kepada').classList.add('hidden'); // Sembunyikan label lama
            document.getElementById('badge-verifikasi').classList.remove('hidden'); // Munculkan badge verified
            document.getElementById('icon-pensil').classList.remove('hidden'); // Munculkan icon pensil
            
            // Munculkan card form alamat & rsvp
            const cardOpsi = document.getElementById('card-opsi-tamu');
            cardOpsi.classList.remove('hidden');

            // Set input tambahan menjadi required setelah muncul
            document.getElementById('input-asal').required = true;
            document.getElementById('select-konfirmasi').required = true;

            // Ganti fungsi dan teks tombol utama menjadi submit form ke tema undangan
            const btnUtama = document.getElementById('btn-utama');
            btnUtama.textContent = "Buka Undangan";
            btnUtama.setAttribute("onclick", "eksekusiTahapFinal()");
        }

        // Tahap 2: Validasi akhir sebelum submit form ke tema undangan resmi
        function eksekusiTahapFinal() {
            const form = document.getElementById('form-dashboard-tamu');
            if (form.checkValidity()) {
                form.submit();
            } else {
                form.reportValidity();
            }
        }

        // Logika Toggle Kunci/Buka Jumlah Orang sesuai pilihan status kehadiran
        function toggleJumlahOrang() {
            const status = document.getElementById('select-konfirmasi').value;
            const inputJumlah = document.getElementById('input-jumlah');

            if (status === 'hadir') {
                inputJumlah.disabled = false;
                inputJumlah.required = true;
                inputJumlah.classList.remove('bg-gray-200', 'text-gray-400', 'cursor-not-allowed');
                inputJumlah.classList.add('bg-white/50', 'text-[#4a3b2c]');
                inputJumlah.value = "1";
            } else {
                inputJumlah.disabled = true;
                inputJumlah.required = false;
                inputJumlah.classList.add('bg-gray-200', 'text-gray-400', 'cursor-not-allowed');
                inputJumlah.classList.remove('bg-white/50', 'text-[#4a3b2c]');
                inputJumlah.value = "0";
            }
        }

        function lokasiMundur() {
            document.getElementById('client-table-page').classList.add('hidden');
            document.getElementById('cover-page').classList.remove('hidden');
            // Reset tampilan ke stelan awal mula
            document.getElementById('label-kepada').classList.remove('hidden');
            document.getElementById('badge-verifikasi').classList.add('hidden');
            document.getElementById('icon-pensil').classList.add('hidden');
            document.getElementById('card-opsi-tamu').classList.add('hidden');
            
            const btnUtama = document.getElementById('btn-utama');
            btnUtama.textContent = "Lanjutkan";
            btnUtama.setAttribute("onclick", "eksekusiTahapSatu()");
        }

        // Mengatur enter key agar adaptif dengan tahapan tombol
        document.getElementById('input-nama-mandiri')?.addEventListener('keypress', function (e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                const btnUtama = document.getElementById('btn-utama');
                if (btnUtama.getAttribute("onclick") === "eksekusiTahapSatu()") {
                    eksekusiTahapSatu();
                } else {
                    eksekusiTahapFinal();
                }
            }
        });
    </script>

</body>
</html>