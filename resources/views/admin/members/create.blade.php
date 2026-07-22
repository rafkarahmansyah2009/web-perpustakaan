<x-layouts.admin :header="'Tambah Anggota'">
    <div class="max-w-5xl">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between mb-6 gap-4">
            <a href="{{ route('admin.members.index') }}" class="text-sm font-semibold text-[#414942] hover:text-[#1a4d2e] transition-colors flex items-center gap-2 group">
                <svg class="w-4 h-4 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Kembali ke Daftar Anggota
            </a>
            <h2 class="text-xl font-headline font-bold text-[#1b1c19]">Tambah Anggota Baru</h2>
        </div>
        
        <form method="POST" action="{{ route('admin.members.store') }}" enctype="multipart/form-data" class="space-y-6">
            @csrf
            
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Left Column (User Info) -->
                <div class="lg:col-span-2 space-y-6">
                    <div class="bg-white rounded-card p-6" style="box-shadow: 0 2px 12px rgba(26,77,46,0.04);">
                        <h3 class="text-lg font-headline font-bold text-[#1a4d2e] mb-4 border-b border-[#eae8e3] pb-2">Data Pribadi</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div class="md:col-span-2">
                                <label class="block text-xs font-bold uppercase tracking-wider text-[#1a4d2e] mb-2">Nama Lengkap *</label>
                                <input type="text" name="name" value="{{ old('name') }}" required class="input-field text-lg font-semibold" placeholder="Masukkan nama lengkap">
                                @error('name')<p class="text-xs text-[#c8401a] mt-1">{{ $message }}</p>@enderror
                            </div>
                            <div>
                                <label class="block text-xs font-bold uppercase tracking-wider text-[#1a4d2e] mb-2">Email *</label>
                                <input type="email" name="email" value="{{ old('email') }}" required class="input-field" placeholder="contoh@email.com">
                                @error('email')<p class="text-xs text-[#c8401a] mt-1">{{ $message }}</p>@enderror
                            </div>
                            <div>
                                <label class="block text-xs font-bold uppercase tracking-wider text-[#1a4d2e] mb-2">No. Telp</label>
                                <input type="text" name="no_telp" value="{{ old('no_telp') }}" class="input-field" placeholder="08...">
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-card p-6" style="box-shadow: 0 2px 12px rgba(26,77,46,0.04);">
                        <div class="flex justify-between items-center mb-4 border-b border-[#eae8e3] pb-2">
                            <h3 class="text-lg font-headline font-bold text-[#1a4d2e]">Identitas Institusi</h3>
                            <span class="text-xs text-[#717971] uppercase tracking-wider font-bold bg-[#f0eee9] px-2 py-0.5 rounded-full" id="role-badge">Siswa</span>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div>
                                <label class="block text-xs font-bold uppercase tracking-wider text-[#1a4d2e] mb-2">Peran (Role) *</label>
                                <select name="role" required class="input-field" onchange="document.getElementById('role-badge').innerText = this.options[this.selectedIndex].text">
                                    <option value="siswa" {{ old('role') == 'siswa' ? 'selected' : '' }}>Siswa</option>
                                    <option value="guru" {{ old('role') == 'guru' ? 'selected' : '' }}>Guru</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-xs font-bold uppercase tracking-wider text-[#1a4d2e] mb-2">Kelas <span class="normal-case font-normal text-[#717971]">(untuk siswa)</span></label>
                                <input type="text" name="kelas" value="{{ old('kelas') }}" class="input-field" placeholder="Misal: X RPL 1">
                            </div>
                            <div>
                                <label class="block text-xs font-bold uppercase tracking-wider text-[#1a4d2e] mb-2">NIS <span class="normal-case font-normal text-[#717971]">(untuk siswa)</span></label>
                                <input type="text" name="nis" value="{{ old('nis') }}" class="input-field font-mono" placeholder="Nomor Induk Siswa">
                            </div>
                            <div>
                                <label class="block text-xs font-bold uppercase tracking-wider text-[#1a4d2e] mb-2">NIP <span class="normal-case font-normal text-[#717971]">(untuk guru)</span></label>
                                <input type="text" name="nip" value="{{ old('nip') }}" class="input-field font-mono" placeholder="Nomor Induk Pegawai">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column (Security & Photo) -->
                <div class="space-y-6">
                    <div class="bg-white rounded-card p-6" style="box-shadow: 0 2px 12px rgba(26,77,46,0.04);">
                        <h3 class="text-lg font-headline font-bold text-[#1a4d2e] mb-4 border-b border-[#eae8e3] pb-2">Foto Profil</h3>
                        <div class="flex flex-col items-center">
                            <div class="w-32 h-32 rounded-full bg-[#f0eee9] flex items-center justify-center text-[#a1a6a2] mb-4 shadow-md border-4 border-[#f0eee9]">
                                <svg class="w-12 h-12 text-[#c1c9bf]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                            <input type="file" name="foto" accept="image/*" class="block w-full text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-[#eef2ef] file:text-[#1a4d2e] hover:file:bg-[#e2dfd5] transition-colors cursor-pointer">
                        </div>
                    </div>

                    <div class="bg-white rounded-card p-6" style="box-shadow: 0 2px 12px rgba(26,77,46,0.04);">
                        <h3 class="text-lg font-headline font-bold text-[#1a4d2e] mb-4 border-b border-[#eae8e3] pb-2">Keamanan</h3>
                        <div class="space-y-5">
                            <div>
                                <label class="block text-xs font-bold uppercase tracking-wider text-[#1a4d2e] mb-2">Password *</label>
                                <div class="password-wrapper">
                                    <input type="password" name="password" id="password" required class="input-field" minlength="8" placeholder="Minimal 8 karakter">
                                    <button type="button" class="toggle-password" data-target="password">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="flex justify-end gap-4 mt-8 bg-white p-4 rounded-card border border-[#eae8e3] items-center" style="box-shadow: 0 -4px 12px rgba(26,77,46,0.02);">
                <a href="{{ route('admin.members.index') }}" class="px-6 py-2.5 rounded-button font-bold text-[#414942] hover:bg-[#f0eee9] transition-colors">Batal</a>
                <button type="submit" class="btn-primary px-8 py-2.5 text-sm">Simpan Anggota</button>
            </div>
        </form>
    </div>
</x-layouts.admin>
