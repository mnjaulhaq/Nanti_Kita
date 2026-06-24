@extends('admin.layouts.app')

@section('content')
    <div class="w-full space-y-8">

        <div>
            <h2 class="text-3xl font-extrabold text-gray-800 tracking-tight">Selamat Datang di Dasbor Utama 🌿</h2>
            <p class="text-sm text-gray-500 mt-1">Berikut adalah rangkuman performa bisnis dan operasional layanan undangan **NantiKita.**</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center justify-between">
                <div class="space-y-2">
                    <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Total Klien Aktif</p>
                    <p class="text-3xl font-black text-gray-800">{{ $totalWeddings }} <span class="text-sm font-normal text-gray-400">Pasangan</span></p>
                </div>
                <div class="w-12 h-12 bg-brand-green/10 text-brand-green rounded-xl flex items-center justify-center text-xl font-bold">📋</div>
            </div>

            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center justify-between">
                <div class="space-y-2">
                    <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Estimasi Omzet Kasar</p>
                    <p class="text-3xl font-black text-brand-green">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</p>
                </div>
                <div class="w-12 h-12 bg-emerald-50 text-emerald-700 rounded-xl flex items-center justify-center text-xl font-bold">💰</div>
            </div>

            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center justify-between">
                <div class="space-y-2">
                    <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Total Tamu Hadir (Fix)</p>
                    <p class="text-3xl font-black text-gray-800">{{ $totalGuestsHadir }} <span class="text-sm font-normal text-gray-400">Orang</span></p>
                </div>
                <div class="w-12 h-12 bg-blue-50 text-blue-700 rounded-xl flex items-center justify-center text-xl font-bold">📨</div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="lg:col-span-2 bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                <h3 class="text-lg font-bold text-gray-800 mb-4">✨ Registrasi Klien Terbaru</h3>
                <div class="divide-y divide-gray-100">
                    @forelse($recentWeddings as $wedding)
                        <div class="py-3 flex justify-between items-center first:pt-0 last:pb-0">
                            <div>
                                <p class="font-semibold text-gray-900 text-sm">{{ $wedding->nama_pria }} & {{ $wedding->nama_wanita }}</p>
                                <p class="text-xs text-gray-400 mt-0.5">Tema: <span class="capitalize font-medium">{{ $wedding->tema }}</span> | {{ \Carbon\Carbon::parse($wedding->tanggal_acara)->format('d M Y') }}</p>
                            </div>
                            <span class="px-2.5 py-1 text-xs font-semibold rounded-full {{ $wedding->paket == 'premium' ? 'bg-amber-50 text-amber-700 border border-amber-100' : 'bg-blue-50 text-blue-700 border border-blue-100' }}">
                                {{ ucfirst($wedding->paket) }}
                            </span>
                        </div>
                    @empty
                        <p class="text-sm text-gray-400 text-center py-6">Belum ada aktivitas pendaftaran klien baru.</p>
                    @endforelse
                </div>
            </div>

            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex flex-col justify-between">
                <div>
                    <h3 class="text-lg font-bold text-gray-800 mb-2">🚀 Akses Cepat</h3>
                    <p class="text-xs text-gray-400 mb-4">Pintasan praktis untuk mempercepat alur kerja harian admin.</p>
                    <div class="space-y-2">
                        <a href="{{ route('admin.weddings.create') }}" class="block w-full text-center bg-brand-green hover:bg-stone-700 text-white font-medium text-xs py-3 rounded-xl transition">
                            Tambah Undangan Baru
                        </a>
                        <a href="{{ route('admin.weddings.index') }}" class="block w-full text-center bg-gray-50 hover:bg-gray-100 text-gray-700 border border-gray-200 font-medium text-xs py-3 rounded-xl transition">
                            Kelola Semua Client
                        </a>
                    </div>
                </div>
                <div class="mt-4 flex items-center justify-between">
                    <form action="{{ route('admin.logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="text-white text-xs cursor-pointer hover:bg-[#732f2f] transition" style="background-color: #8b3a3a; border: none; padding: 7px 15px; border-radius: 6px;">
                            Log Out
                        </button>
                    </form>
                </div>
                <div class="text-[10px] text-gray-400 text-center mt-6 pt-4 border-t border-gray-100">
                    Logged in as: **Owner NantiKita.**
                </div>
            </div>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 space-y-6">
            <div>
                <h3 class="text-lg font-bold text-gray-800">💌 Log Ucapan & Kehadiran Tamu</h3>
                <p class="text-xs text-gray-400 mt-0.5">Pantau pesan ucapan dari tamu undangan dan unduh arsip data untuk kenangan klien.</p>
            </div>

            <div class="space-y-6">
                @forelse($weddings as $wed)
                    <div class="border border-gray-100 rounded-xl p-4 space-y-3 bg-gray-50/50">
                        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-2 pb-2 border-b border-gray-200/60">
                            <div>
                                <h4 class="font-bold text-gray-800 text-sm">Pasangan: {{ $wed->nama_pria }} & {{ $wed->nama_wanita }}</h4>
                                <p class="text-[11px] text-gray-400">Total Ucapan Terinput: {{ $wed->rsvps->count() }} data</p>
                            </div>
                            <a href="{{ route('admin.weddings.download_pdf', $wed->id) }}" class="inline-flex items-center gap-1.5 bg-amber-600 hover:bg-amber-700 text-white text-[11px] font-medium px-3 py-1.5 rounded-lg shadow-2xs transition">
                                📄 Unduh PDF Tabel
                            </a>
                        </div>

                        <div class="overflow-x-auto">
                            <table class="w-full text-left border-collapse text-xs">
                                <thead>
                                    <tr class="border-b border-gray-200 text-gray-400 uppercase tracking-wider text-[10px]">
                                        <th class="py-2 font-semibold">Nama Tamu</th>
                                        <th class="py-2 font-semibold">Alamat</th>
                                        <th class="py-2 font-semibold text-center">Status</th>
                                        <th class="py-2 font-semibold text-center">Jumlah</th>
                                        <th class="py-2 font-semibold">Isi Ucapan / Doa</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100 text-gray-700">
                                    @forelse($wed->rsvps as $rv)
                                        <tr>
                                            <td class="py-2.5 font-medium text-gray-900">{{ $rv->nama_tamu }}</td>
                                            <td class="py-2.5 text-gray-500">{{ $rv->alamat ?? '-' }}</td>
                                            <td class="py-2.5 text-center">
                                                <span class="px-2 py-0.5 rounded-full text-[10px] font-medium {{ $rv->status == 'hadir' ? 'bg-emerald-50 text-emerald-700' : 'bg-rose-50 text-rose-700' }}">
                                                    {{ $rv->status == 'hadir' ? 'Hadir' : 'Absen' }}
                                                </span>
                                            </td>
                                            <td class="py-2.5 text-center font-medium">{{ $rv->jumlah_hadir }}</td>
                                            <td class="py-2.5 text-gray-600 italic">"{{ $rv->ucapan ?? 'Memberikan doa restu.' }}"</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="py-4 text-center text-gray-400 italic">Belum ada tamu yang mengisi konfirmasi rsvp.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                @empty
                    <p class="text-sm text-gray-400 text-center py-6">Belum ada data pernikahan yang terdaftar.</p>
                @endforelse
            </div>
        </div>

    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center justify-between">
            <div class="space-y-2">
                <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Total Klien Aktif</p>
                <p class="text-3xl font-black text-gray-800">{{ $totalWeddings }} <span class="text-sm font-normal text-gray-400">Pasangan</span></p>
            </div>
            <div class="w-12 h-12 bg-brand-green/10 text-brand-green rounded-xl flex items-center justify-center text-xl font-bold">📋</div>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center justify-between">
            <div class="space-y-2">
                <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Estimasi Omzet Kasar</p>
                <p class="text-3xl font-black text-brand-green">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</p>
            </div>
            <div class="w-12 h-12 bg-emerald-50 text-emerald-700 rounded-xl flex items-center justify-center text-xl font-bold">💰</div>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center justify-between">
            <div class="space-y-2">
                <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Total Tamu Hadir (Fix)</p>
                <p class="text-3xl font-black text-gray-800">{{ $totalGuestsHadir }} <span class="text-sm font-normal text-gray-400">Orang</span></p>
            </div>
            <div class="w-12 h-12 bg-blue-50 text-blue-700 rounded-xl flex items-center justify-center text-xl font-bold">📨</div>
        </div>

    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        <div class="lg:col-span-2 bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
            <h3 class="text-lg font-bold text-gray-800 mb-4">✨ Registrasi Klien Terbaru</h3>
            <div class="divide-y divide-gray-100">
                @forelse($recentWeddings as $wedding)
                <div class="py-3 flex justify-between items-center first:pt-0 last:pb-0">
                    <div>
                        <p class="font-semibold text-gray-900 text-sm">{{ $wedding->nama_pria }} & {{ $wedding->nama_wanita }}</p>
                        <p class="text-xs text-gray-400 mt-0.5">Tema: <span class="capitalize font-medium">{{ $wedding->tema }}</span> | {{ \Carbon\Carbon::parse($wedding->tanggal_acara)->format('d M Y') }}</p>
                    </div>
                    <span class="px-2.5 py-1 text-xs font-semibold rounded-full {{ $wedding->paket == 'premium' ? 'bg-amber-50 text-amber-700 border border-amber-100' : 'bg-blue-50 text-blue-700 border border-blue-100' }}">
                        {{ ucfirst($wedding->paket) }}
                    </span>
                </div>
                @empty
                <p class="text-sm text-gray-400 text-center py-6">Belum ada aktivitas pendaftaran klien baru.</p>
                @endforelse
            </div>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex flex-col justify-between">
            <div>
                <h3 class="text-lg font-bold text-gray-800 mb-2">🚀 Akses Cepat</h3>
                <p class="text-xs text-gray-400 mb-4">Pintasan praktis untuk mempercepat alur kerja harian admin.</p>
                <div class="space-y-2">
                    <a href="{{ route('admin.weddings.create') }}" class="block w-full text-center bg-brand-green hover:bg-stone-700 text-white font-medium text-xs py-3 rounded-xl transition">
                        Tambah Undangan Baru
                    </a>
                    <a href="{{ route('admin.weddings.index') }}" class="block w-full text-center bg-gray-50 hover:bg-gray-100 text-gray-700 border border-gray-200 font-medium text-xs py-3 rounded-xl transition">
                        Kelola Semua Client
                    </a>
                </div>
            </div>
            <div class="text-[10px] text-gray-400 text-center mt-6 pt-4 border-t border-gray-100">
                Logged in as: **Owner NantiKita.**
            </div>
        </div>

    </div>
</div>
@endsection