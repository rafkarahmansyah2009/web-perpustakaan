<x-layouts.admin :header="'Edit Anggota'">
    <div class="max-w-5xl">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between mb-6 gap-4">
            <a href="{{ route('admin.members.index') }}" class="text-sm font-semibold text-[#414942] hover:text-[#1a4d2e] transition-colors flex items-center gap-2 group">
                <svg class="w-4 h-4 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Kembali ke Daftar Anggota
            </a>
            <div class="flex items-center gap-3">
                <span class="px-3 py-1 text-xs font-bold rounded-full {{ $member->status_aktif ? 'bg-[#eef2ef] text-[#1a4d2e]' : 'bg-red-100 text-red-700' }}">
                    {{ $member->status_aktif ? 'Aktif' : 'Nonaktif' }}
                </span>
                <h2 class="text-xl font-headline font-bold text-[#1b1c19]">{{ $member->name }}</h2>
            </div>
        </div>
        
        <form method="POST" action="{{ route('admin.members.update', $member) }}" enctype="multipart/form-data" class="space-y-6">
            @csrf @method('PUT')
            
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Left Column (User Info) -->
                <div class="lg:col-span-2 space-y-6">
                    <div class="bg-white rounded-card p-6" style="box-shadow: 0 2px 12px rgba(26,77,46,0.04);">
                        <h3 class="text-lg font-headline font-bold text-[#1a4d2e] mb-4 border-b border-[#eae8e3] pb-2">Data Pribadi</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div class="md:col-span-2">
                                <label class="block text-xs font-bold uppercase tracking-wider text-[#1a4d2e] mb-2">Nama Lengkap *</label>
                                <input type="text" name="name" value="{{ old('name', $member->name) }}" required class="input-field text-lg font-semibold">
                            </div>
                            <div>
                                <label class="block text-xs font-bold uppercase tracking-wider text-[#1a4d2e] mb-2">Email *</label>
                                <input type="email" name="email" value="{{ old('email', $member->email) }}" required class="input-field">
                            </div>
                            <div>
                                <label class="block text-xs font-bold uppercase tracking-wider text-[#1a4d2e] mb-2">No. Telp</label>
                                <input type="text" name="no_telp" value="{{ old('no_telp', $member->no_telp) }}" class="input-field">
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-card p-6" style="box-shadow: 0 2px 12px rgba(26,77,46,0.04);">
                        <div class="flex justify-between items-center mb-4 border-b border-[#eae8e3] pb-2">
                            <h3 class="text-lg font-headline font-bold text-[#1a4d2e]">Identitas Institusi</h3>
                            <span class="text-xs text-[#717971] uppercase tracking-wider font-bold bg-[#f0eee9] px-2 py-0.5 rounded-full" id="role-badge">{{ ucfirst($member->role) }}</span>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div>
                                <label class="block text-xs font-bold uppercase tracking-wider text-[#1a4d2e] mb-2">Peran (Role) *</label>
                                <select name="role" required class="input-field" onchange="document.getElementById('role-badge').innerText = this.options[this.selectedIndex].text">
                                    <option value="siswa" {{ old('role', $member->role) == 'siswa' ? 'selected' : '' }}>Siswa</option>
                                    <option value="guru" {{ old('role', $member->role) == 'guru' ? 'selected' : '' }}>Guru</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-xs font-bold uppercase tracking-wider text-[#1a4d2e] mb-2">Kelas <span class="normal-case font-normal text-[#717971]">(untuk siswa)</span></label>
                                <input type="text" name="kelas" value="{{ old('kelas', $member->kelas) }}" class="input-field">
                            </div>
                            <div>
                                <label class="block text-xs font-bold uppercase tracking-wider text-[#1a4d2e] mb-2">NIS <span class="normal-case font-normal text-[#717971]">(untuk siswa)</span></label>
                                <input type="text" name="nis" value="{{ old('nis', $member->nis) }}" class="input-field font-mono">
                            </div>
                            <div>
                                <label class="block text-xs font-bold uppercase tracking-wider text-[#1a4d2e] mb-2">NIP <span class="normal-case font-normal text-[#717971]">(untuk guru)</span></label>
                                <input type="text" name="nip" value="{{ old('nip', $member->nip) }}" class="input-field font-mono">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column (Security & Photo) -->
                <div class="space-y-6">
                    <div class="bg-white rounded-card p-6" style="box-shadow: 0 2px 12px rgba(26,77,46,0.04);">
                        <h3 class="text-lg font-headline font-bold text-[#1a4d2e] mb-4 border-b border-[#eae8e3] pb-2">Foto Profil</h3>
                        <div class="flex flex-col items-center">
                            @if($member->foto)
                            <img src="{{ Storage::url($member->foto) }}" class="w-32 h-32 rounded-full object-cover mb-4 shadow-md border-4 border-[#f0eee9]">
                            @else
                            <div class="w-32 h-32 rounded-full bg-[#1a4d2e] flex items-center justify-center text-white text-4xl font-bold mb-4 shadow-md border-4 border-[#f0eee9]">
                                {{ strtoupper(substr($member->name, 0, 2)) }}
                            </div>
                            @endif
                            <input type="file" name="foto" accept="image/*" class="block w-full text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-[#eef2ef] file:text-[#1a4d2e] hover:file:bg-[#e2dfd5] transition-colors cursor-pointer">
                        </div>
                    </div>

                    <div class="bg-white rounded-card p-6" style="box-shadow: 0 2px 12px rgba(26,77,46,0.04);">
                        <h3 class="text-lg font-headline font-bold text-[#1a4d2e] mb-4 border-b border-[#eae8e3] pb-2">Keamanan & Status</h3>
                        <div class="space-y-5">
                            <div>
                                <label class="block text-xs font-bold uppercase tracking-wider text-[#1a4d2e] mb-2">Password <span class="normal-case font-normal text-[#717971]">(kosongkan jika tidak diubah)</span></label>
                                <div class="password-wrapper">
                                    <input type="password" name="password" id="password" class="input-field" minlength="8" placeholder="••••••••">
                                    <button type="button" class="toggle-password" data-target="password">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            
                            <div class="pt-2">
                                <label class="flex items-start p-3 border border-[#eae8e3] rounded-lg cursor-pointer hover:bg-[#faf9f7] transition-colors">
                                    <input type="hidden" name="status_aktif" value="0">
                                    <input type="checkbox" name="status_aktif" value="1" {{ old('status_aktif', $member->status_aktif) ? 'checked' : '' }} class="mt-0.5 w-5 h-5 rounded border-[#c1c9bf] text-[#1a4d2e] focus:ring-[#1a4d2e]">
                                    <div class="ml-3">
                                        <span class="block text-sm font-bold text-[#414942]">Status Aktif</span>
                                        <span class="block text-xs text-[#717971] mt-0.5">Izinkan anggota ini login dan menggunakan layanan perpustakaan.</span>
                                    </div>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="flex justify-end gap-4 mt-8 bg-white p-4 rounded-card border border-[#eae8e3] items-center" style="box-shadow: 0 -4px 12px rgba(26,77,46,0.02);">
                <a href="{{ route('admin.members.index') }}" class="px-6 py-2.5 rounded-button font-bold text-[#414942] hover:bg-[#f0eee9] transition-colors">Batal</a>
                <button type="submit" class="btn-primary px-8 py-2.5 text-sm">Simpan Perubahan Anggota</button>
            </div>
        </form>
    </div>
</x-layouts.admin>
