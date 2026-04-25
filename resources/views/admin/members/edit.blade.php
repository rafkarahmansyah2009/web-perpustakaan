<x-layouts.admin :header="'Edit Anggota'">
    <div class="max-w-2xl">
        <a href="{{ route('admin.members.index') }}" class="text-sm text-[#1a4d2e] hover:underline mb-6 inline-block">← Kembali</a>
        <div class="bg-white rounded-card p-8" style="box-shadow: 0 2px 12px rgba(26,77,46,0.04);">
            <form method="POST" action="{{ route('admin.members.update', $member) }}" enctype="multipart/form-data" class="space-y-5">
                @csrf @method('PUT')
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-[#1a4d2e] mb-2">Nama *</label>
                        <input type="text" name="name" value="{{ old('name', $member->name) }}" required class="input-field">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-[#1a4d2e] mb-2">Email *</label>
                        <input type="email" name="email" value="{{ old('email', $member->email) }}" required class="input-field">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-[#1a4d2e] mb-2">Password <span class="normal-case font-normal">(kosongkan jika tidak diubah)</span></label>
                        <input type="password" name="password" class="input-field" minlength="8">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-[#1a4d2e] mb-2">Role *</label>
                        <select name="role" required class="input-field">
                            <option value="siswa" {{ old('role', $member->role) == 'siswa' ? 'selected' : '' }}>Siswa</option>
                            <option value="guru" {{ old('role', $member->role) == 'guru' ? 'selected' : '' }}>Guru</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-[#1a4d2e] mb-2">NIS</label>
                        <input type="text" name="nis" value="{{ old('nis', $member->nis) }}" class="input-field">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-[#1a4d2e] mb-2">NIP</label>
                        <input type="text" name="nip" value="{{ old('nip', $member->nip) }}" class="input-field">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-[#1a4d2e] mb-2">Kelas</label>
                        <input type="text" name="kelas" value="{{ old('kelas', $member->kelas) }}" class="input-field">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-[#1a4d2e] mb-2">No. Telp</label>
                        <input type="text" name="no_telp" value="{{ old('no_telp', $member->no_telp) }}" class="input-field">
                    </div>
                </div>
                <div class="flex items-center gap-2">
                    <input type="hidden" name="status_aktif" value="0">
                    <input type="checkbox" name="status_aktif" value="1" {{ old('status_aktif', $member->status_aktif) ? 'checked' : '' }} class="rounded border-[#c1c9bf] text-[#1a4d2e] focus:ring-[#1a4d2e]">
                    <label class="text-sm text-[#414942]">Status Aktif</label>
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-[#1a4d2e] mb-2">Foto</label>
                    @if($member->foto)
                        <img src="{{ Storage::url($member->foto) }}" class="w-16 h-16 rounded-full object-cover mb-2">
                    @endif
                    <input type="file" name="foto" accept="image/*" class="input-field">
                </div>
                <button type="submit" class="btn-primary">Perbarui Anggota</button>
            </form>
        </div>
    </div>
</x-layouts.admin>
