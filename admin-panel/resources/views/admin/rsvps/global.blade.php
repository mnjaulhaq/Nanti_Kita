@extends('admin.layouts.app')

@section('content')
<div class="w-full bg-white p-6 rounded-xl shadow-sm border border-gray-100">
    
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-800">🌍 Pusat Kendali RSVP Global</h2>
        <p class="text-sm text-gray-500 mt-1">Memantau seluruh aktivitas konfirmasi kehadiran dan doa restu dari semua website undangan klien **NantiKita.**</p>
    </div>

    <div class="overflow-x-auto rounded-lg border border-gray-200">
        <table class="w-full text-left border-collapse bg-white">
            <thead class="bg-gray-50 text-xs font-semibold text-gray-600 uppercase tracking-wider border-b border-gray-200">
                <tr>
                    <th class="p-4">Target Undangan Klien</th>
                    <th class="p-4">Nama Tamu</th>
                    <th class="p-4">Konfirmasi</th>
                    <th class="p-4">Jumlah Hadir</th>
                    <th class="p-4">Isi Ucapan</th>
                    <th class="p-4">Waktu</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 text-sm text-gray-700">
                @forelse($rsvps as $rsvp)
                <tr class="hover:bg-gray-50/75 transition">
                    <td class="p-4 font-semibold text-[#2f3e36]">
                        {{ $rsvp->wedding->nama_pria }} & {{ $rsvp->wedding->nama_wanita }}
                    </td>
                    <td class="p-4 font-medium text-gray-900">{{ $rsvp->nama_tamu }}</td>
                    <td class="p-4">
                        @if($rsvp->status == 'hadir')
                        <span class="px-2 py-0.5 text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200 rounded">Hadir</span>
                        @else
                        <span class="px-2 py-0.5 text-xs font-semibold bg-rose-50 text-rose-700 border border-rose-200 rounded">Absen</span>
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
                    <td colspan="6" class="p-8 text-center text-gray-400">
                        Belum ada data konfirmasi masuk dari undangan manapun.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection