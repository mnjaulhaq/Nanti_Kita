@extends('admin.layouts.app')

@section('content')
<div class="w-full max-w-4xl bg-white p-8 rounded-xl shadow-md border border-gray-100">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">✏️ Edit Data Undangan Klien</h2>

    <form action="{{ route('admin.weddings.update', $wedding->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Nama Pengantin Pria</label>
                <input type="text" name="nama_pria" value="{{ $wedding->nama_pria }}" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-stone-500 focus:outline-none">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Nama Pengantin Wanita</label>
                <input type="text" name="nama_wanita" value="{{ $wedding->nama_wanita }}" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-stone-500 focus:outline-none">
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Pernikahan</label>
                <input type="date" name="tanggal_acara" value="{{ $wedding->tanggal_acara }}" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-stone-500 focus:outline-none">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Pilih Tema Desain</label>
                <select name="tema" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-stone-500 focus:outline-none">
                    <option value="rustic" {{ $wedding->tema == 'rustic' ? 'selected' : '' }}>Rustic</option>
                    <option value="modern" {{ $wedding->tema == 'modern' ? 'selected' : '' }}>Modern</option>
                    <option value="sage" {{ $wedding->tema == 'sage' ? 'selected' : '' }}>Sage & Botanical</option>
                    <option value="midnight" {{ $wedding->tema == 'midnight' ? 'selected' : '' }}>Midnight Romantic</option>
                    <option value="japandi" {{ $wedding->tema == 'japandi' ? 'selected' : '' }}>Japandi</option>
                    <option value="cinematic" {{ $wedding->tema == 'cinematic' ? 'selected' : '' }}>Cinematic</option>
                </select>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Jenis Paket</label>
                <select name="paket" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-stone-500 focus:outline-none">
                    <option value="basic" {{ $wedding->paket == 'basic' ? 'selected' : '' }}>Basic (Standar)</option>
                    <option value="premium" {{ $wedding->paket == 'premium' ? 'selected' : '' }}>Premium</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Link Musik Latar (Optional)</label>
                <input type="url" name="musik_url" value="{{ $wedding->musik_url }}" placeholder="https://youtube.com/..." class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-stone-500 focus:outline-none">
            </div>
        </div>

        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700 mb-2">Lokasi Acara / Alamat Lengkap</label>
            <textarea name="lokasi_acara" rows="3" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-stone-500 focus:outline-none">{{ $wedding->lokasi_acara }}</textarea>
        </div>

        <div class="flex justify-end space-x-3">
            <a href="{{ route('admin.weddings.index') }}" class="bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium px-6 py-3 rounded-lg transition">Batal</a>
            <button type="submit" class="bg-brand-green hover:bg-stone-700 text-white font-semibold px-6 py-3 rounded-lg shadow-md transition">
                💾 Simpan Perubahan
            </button>
        </div>
    </form>
</div>
@endsection