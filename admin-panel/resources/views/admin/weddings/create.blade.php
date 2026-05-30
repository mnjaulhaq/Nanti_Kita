@extends('admin.layouts.app')

@section('content')
<div class="max-w-3xl bg-white p-8 rounded-xl shadow-md border border-gray-100">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">✨ Buat Undangan Pengantin Baru</h2>

    <form action="{{ route('admin.weddings.store') }}" method="POST">
        @csrf
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <!-- Nama Pria -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Nama Pengantin Pria</label>
                <input type="text" name="nama_pria" required placeholder="Contoh: Andi" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none">
            </div>
            <!-- Nama Wanita -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Nama Pengantin Wanita</label>
                <input type="text" name="nama_wanita" required placeholder="Contoh: Siti" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none">
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <!-- Tanggal -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Pernikahan</label>
                <input type="date" name="tanggal_acara" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none">
            </div>
            <!-- Pilihan Tema -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Pilih Tema Desain</label>
                <select name="tema" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                    <option value="rustic">Rustic</option>
                    <option value="modern">Modern</option>
                    <option value="sage">Sage & Botanical</option>
                    <option value="midnight">Midnight Romantic</option>
                    <option value="japandi">Japandi</option>
                    <option value="cinematic">Cinematic</option>
                </select>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <!-- Paket -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Jenis Paket</label>
                <select name="paket" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                    <option value="basic">Basic (Standar)</option>
                    <option value="premium">Premium (Fitur Lengkap + Custom Name Guest)</option>
                </select>
            </div>
            <!-- Musik -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Link Musik Latar (Optional)</label>
                <input type="url" name="musik_url" placeholder="https://youtube.com/... atau mp3 link" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none">
            </div>
        </div>

        <!-- Lokasi -->
        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700 mb-2">Lokasi Acara / Alamat Lengkap</label>
            <textarea name="lokasi_acara" rows="3" required placeholder="Gedung Sasana Budaya, Jl. Merdeka No. 12, Jakarta" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none"></textarea>
        </div>

        <!-- Tombol Generate -->
        <div class="flex justify-end">
            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-6 py-3 rounded-lg shadow-md hover:shadow-lg transition">
                🚀 Generate Undangan
            </button>
        </div>
    </form>
</div>
@endsection