<x-layouts.admin :header="'Tambah Buku'">
    <div class="max-w-2xl">
        <a href="{{ route('admin.books.index') }}" class="text-sm text-[#1a4d2e] hover:underline mb-6 inline-block">← Kembali</a>

        <div class="bg-white rounded-card p-8" style="box-shadow: 0 2px 12px rgba(26,77,46,0.04);">
            <form method="POST" action="{{ route('admin.books.store') }}" enctype="multipart/form-data" class="space-y-5">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-[#1a4d2e] mb-2">Judul *</label>
                        <input type="text" name="judul" value="{{ old('judul') }}" required class="input-field">
                        @error('judul')<p class="text-xs text-[#c8401a] mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-[#1a4d2e] mb-2">ISBN</label>
                        <input type="text" name="isbn" value="{{ old('isbn') }}" class="input-field">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-[#1a4d2e] mb-2">Pengarang *</label>
                        <input type="text" name="pengarang" value="{{ old('pengarang') }}" required class="input-field">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-[#1a4d2e] mb-2">Penerbit</label>
                        <input type="text" name="penerbit" value="{{ old('penerbit') }}" class="input-field">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-[#1a4d2e] mb-2">Tahun Terbit</label>
                        <input type="number" name="tahun_terbit" value="{{ old('tahun_terbit') }}" class="input-field">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-[#1a4d2e] mb-2">Kategori *</label>
                        <select name="kategori_id" required class="input-field">
                            <option value="">Pilih Kategori</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" {{ old('kategori_id') == $cat->id ? 'selected' : '' }}>{{ $cat->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-[#1a4d2e] mb-2">Stok *</label>
                        <input type="number" name="stok" value="{{ old('stok', 0) }}" required class="input-field" min="0">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-[#1a4d2e] mb-2">Lokasi Rak</label>
                        <input type="text" name="lokasi_rak" value="{{ old('lokasi_rak') }}" class="input-field">
                    </div>
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-[#1a4d2e] mb-2">Deskripsi</label>
                    <textarea name="deskripsi" rows="4" class="input-field">{{ old('deskripsi') }}</textarea>
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-[#1a4d2e] mb-2">Cover Buku</label>
                    <input type="file" name="cover" accept="image/*" class="input-field">
                </div>
                <button type="submit" class="btn-primary">Simpan Buku</button>
            </form>
        </div>
    </div>
</x-layouts.admin>
