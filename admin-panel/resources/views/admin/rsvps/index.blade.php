@extends('admin.layouts.app')

@section('content')
<div class="w-full bg-white p-6 rounded-xl shadow-sm border border-gray-100">
    
    <div class="mb-6">
        <a href="{{ route('admin.weddings.index') }}" class="text-xs text-brand-green font-medium hover:underline flex items-center space-x-1 mb-2">
            <span>←</span> <span>Kembali ke Data Client</span>
        </a>
        <h2 class="text-2xl font-bold text-gray-800">📨 Daftar Kehadiran Tamu (RSVP)</h2>
        <p class="text-sm text-gray-500 mt-1">
            Pernikahan: <span class="font-semibold text-brand-green">{{ $wedding->nama_pria }} & {{ $wedding->nama_wanita }}</span>
        </p>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-6">
        <div class="bg-emerald-50 border border-emerald-100 p-4 rounded-xl">
            <p class="text-xs font-semibold text-emerald-700 uppercase">Total Tamu Hadir</p>
            <p class="text-2xl font-bold text-emerald-900 mt-1">{{ $wedding->rsvps->where('status', 'hadir')->sum('jumlah_hadir') }} Orang</p>
        </div>
        <div class="bg-rose-50 border border-rose-100 p-4 rounded-xl">
            <p class="text-xs font-semibold text-rose-700 uppercase">Berhalangan Hadir</p>
            <p class="text-2xl font-bold text-rose-900 mt-1">{{ $wedding->rsvps->where('status', 'tidak_hadir')->count() }} Tamu</p>
        </div>
        <div class="bg-stone-50 border border-stone-200 p-4 rounded-xl">
            <p class="text-xs font-semibold text-stone-600 uppercase">Total Ucapan Masuk</p>
            <p class="text-2xl font-bold text-stone-800 mt-1">{{ $wedding->rsvps->count() }} Ucapan</p>
        </div>
    </div>

    <div class="overflow-x-auto rounded-lg border border-gray-200">
        <table class="w-full text-left border-collapse bg-white">
            <thead class="bg-gray-50 text-xs font-semibold text-gray-600 uppercase tracking-wider border-b border-gray-200">
                <tr>
                    <th class="p-4">Nama Tamu</th>
                    <th class="p-4">Status Konfirmasi</th>
                    <th class="p-4">Jumlah Hadir</th>
                    <th class="p-4">Ucapan / Doa Restu</th>
                    <th class="p-4">Waktu Mengisi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 text-sm text-gray-700">
                @forelse($wedding->rsvps as $rsvp)
                <tr class="hover:bg-gray-50/75 transition">
                    <td class="p-4 font-medium text-gray-900">{{ $rsvp->nama_tamu }}</td>
                    <td class="p-4">
                        @if($rsvp->status == 'hadir')
                        <span class="px-2 py-0.5 text-xs font-medium bg-emerald-50 text-emerald-700 border border-emerald-200 rounded">Hadir</span>
                        @else
                        <span class="px-2 py-0.5 text-xs font-medium bg-rose-50 text-rose-700 border border-rose-200 rounded">Absen</span>
                        @endif
                    </td>
                    <td class="p-4">{{ $rsvp->jumlah_hadir }} Orang</td>
                    <td class="p-4 italic text-gray-600 max-w-xs truncate" title="{{ $rsvp->ucapan }}">
                        "{{ $rsvp->ucapan ?? '-' }}"
                    </td>
                    <td class="p-4 text-xs text-gray-400">
                        {{ $rsvp->created_at->diffForHumans() }}
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="p-8 text-center text-gray-400">
                        Belum ada tamu yang mengisi konfirmasi kehadiran (RSVP).
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection