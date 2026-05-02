<x-layouts.member :title="'Edit Profil — Perpustakaan SMKN 5'">
    <div class="max-w-xl mx-auto">
        <h1 class="font-headline text-3xl font-bold text-[#1b1c19] mb-8">Edit Profil</h1>

        <div class="bg-white rounded-card p-8" style="box-shadow: 0 2px 12px rgba(26,77,46,0.04);">
            <form method="POST" action="{{ route('member.profile.update') }}" enctype="multipart/form-data" class="space-y-5">
                @csrf @method('PUT')

                <div class="flex items-center gap-4 mb-4">
                    @if($user->foto)
                        <img src="{{ Storage::url($user->foto) }}" class="w-20 h-20 rounded-full object-cover">
                    @else
                        <div class="w-20 h-20 rounded-full bg-[#1a4d2e] flex items-center justify-center text-white text-2xl font-bold">
                            {{ strtoupper(substr($user->name, 0, 2)) }}
                        </div>
                    @endif
                    <div>
                        <input type="file" name="foto" accept="image/*" class="text-sm">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-[#1a4d2e] mb-2">Nama</label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}" required class="input-field">
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-[#1a4d2e] mb-2">Email</label>
                    <input type="email" value="{{ $user->email }}" disabled class="input-field !bg-[#f0eee9] !text-[#717971]">
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-[#1a4d2e] mb-2">No. Telepon</label>
                    <input type="text" name="no_telp" value="{{ old('no_telp', $user->no_telp) }}" class="input-field">
                </div>

                <hr class="border-[#eae8e3]">
                <p class="text-xs text-[#717971] uppercase tracking-wider font-bold">Ubah Password (opsional)</p>
                <div>
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
                    <label class="block text-xs font-bold uppercase tracking-wider text-[#1a4d2e] mb-2">Konfirmasi Password Baru</label>
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

                <button type="submit" class="btn-primary w-full !py-3.5">Simpan Perubahan</button>
            </form>
        </div>
    </div>
</x-layouts.member>
