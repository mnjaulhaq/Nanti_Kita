@extends('admin.layouts.app')

@section('content')
    <div class="w-full bg-white p-6 rounded-xl shadow-sm border border-gray-100">

        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
            <div>
                <h2 class="text-2xl font-bold text-gray-800">📋 Data Client</h2>
                <p class="text-sm text-gray-500 mt-1">Daftar semua pengantin yang menggunakan jasa NantiKita.</p>
            </div>
            <a href="{{ route('admin.weddings.create') }}"
                class="bg-brand-green hover:bg-stone-700 text-white font-medium px-4 py-2.5 rounded-lg shadow transition flex items-center space-x-2 text-sm">
                <span>[+]</span> <span>Tambah Undangan Baru</span>
            </a>
        </div>

        <div class="overflow-x-auto rounded-lg border border-gray-200">
            <table class="w-full text-left border-collapse bg-white">
                <thead
                    class="bg-gray-50 text-xs font-semibold text-gray-600 uppercase tracking-wider border-b border-gray-200">
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
                                @if ($wedding->paket == 'premium')
                                    <span
                                        class="px-2.5 py-1 text-xs font-semibold bg-amber-50 text-amber-700 border border-amber-200 rounded-full flex items-center w-max space-x-1">
                                        <span>👑</span> <span>Premium</span>
                                    </span>
                                @else
                                    <span
                                        class="px-2.5 py-1 text-xs font-medium bg-blue-50 text-blue-700 border border-blue-200 rounded-full flex items-center w-max space-x-1">
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
                                    <input type="text" readonly value="{{ $urlUndangan }}" id="link-{{ $wedding->id }}"
                                        class="bg-gray-50 border border-gray-200 rounded px-2 py-1 text-xs text-gray-600 w-48 focus:outline-none">

                                    <button type="button"
                                        onclick="copyToClipboard('{{ url('/wedding') }}/{{ $wedding->slug }}?to=NamaTamu')"
                                        class="px-3 py-1 bg-stone-50 text-stone-700 border border-stone-200 hover:bg-stone-100 transition rounded-md text-xs font-semibold flex items-center space-x-1">
                                        <span>📋</span> <span>Copy</span>
                                    </button>
                                </div>
                            </td>
                            <td class="p-4 text-center flex items-center justify-center space-x-2">
                                <a href="{{ route('admin.weddings.edit', $wedding->id) }}"
                                    class="text-blue-600 hover:text-blue-900 font-medium text-xs bg-blue-50 hover:bg-blue-100 px-2.5 py-1.5 rounded transition">
                                    Edit
                                </a>
                                <form action="{{ route('admin.weddings.destroy', $wedding->id) }}" method="POST"
                                    id="delete-form-{{ $wedding->id }}" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" onclick="confirmDelete({{ $wedding->id }})"
                                        class="px-3 py-1 bg-rose-50 text-rose-600 border border-rose-200 hover:bg-rose-100 transition rounded-md text-xs font-semibold">
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

        function confirmDelete(id) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Semua data RSVP milik client ini juga akan terhapus permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#2f3e36', // Warna Sage Gelap khas NantiKita
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus Data!',
                cancelButtonText: 'Batal',
                background: '#ffffff',
                borderRadius: '12px',
                customClass: {
                    popup: 'rounded-xl shadow-lg border border-gray-100'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    // Jalankan submit form jika admin menekan tombol "Ya"
                    document.getElementById('delete-form-' + id).submit();
                }
            })
        }

        function copyToClipboard(text) {
            // 1. Logika menyalin teks ke clipboard system laptop
            navigator.clipboard.writeText(text).then(() => {

                // 2. Konfigurasi Toast kecil ala platform profesional
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end', // Muncul di pojok kanan atas layar
                    showConfirmButton: false,
                    timer: 2000, // Hilang otomatis dalam 2 detik
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                });

                Toast.fire({
                    icon: 'success',
                    title: 'Tautan undangan berhasil disalin!',
                    background: '#ffffff',
                    customClass: {
                        popup: 'rounded-lg shadow-md border border-emerald-100'
                    }
                });

            }).catch(err => {
                console.error('Gagal menyalin teks: ', err);
            });
        }
    </script>
@endsection
