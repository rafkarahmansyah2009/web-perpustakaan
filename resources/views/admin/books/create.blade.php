<x-layouts.admin :header="'Tambah Buku'">
    <div class="max-w-5xl">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between mb-6 gap-4">
            <a href="{{ route('admin.books.index') }}" class="text-sm font-semibold text-[#414942] hover:text-[#1a4d2e] transition-colors flex items-center gap-2 group">
                <svg class="w-4 h-4 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Kembali ke Daftar Buku
            </a>
            <h2 class="text-xl font-headline font-bold text-[#1b1c19]">Tambah Buku Baru</h2>
        </div>

        <form method="POST" action="{{ route('admin.books.store') }}" enctype="multipart/form-data" class="space-y-6">
            @csrf
            
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Left Column (Main Info) -->
                <div class="lg:col-span-2 space-y-6">
                    <div class="bg-white rounded-card p-6" style="box-shadow: 0 2px 12px rgba(26,77,46,0.04);">
                        <h3 class="text-lg font-headline font-bold text-[#1a4d2e] mb-4 border-b border-[#eae8e3] pb-2">Informasi Utama</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div class="md:col-span-2">
                                <label class="block text-xs font-bold uppercase tracking-wider text-[#1a4d2e] mb-2">Judul Buku *</label>
                                <input type="text" name="judul" value="{{ old('judul') }}" required class="input-field text-lg font-semibold" placeholder="Masukkan judul buku">
                                @error('judul')<p class="text-xs text-[#c8401a] mt-1">{{ $message }}</p>@enderror
                            </div>
                            <div>
                                <label class="block text-xs font-bold uppercase tracking-wider text-[#1a4d2e] mb-2">Pengarang *</label>
                                <input type="text" name="pengarang" value="{{ old('pengarang') }}" required class="input-field" placeholder="Nama pengarang">
                                @error('pengarang')<p class="text-xs text-[#c8401a] mt-1">{{ $message }}</p>@enderror
                            </div>
                            <div>
                                <label class="block text-xs font-bold uppercase tracking-wider text-[#1a4d2e] mb-2">Penerbit</label>
                                <input type="text" name="penerbit" value="{{ old('penerbit') }}" class="input-field" placeholder="Nama penerbit">
                            </div>
                            <div>
                                <label class="block text-xs font-bold uppercase tracking-wider text-[#1a4d2e] mb-2">Tahun Terbit</label>
                                <input type="number" name="tahun_terbit" value="{{ old('tahun_terbit') }}" class="input-field" placeholder="Contoh: 2023">
                            </div>
                            <div>
                                <label class="block text-xs font-bold uppercase tracking-wider text-[#1a4d2e] mb-2">ISBN</label>
                                <input type="text" name="isbn" value="{{ old('isbn') }}" class="input-field font-mono text-sm" placeholder="Contoh: 978-602-...">
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-card p-6" style="box-shadow: 0 2px 12px rgba(26,77,46,0.04);">
                        <h3 class="text-lg font-headline font-bold text-[#1a4d2e] mb-4 border-b border-[#eae8e3] pb-2">Sinopsis / Deskripsi</h3>
                        <textarea name="deskripsi" rows="5" class="input-field leading-relaxed" placeholder="Tuliskan deskripsi atau sinopsis singkat buku ini...">{{ old('deskripsi') }}</textarea>
                    </div>
                </div>

                <!-- Right Column (Meta & Media) -->
                <div class="space-y-6">
                    <div class="bg-white rounded-card p-6" style="box-shadow: 0 2px 12px rgba(26,77,46,0.04);">
                        <h3 class="text-lg font-headline font-bold text-[#1a4d2e] mb-4 border-b border-[#eae8e3] pb-2">Klasifikasi & Inventaris</h3>
                        <div class="space-y-5">
                            <div>
                                <label class="block text-xs font-bold uppercase tracking-wider text-[#1a4d2e] mb-2">Kategori *</label>
                                <select name="kategori_id" required class="input-field">
                                    <option value="">-- Pilih Kategori --</option>
                                    @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}" {{ old('kategori_id') == $cat->id ? 'selected' : '' }}>{{ $cat->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-xs font-bold uppercase tracking-wider text-[#1a4d2e] mb-2">Stok *</label>
                                    <input type="number" name="stok" value="{{ old('stok', 0) }}" required class="input-field text-center font-bold text-lg" min="0">
                                </div>
                                <div>
                                    <label class="block text-xs font-bold uppercase tracking-wider text-[#1a4d2e] mb-2">Lokasi Rak</label>
                                    <input type="text" name="lokasi_rak" value="{{ old('lokasi_rak') }}" class="input-field text-center font-bold" placeholder="Misal: A1">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-card p-6" style="box-shadow: 0 2px 12px rgba(26,77,46,0.04);">
                        <h3 class="text-lg font-headline font-bold text-[#1a4d2e] mb-4 border-b border-[#eae8e3] pb-2">Cover Buku</h3>
                        <div class="flex flex-col items-center">
                            <div class="w-32 h-44 bg-[#f0eee9] rounded shadow-inner flex items-center justify-center text-[#a1a6a2] mb-4 border-2 border-dashed border-[#c1c9bf]">
                                <div class="text-center">
                                    <svg class="w-8 h-8 mx-auto mb-2 text-[#717971]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    <span class="text-xs">Pilih Cover</span>
                                </div>
                            </div>
                            <input type="file" name="cover" accept="image/*" class="block w-full text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-[#eef2ef] file:text-[#1a4d2e] hover:file:bg-[#e2dfd5] transition-colors cursor-pointer">
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="flex justify-end gap-4 mt-8 bg-white p-4 rounded-card border border-[#eae8e3] items-center" style="box-shadow: 0 -4px 12px rgba(26,77,46,0.02);">
                <a href="{{ route('admin.books.index') }}" class="px-6 py-2.5 rounded-button font-bold text-[#414942] hover:bg-[#f0eee9] transition-colors">Batal</a>
                <button type="submit" class="btn-primary px-8 py-2.5 text-sm">Simpan Buku</button>
            </div>
        </form>
    </div>
</x-layouts.admin>
