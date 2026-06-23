<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Undangan Pernikahan {{ $wedding->nama_pria }} & {{ $wedding->nama_wanita }}</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4">
        const login = (nama,pesan,kehadiran,jumlahOrg) => {
            //cek nama siapa?
            //cek nama udah ada apa belum?
            //cek hadir atau tidak?
            //
        }
    </script>
    <style>
        /* Font & Warna Khas Tema Rustic */
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

    <div class="min-h-screen flex flex-col justify-center items-center p-6 text-center bg-cover bg-center relative"
        style="background-image: linear-gradient(to bottom, rgba(244,237,228,0.8), rgba(244,237,228,0.95));">

        <p class="text-xs uppercase tracking-[0.3em] text-[#8c765c] font-medium mb-4">The Wedding of</p>

        <h1 class="font-wedding text-6xl md:text-8xl text-[#4a3b2c] my-4">
            {{ $wedding->nama_pria }} & {{ $wedding->nama_wanita }}
        </h1>

        <p class="text-sm tracking-widest text-[#8c765c] mb-12">
            {{ \Carbon\Carbon::parse($wedding->tanggal_acara)->translatedFormat('l, d F Y') }}
        </p>

        <div
            class="bg-white/60 backdrop-blur-sm border border-[#d1c2b0] px-8 py-6 rounded-xl max-w-sm w-full shadow-sm">
            <p class="text-[11px] uppercase tracking-wider text-[#8c765c] mb-2">Kepada Yth. Bapak/Ibu/Saudara/i:</p>

            @if ($tamuDariUrl)
                <h3 class="text-2xl font-bold text-[#4a3b2c] tracking-wide my-2">
                    {{ $tamuDariUrl }}
                </h3>

                @if ($wedding->paket == 'premium')
                    <p
                        class="text-[10px] text-amber-700 bg-amber-50 px-2 py-0.5 rounded-full inline-block mt-2 font-medium border border-amber-200">
                        ✨ Tamu Spesial (Premium Link)
                    </p>
                @endif
            @else
                <div id="wrapper-input-nama" class="mt-1 max-w-xs mx-auto">
                    <div class="flex items-center border-b border-[#a89682] focus-within:border-[#4a3b2c] transition">
                        <input type="text" id="input-nama-mandiri" placeholder="Ketik nama Anda di sini..."
                            class="w-full px-2 py-1 text-center text-xl font-semibold focus:outline-none bg-transparent placeholder-[#c4b5a3] text-[#4a3b2c]">

                        <button type="button" onclick="kunciNamaTamu()"
                            class="text-xs p-1 hover:scale-110 transition cursor-pointer" title="Kunci Nama">
                            ✔️
                        </button>
                    </div>
                    <p class="text-[10px] text-[#8c765c] mt-1.5 italic">*Klik centang atau tekan Enter untuk melihat
                        undangan</p>
                </div>

                <div id="wrapper-nama-terkunci" class="hidden">
                    <h3 class="text-2xl font-bold text-[#4a3b2c] tracking-wide my-2" id="text-nama-terkunci"></h3>
                    <p
                        class="text-[10px] text-stone-600 bg-stone-100 px-2 py-0.5 rounded-full inline-block mt-2 font-medium border border-stone-200">
                        👤 Tamu Terverifikasi
                    </p>
                </div>
            @endif
        </div>

        @if (session('rsvp_success'))
            <div
                class="mt-6 max-w-md w-full bg-emerald-50 text-emerald-800 border border-emerald-200 p-4 rounded-xl text-sm shadow-sm">
                🎉 {{ session('rsvp_success') }}
            </div>
        @endif

        <div
            class="bg-white/80 backdrop-blur-sm border border-[#d1c2b0] p-6 rounded-xl max-w-md w-full shadow-sm mt-8 text-left">
            <h4
                class="text-lg font-semibold text-[#4a3b2c] mb-4 text-center tracking-wide border-b border-[#d1c2b0]/40 pb-2">
                Konfirmasi Kehadiran (RSVP)
            </h4>

            <form action="{{ route('rsvp.store', $wedding->slug) }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="block text-xs font-semibold uppercase tracking-wider text-[#8c765c] mb-1">
                        Nama Anda
                    </label>
                    <input type="text" name="nama_tamu" id="rsvp-nama" value="" required
                        placeholder="Masukkan nama Anda"
                        class="w-full bg-[#f4ede4]/50 border border-[#d1c2b0] rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-[#6b5843]">
                </div>

                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <label
                            class="block text-xs font-semibold uppercase tracking-wider text-[#8c765c] mb-1">Konfirmasi</label>
                        <select name="status" required id="status_hadir"
                            class="w-full bg-[#f4ede4]/50 border border-[#d1c2b0] rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-[#6b5843]">
                            <option value="hadir">Akan Hadir</option>
                            <option value="tidak_hadir">Berhalangan</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold uppercase tracking-wider text-[#8c765c] mb-1">Jumlah
                            Orang</label>
                        <input type="number" name="jumlah_hadir" value="1" min="1" max="10" required
                            class="w-full bg-[#f4ede4]/50 border border-[#d1c2b0] rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-[#6b5843]">
                    </div>
                </div>

                <div class="mb-4">
                    <label class="block text-xs font-semibold uppercase tracking-wider text-[#8c765c] mb-1">Ucapan & Doa
                        Restu</label>
                    <textarea name="ucapan" rows="3" placeholder="Tuliskan ucapan selamat Anda..."
                        class="w-full bg-[#f4ede4]/50 border border-[#d1c2b0] rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-[#6b5843]"></textarea>
                </div>

                <button type="submit"
                    class="w-full bg-[#6b5843] hover:bg-[#534333] text-white py-2 rounded-lg text-xs tracking-widest uppercase shadow transition font-medium">
                    Kirim Konfirmasi
                </button>
            </form>
        </div>

        <div
            class="bg-white/40 backdrop-blur-sm border border-[#d1c2b0]/60 p-6 rounded-xl max-w-md w-full text-left mt-6 max-h-60 overflow-y-auto">
            <h5 class="text-xs font-bold uppercase tracking-widest text-[#8c765c] mb-3">Wedding Wishes & Prayers</h5>
            <div class="space-y-3">
                @forelse($rsvps as $rsvp)
                    <div class="bg-white/80 p-3 rounded-lg shadow-2xs border border-[#d1c2b0]/30">
                        <div class="flex justify-between items-center mb-1">
                            <span class="font-semibold text-xs text-[#4a3b2c]">{{ $rsvp->nama_tamu }}</span>
                            <span
                                class="text-[10px] px-1.5 py-0.5 rounded-sm {{ $rsvp->status == 'hadir' ? 'bg-emerald-50 text-emerald-700' : 'bg-rose-50 text-rose-700' }} font-medium">
                                {{ $rsvp->status == 'hadir' ? '✓ Hadir' : '✕ Absen' }}
                            </span>
                        </div>
                        <p class="text-xs text-gray-600 italic">"{{ $rsvp->ucapan ?? 'Memberikan doa restu.' }}"</p>
                    </div>
                @empty
                    <p class="text-xs text-gray-400 text-center py-4">Belum ada ucapan. Jadilah yang pertama!</p>
                @endforelse
            </div>
        </div>

        <button
            onClick="login(document.getElementById('rsvp-nama').value, document.querySelector('textarea[name=ucapan]').value, document.getElementById('status_hadir').value, document.getElementById('jumlah_hadir').value)"
            class="mt-8 bg-[#6b5843] hover:bg-[#534333] text-white px-6 py-2.5 rounded-full text-xs tracking-widest uppercase shadow transition">
            Buka Undangan
        </button>
    </div>

    <script>
        function kunciNamaTamu() {
            const namaInput = document.getElementById('input-nama-mandiri').value.trim();

            if (namaInput === "") {
                alert("Silakan ketik nama Anda terlebih dahulu!");
                return;
            }

            // 1. Tulis nama ke elemen teks polos h3 di bawahnya
            document.getElementById('text-nama-terkunci').innerText = namaInput;

            // 2. KUNCI UTAMA: Sembunyikan total container input (menghilangkan kotak input biru & petunjuk)
            document.getElementById('wrapper-input-nama').classList.add('hidden');

            // 3. Munculkan teks nama polos terverifikasi
            document.getElementById('wrapper-nama-terkunci').classList.remove('hidden');
        }

        // Jalankan fungsi kunciNamaTamu saat menekan Enter di keyboard
        document.getElementById('input-nama-mandiri')?.addEventListener('keypress', function (e) {
            if (e.key === 'Enter') {
                kunciNamaTamu();
            }
        });
    </script>

</body>

</html>