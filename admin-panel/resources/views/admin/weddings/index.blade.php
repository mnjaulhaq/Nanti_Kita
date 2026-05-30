@extends('admin.layouts.app')

@section('content')
<div class="w-full bg-white p-6 rounded-xl shadow-sm border border-gray-100">
    
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">📋 Data Client</h2>
            <p class="text-sm text-gray-500 mt-1">Daftar semua pengantin yang menggunakan jasa NantiKita.</p>
        </div>
        <a href="{{ route('admin.weddings.create') }}" class="bg-brand-green hover:bg-stone-700 text-white font-medium px-4 py-2.5 rounded-lg shadow transition flex items-center space-x-2 text-sm">
            <span>[+]</span> <span>Tambah Undangan Baru</span>
        </a>
    </div>

    <div class="overflow-x-auto rounded-lg border border-gray-200">
        <table class="w-full text-left border-collapse bg-white">
            <thead class="bg-gray-50 text-xs font-semibold text-gray-600 uppercase tracking-wider border-b border-gray-200">
                <tr>
                    <th class="p-4">Nama Pengantin</th>
                    <th class="p-4">Tanggal Acara</th>
                    <th class="p-4">Tema Desain</th>
                    <th class="p-4">Paket</th>
                    <th class="p-4">Link Undangan</th>
                    <th class="p-4 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 text-sm text-gray-700">
                @forelse($weddings as $wedding)
                <tr class="hover:bg-gray-50/75 transition">
                    <td class="p-4 font-medium text-gray-900">
                        {{ $wedding->nama_pria }} & {{ $wedding->nama_wanita }}
                    </td>
                    <td class="p-4">
                        {{ \Carbon\Carbon::parse($wedding->tanggal_acara)->translatedFormat('d F Y') }}
                    </td>
                    <td class="p-4 capitalize">
                        <span class="px-2.5 py-1 text-xs font-medium bg-stone-100 text-stone-800 rounded-full">
                            {{ $wedding->tema }}
                        </span>
                    </td>
                    <td class="p-4">
                        @if($wedding->paket == 'premium')
                        <span class="px-2.5 py-1 text-xs font-semibold bg-amber-50 text-amber-700 border border-amber-200 rounded-full flex items-center w-max space-x-1">
                            <span>👑</span> <span>Premium</span>
                        </span>
                        @else
                        <span class="px-2.5 py-1 text-xs font-medium bg-blue-50 text-blue-700 border border-blue-200 rounded-full flex items-center w-max space-x-1">
                            <span>📦</span> <span>Basic</span>
                        </span>
                        @endif
                    </td>
                    <td class="p-4">
                        <div class="flex items-center space-x-2">
                            @php
                                // Membuat URL demo undangan berdasarkan slug
                                $urlUndangan = url('/wedding/' . $wedding->slug);
                            @endphp
                            <input type="text" readonly value="{{ $urlUndangan }}" id="link-{{ $wedding->id }}" class="bg-gray-50 border border-gray-200 rounded px-2 py-1 text-xs text-gray-600 w-48 focus:outline-none">
                            
                            <button onclick="copyToClipboard('{{ $wedding->id }}')" class="bg-gray-100 hover:bg-gray-200 text-gray-700 p-1.5 rounded transition text-xs font-medium" title="Salin Link">
                                📋 Copy
                            </button>
                        </div>
                    </td>
                    <td class="p-4 text-center flex items-center justify-center space-x-2">
                        <a href="{{ route('admin.weddings.edit', $wedding->id) }}" class="text-blue-600 hover:text-blue-900 font-medium text-xs bg-blue-50 hover:bg-blue-100 px-2.5 py-1.5 rounded transition">
                            Edit
                        </a>
                        <form action="{{ route('admin.weddings.destroy', $wedding->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus client ini? Semua data RSVP juga akan terhapus.');" class="inline">
                            @csrf
                            @method('DELETE')
                            <a href="{{ route('admin.weddings.rsvps', $wedding->id) }}" class="text-emerald-600 hover:text-emerald-900 font-medium text-xs bg-emerald-50 hover:bg-emerald-100 px-2.5 py-1.5 rounded transition">
                                 Lihat RSVP ({{ $wedding->rsvps->count() }})
                            </a>
                            <button type="submit" class="text-red-600 hover:text-red-900 font-medium text-xs bg-red-50 hover:bg-red-100 px-2.5 py-1.5 rounded transition">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="p-8 text-center text-gray-400">
                        Belum ada data client. Klik "Tambah Undangan Baru" untuk memulai.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<script>
    function copyToClipboard(id) {
        var copyText = document.getElementById("link-" + id);
        copyText.select();
        copyText.setSelectionRange(0, 99999); // Untuk perangkat mobile

        navigator.clipboard.writeText(copyText.value);
        
        alert("Link undangan berhasil disalin!");
    }
</script>
@endsection