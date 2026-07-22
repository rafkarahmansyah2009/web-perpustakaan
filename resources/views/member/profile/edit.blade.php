<x-layouts.member :title="'Edit Profil — Perpustakaan SMKN 5'">
    <div class="max-w-3xl mx-auto">
        <h1 class="font-headline text-3xl font-bold text-[#1b1c19] mb-8">Edit Profil</h1>

        <form method="POST" action="{{ route('member.profile.update') }}" enctype="multipart/form-data" class="space-y-6">
            @csrf @method('PUT')

            <div class="bg-white rounded-card p-8" style="box-shadow: 0 2px 12px rgba(26,77,46,0.04);">
                <h2 class="text-xl font-headline font-bold text-[#1a4d2e] mb-6 border-b border-[#eae8e3] pb-3">Informasi Dasar</h2>
                
                <div class="flex items-center gap-6 mb-8">
                    @if($user->foto)
                    <img src="{{ Storage::url($user->foto) }}" class="w-24 h-24 rounded-full object-cover shadow-sm">
                    @else
                    <div class="w-24 h-24 rounded-full bg-[#1a4d2e] flex items-center justify-center text-white text-3xl font-bold shadow-sm">
                        {{ strtoupper(substr($user->name, 0, 2)) }}
                    </div>
                    @endif
                    <div class="flex-1">
                        <label class="block text-sm font-semibold text-[#414942] mb-2">Foto Profil</label>
                        <input type="file" name="foto" accept="image/*" class="block w-full text-sm text-slate-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-[#eef2ef] file:text-[#1a4d2e] hover:file:bg-[#e2dfd5] transition-colors cursor-pointer">
                        <p class="text-xs text-[#717971] mt-2">Format yang didukung: JPG, PNG. Ukuran maksimal 2MB.</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-[#1a4d2e] mb-2">Nama Lengkap</label>
                        <input type="text" name="name" value="{{ old('name', $user->name) }}" required class="input-field">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-[#1a4d2e] mb-2">Email</label>
                        <input type="email" value="{{ $user->email }}" disabled class="input-field !bg-[#f0eee9] !text-[#717971] cursor-not-allowed" title="Email tidak dapat diubah">
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-xs font-bold uppercase tracking-wider text-[#1a4d2e] mb-2">No. Telepon</label>
                        <input type="text" name="no_telp" value="{{ old('no_telp', $user->no_telp) }}" class="input-field">
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-card p-8" style="box-shadow: 0 2px 12px rgba(26,77,46,0.04);">
                <div class="flex justify-between items-center mb-6 border-b border-[#eae8e3] pb-3">
                    <h2 class="text-xl font-headline font-bold text-[#1a4d2e]">Keamanan Akun</h2>
                    <span class="text-xs text-[#717971] uppercase tracking-wider font-bold bg-[#f0eee9] px-3 py-1 rounded-full">Opsional</span>
                </div>
                
                <p class="text-sm text-[#717971] mb-6">Kosongkan semua field di bawah ini jika Anda tidak ingin mengubah password Anda.</p>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="md:col-span-2">
                        <label class="block text-xs font-bold uppercase tracking-wider text-[#1a4d2e] mb-2">Password Lama</label>
                        <div class="password-wrapper">
                            <input type="password" name="current_password" id="current_password" class="input-field">
                            <button type="button" class="toggle-password" data-target="current_password">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-[#1a4d2e] mb-2">Password Baru</label>
                        <div class="password-wrapper">
                            <input type="password" name="password" id="password" class="input-field" minlength="8">
                            <button type="button" class="toggle-password" data-target="password">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-[#1a4d2e] mb-2">Konfirmasi Password</label>
                        <div class="password-wrapper">
                            <input type="password" name="password_confirmation" id="password_confirmation" class="input-field">
                            <button type="button" class="toggle-password" data-target="password_confirmation">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex justify-end gap-4 mt-8">
                <a href="{{ route('member.dashboard') }}" class="px-6 py-3 rounded-button font-bold text-[#414942] bg-[#f0eee9] hover:bg-[#e2dfd5] transition-colors">Batal</a>
                <button type="submit" class="btn-primary px-8 !py-3">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</x-layouts.member>