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
            <div class="text-[10px] text-gray-400 text-center mt-6 pt-4 border-t border-gray-100">
                Logged in as: **Owner NantiKita.**
            </div>
        </div>

    </div>
</div>
@endsection