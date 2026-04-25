<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk — Perpustakaan SMKN 5 Tangerang</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
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
                        Perpustakaan<br>Digital
                    </h1>
                    <div class="w-16 h-1 rounded-full" style="background: linear-gradient(90deg, #d4a017, rgba(212,160,23,0.3));"></div>
                </div>

                {{-- Quote --}}
                <blockquote class="max-w-md">
                    <p class="font-headline text-xl text-white/80 italic leading-relaxed mb-4">
                        "Perpustakaan bukan sekadar tempat menyimpan buku, melainkan gerbang menuju ilmu pengetahuan."
                    </p>
                    <footer class="text-sm text-white/40 font-body">— Perpustakaan SMKN 5 Tangerang</footer>
                </blockquote>

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

        {{-- Right Panel — Login Form --}}
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
                    <h2 class="font-headline text-3xl font-bold text-[#1b1c19] mb-2">Selamat Datang</h2>
                    <p class="text-sm text-[#414942] mb-8">Masuk ke akun perpustakaan Anda untuk melanjutkan.</p>
                </div>

                {{-- Error Messages --}}
                @if($errors->any())
                <div class="mb-6 p-4 rounded-card" style="background: rgba(200, 64, 26, 0.08);">
                    <p class="text-sm text-[#c8401a] font-medium">{{ $errors->first() }}</p>
                </div>
                @endif

                <form method="POST" action="{{ route('login') }}" class="space-y-5">
                    @csrf

                    {{-- Email --}}
                    <div>
                        <label for="email" class="block text-xs font-bold uppercase tracking-wider text-[#1a4d2e] mb-2">Email</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus
                            class="input-field"
                            placeholder="contoh@smkn5tng.sch.id">
                    </div>

                    {{-- Password --}}
                    <div>
                        <label for="password" class="block text-xs font-bold uppercase tracking-wider text-[#1a4d2e] mb-2">Password</label>
                        <input type="password" id="password" name="password" required
                            class="input-field"
                            placeholder="Masukkan password">
                    </div>

                    {{-- Remember --}}
                    <div class="flex items-center justify-between">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" name="remember" class="rounded border-[#c1c9bf] text-[#1a4d2e] focus:ring-[#1a4d2e]">
                            <span class="text-sm text-[#414942]">Ingat saya</span>
                        </label>
                    </div>

                    {{-- Submit --}}
                    <button type="submit" class="btn-primary w-full !py-3.5 text-base">
                        Masuk
                    </button>
                </form>

                <p class="mt-8 text-center text-xs text-[#717971]">
                    Belum punya akun? Hubungi administrator perpustakaan.
                </p>
            </div>
        </div>
    </div>
</body>
</html>
