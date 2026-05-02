<x-layouts.admin :header="'Tambah Anggota'">
    <div class="max-w-2xl">
        <a href="{{ route('admin.members.index') }}" class="text-sm text-[#1a4d2e] hover:underline mb-6 inline-block">← Kembali</a>
        <div class="bg-white rounded-card p-8" style="box-shadow: 0 2px 12px rgba(26,77,46,0.04);">
            <form method="POST" action="{{ route('admin.members.store') }}" enctype="multipart/form-data" class="space-y-5">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-[#1a4d2e] mb-2">Nama *</label>
                        <input type="text" name="name" value="{{ old('name') }}" required class="input-field">
                        @error('name')<p class="text-xs text-[#c8401a] mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-[#1a4d2e] mb-2">Email *</label>
                        <input type="email" name="email" value="{{ old('email') }}" required class="input-field">
                        @error('email')<p class="text-xs text-[#c8401a] mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-[#1a4d2e] mb-2">Password *</label>
                        <div class="password-wrapper">
                            <input type="password" name="password" id="password" required class="input-field" minlength="8">
                            <button type="button" class="toggle-password" data-target="password">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-[#1a4d2e] mb-2">Role *</label>
                        <select name="role" required class="input-field">
                            <option value="siswa" {{ old('role') == 'siswa' ? 'selected' : '' }}>Siswa</option>
                            <option value="guru" {{ old('role') == 'guru' ? 'selected' : '' }}>Guru</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-[#1a4d2e] mb-2">NIS</label>
                        <input type="text" name="nis" value="{{ old('nis') }}" class="input-field">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-[#1a4d2e] mb-2">NIP</label>
                        <input type="text" name="nip" value="{{ old('nip') }}" class="input-field">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-[#1a4d2e] mb-2">Kelas</label>
                        <input type="text" name="kelas" value="{{ old('kelas') }}" class="input-field">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-[#1a4d2e] mb-2">No. Telp</label>
                        <input type="text" name="no_telp" value="{{ old('no_telp') }}" class="input-field">
                    </div>
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-[#1a4d2e] mb-2">Foto</label>
                    <input type="file" name="foto" accept="image/*" class="input-field">
                </div>
                <button type="submit" class="btn-primary">Simpan Anggota</button>
            </form>
        </div>
    </div>
</x-layouts.admin>
