<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun — Perpustakaan SMKN 5 Tangerang</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .role-option {
            cursor: pointer;
            transition: all 0.3s ease;
        }
        .role-option:hover {
            border-color: rgba(26, 77, 46, 0.4) !important;
            background: rgba(26, 77, 46, 0.03);
        }
        .role-option.selected {
            border-color: #1a4d2e !important;
            background: rgba(26, 77, 46, 0.06);
        }
        .role-option.selected .role-radio {
            border-color: #1a4d2e;
            background: #1a4d2e;
        }
        .role-option.selected .role-radio::after {
            content: '';
            display: block;
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: white;
        }
        .role-radio {
            width: 20px;
            height: 20px;
            border-radius: 50%;
            border: 2px solid #c1c9bf;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s ease;
            flex-shrink: 0;
        }
        .conditional-fields {
            max-height: 0;
            overflow: hidden;
            opacity: 0;
            transition: max-height 0.4s ease, opacity 0.3s ease, margin 0.3s ease;
        }
        .conditional-fields.show {
            max-height: 300px;
            opacity: 1;
        }
    </style>
</head>
<body class="min-h-screen bg-[#fbf9f4]">
    <div class="min-h-screen flex">
        {{-- Left Panel — Dark green branding --}}
        <div class="hidden lg:flex lg:w-1/2 relative overflow-hidden" style="background: linear-gradient(160deg, #00361a 0%, #1a4d2e 60%, #366847 100%);">
            {{-- Decorative circles --}}
            <div class="absolute -top-20 -left-20 w-80 h-80 rounded-full" style="background: rgba(255,255,255,0.03);"></div>
            <div class="absolute bottom-20 -right-10 w-60 h-60 rounded-full" style="background: rgba(255,255,255,0.04);"></div>
            <div class="absolute top-1/3 right-1/4 w-40 h-40 rounded-full" style="background: rgba(212,160,23,0.08);"></div>

            <div class="relative z-10 flex flex-col justify-center px-16 py-12">
                {{-- Logo --}}
                <div class="mb-12">
                    <div class="w-16 h-16 rounded-card bg-white/10 backdrop-blur-sm flex items-center justify-center mb-6">
                        <svg class="w-9 h-9 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                    </div>
                    <p class="text-white/50 text-xs tracking-[0.3em] uppercase font-body mb-3">SMKN 5 Tangerang</p>
                    <h1 class="font-headline text-5xl font-bold text-white leading-tight tracking-tight mb-4">
                        Bergabung<br>Sekarang
                    </h1>
                    <div class="w-16 h-1 rounded-full" style="background: linear-gradient(90deg, #d4a017, rgba(212,160,23,0.3));"></div>
                </div>

                {{-- Info --}}
                <div class="max-w-md">
                    <p class="font-headline text-xl text-white/80 leading-relaxed mb-6">
                        Daftarkan diri Anda untuk mengakses ribuan koleksi buku perpustakaan digital SMKN 5 Tangerang.
                    </p>
                    <div class="flex items-center gap-4 text-white/50 text-sm">
                        <div class="flex items-center gap-2">
                            <svg class="w-5 h-5 text-[#d4a017]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span>Gratis</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <svg class="w-5 h-5 text-[#d4a017]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span>Mudah & Cepat</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <svg class="w-5 h-5 text-[#d4a017]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span>Aman</span>
                        </div>
                    </div>
                </div>

                {{-- Stats --}}
                <div class="mt-16 flex gap-12">
                    <div>
                        <p class="font-headline text-3xl font-bold text-white">1000+</p>
                        <p class="text-xs text-white/40 tracking-wider uppercase mt-1">Koleksi Buku</p>
                    </div>
                    <div>
                        <p class="font-headline text-3xl font-bold text-white">500+</p>
                        <p class="text-xs text-white/40 tracking-wider uppercase mt-1">Anggota Aktif</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Right Panel — Register Form --}}
        <div class="w-full lg:w-1/2 flex items-center justify-center px-6 py-12">
            <div class="w-full max-w-md">
                {{-- Mobile logo --}}
                <div class="lg:hidden mb-8 text-center">
                    <div class="w-14 h-14 rounded-card mx-auto flex items-center justify-center mb-4" style="background: linear-gradient(135deg, #1a4d2e, #366847);">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                    </div>
                    <h2 class="font-headline text-2xl font-bold text-[#1a4d2e]">Perpustakaan SMKN 5</h2>
                </div>

                <div>
                    <h2 class="font-headline text-3xl font-bold text-[#1b1c19] mb-2">Buat Akun Baru</h2>
                    <p class="text-sm text-[#414942] mb-8">Isi data di bawah untuk mendaftar sebagai anggota perpustakaan.</p>
                </div>

                {{-- Error Messages --}}
                @if($errors->any())
                <div class="mb-6 p-4 rounded-card" style="background: rgba(200, 64, 26, 0.08);">
                    <ul class="text-sm text-[#c8401a] font-medium space-y-1">
                        @foreach($errors->all() as $error)
                            <li class="flex items-start gap-2">
                                <svg class="w-4 h-4 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                {{ $error }}
                            </li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <form method="POST" action="{{ route('register') }}" class="space-y-5" id="registerForm">
                    @csrf

                    {{-- Role Selection --}}
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-[#1a4d2e] mb-3">Daftar Sebagai</label>
                        <div class="grid grid-cols-2 gap-3">
                            <div class="role-option rounded-btn p-4 border-2 border-[#e0ddd7] {{ old('role', 'siswa') === 'siswa' ? 'selected' : '' }}" data-role="siswa" id="role-siswa">
                                <div class="flex items-center gap-3">
                                    <div class="role-radio"></div>
                                    <div>
                                        <p class="font-semibold text-sm text-[#1b1c19]">Siswa</p>
                                        <p class="text-xs text-[#717971]">Pelajar SMKN 5</p>
                                    </div>
                                </div>
                            </div>
                            <div class="role-option rounded-btn p-4 border-2 border-[#e0ddd7] {{ old('role') === 'guru' ? 'selected' : '' }}" data-role="guru" id="role-guru">
                                <div class="flex items-center gap-3">
                                    <div class="role-radio"></div>
                                    <div>
                                        <p class="font-semibold text-sm text-[#1b1c19]">Guru</p>
                                        <p class="text-xs text-[#717971]">Pengajar SMKN 5</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="role" id="roleInput" value="{{ old('role', 'siswa') }}">
                    </div>

                    {{-- Nama Lengkap --}}
                    <div>
                        <label for="name" class="block text-xs font-bold uppercase tracking-wider text-[#1a4d2e] mb-2">Nama Lengkap</label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}" required autofocus
                            class="input-field"
                            placeholder="Masukkan nama lengkap">
                    </div>

                    {{-- Email --}}
                    <div>
                        <label for="email" class="block text-xs font-bold uppercase tracking-wider text-[#1a4d2e] mb-2">Email</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" required
                            class="input-field"
                            placeholder="contoh@smkn5tng.sch.id">
                    </div>

                    {{-- Siswa Fields --}}
                    <div id="siswaFields" class="conditional-fields {{ old('role', 'siswa') === 'siswa' ? 'show' : '' }}">
                        <div class="space-y-5">
                            <div>
                                <label for="nis" class="block text-xs font-bold uppercase tracking-wider text-[#1a4d2e] mb-2">NIS</label>
                                <input type="text" id="nis" name="nis" value="{{ old('nis') }}"
                                    class="input-field"
                                    placeholder="Nomor Induk Siswa">
                            </div>
                            <div>
                                <label for="kelas" class="block text-xs font-bold uppercase tracking-wider text-[#1a4d2e] mb-2">Kelas</label>
                                <select id="kelas" name="kelas" class="input-field">
                                    <option value="">Pilih Kelas</option>
                                    @php
                                        $kelasList = [
                                            'X RPL 1', 'X RPL 2',
                                            'X TKJ 1', 'X TKJ 2',
                                            'X MM 1', 'X MM 2',
                                            'XI RPL 1', 'XI RPL 2',
                                            'XI TKJ 1', 'XI TKJ 2',
                                            'XI MM 1', 'XI MM 2',
                                            'XII RPL 1', 'XII RPL 2',
                                            'XII TKJ 1', 'XII TKJ 2',
                                            'XII MM 1', 'XII MM 2',
                                        ];
                                    @endphp
                                    @foreach($kelasList as $kls)
                                        <option value="{{ $kls }}" {{ old('kelas') == $kls ? 'selected' : '' }}>{{ $kls }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    {{-- Guru Fields --}}
                    <div id="guruFields" class="conditional-fields {{ old('role') === 'guru' ? 'show' : '' }}">
                        <div class="space-y-5">
                            <div>
                                <label for="nip" class="block text-xs font-bold uppercase tracking-wider text-[#1a4d2e] mb-2">NIP</label>
                                <input type="text" id="nip" name="nip" value="{{ old('nip') }}"
                                    class="input-field"
                                    placeholder="Nomor Induk Pegawai">
                            </div>
                        </div>
                    </div>

                    {{-- No Telepon --}}
                    <div>
                        <label for="no_telp" class="block text-xs font-bold uppercase tracking-wider text-[#1a4d2e] mb-2">No. Telepon <span class="text-[#717971] font-normal normal-case">(opsional)</span></label>
                        <input type="text" id="no_telp" name="no_telp" value="{{ old('no_telp') }}"
                            class="input-field"
                            placeholder="08xxxxxxxxxx">
                    </div>

                    {{-- Password --}}
                    <div>
                        <label for="password" class="block text-xs font-bold uppercase tracking-wider text-[#1a4d2e] mb-2">Password</label>
                        <div class="password-wrapper">
                            <input type="password" id="password" name="password" required
                                class="input-field"
                                placeholder="Minimal 8 karakter">
                            <button type="button" class="toggle-password" data-target="password">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    {{-- Confirm Password --}}
                    <div>
                        <label for="password_confirmation" class="block text-xs font-bold uppercase tracking-wider text-[#1a4d2e] mb-2">Konfirmasi Password</label>
                        <div class="password-wrapper">
                            <input type="password" id="password_confirmation" name="password_confirmation" required
                                class="input-field"
                                placeholder="Ulangi password">
                            <button type="button" class="toggle-password" data-target="password_confirmation">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    {{-- Submit --}}
                    <button type="submit" class="btn-primary w-full !py-3.5 text-base" id="registerBtn">
                        Daftar Sekarang
                    </button>
                </form>

                <p class="mt-8 text-center text-sm text-[#717971]">
                    Sudah punya akun?
                    <a href="{{ route('login') }}" class="font-semibold text-[#1a4d2e] hover:text-[#155a28] underline underline-offset-2 transition-colors">
                        Masuk di sini
                    </a>
                </p>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Role selection
            const roleOptions = document.querySelectorAll('.role-option');
            const roleInput = document.getElementById('roleInput');
            const siswaFields = document.getElementById('siswaFields');
            const guruFields = document.getElementById('guruFields');

            roleOptions.forEach(option => {
                option.addEventListener('click', function() {
                    const role = this.getAttribute('data-role');
                    roleInput.value = role;

                    // Update selection visual
                    roleOptions.forEach(opt => opt.classList.remove('selected'));
                    this.classList.add('selected');

                    // Toggle conditional fields
                    if (role === 'siswa') {
                        siswaFields.classList.add('show');
                        guruFields.classList.remove('show');
                    } else {
                        siswaFields.classList.remove('show');
                        guruFields.classList.add('show');
                    }
                });
            });

            // Toggle password visibility
            const togglePasswordButtons = document.querySelectorAll('.toggle-password');
            togglePasswordButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const targetId = this.getAttribute('data-target');
                    const passwordInput = document.getElementById(targetId);
                    const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                    passwordInput.setAttribute('type', type);

                    const eyeIcon = this.querySelector('svg');
                    if (type === 'text') {
                        eyeIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l18 18" />';
                    } else {
                        eyeIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />';
                    }
                });
            });
        });
    </script>
</body>
</html>
