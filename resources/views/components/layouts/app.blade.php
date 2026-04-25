<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Perpustakaan Digital SMKN 5 Tangerang — Jelajahi koleksi buku, ajukan peminjaman, dan akses layanan perpustakaan secara online.">
    <title>{{ $title ?? 'Perpustakaan SMKN 5 Tangerang' }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-[#fbf9f4] text-[#1b1c19]" x-data="{ mobileMenu: false }">

    {{-- Navigation --}}
    <nav class="glass-nav fixed top-0 left-0 right-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                {{-- Logo --}}
                <a href="{{ route('home') }}" class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-btn flex items-center justify-center" style="background: linear-gradient(135deg, #1a4d2e, #366847);">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                    </div>
                    <div>
                        <span class="font-headline text-lg font-bold text-[#1a4d2e] leading-none">Perpustakaan</span>
                        <span class="block text-[10px] font-body font-medium text-[#414942] tracking-widest uppercase">SMKN 5 Tangerang</span>
                    </div>
                </a>

                {{-- Desktop Nav --}}
                <div class="hidden md:flex items-center gap-8">
                    <a href="{{ route('home') }}" class="text-sm font-medium {{ request()->routeIs('home') ? 'text-[#1a4d2e]' : 'text-[#414942] hover:text-[#1a4d2e]' }} transition-colors">Beranda</a>
                    <a href="{{ route('catalog.index') }}" class="text-sm font-medium {{ request()->routeIs('catalog.*') ? 'text-[#1a4d2e]' : 'text-[#414942] hover:text-[#1a4d2e]' }} transition-colors">Katalog</a>
                    <a href="{{ route('announcement.index') }}" class="text-sm font-medium {{ request()->routeIs('announcement.*') ? 'text-[#1a4d2e]' : 'text-[#414942] hover:text-[#1a4d2e]' }} transition-colors">Pengumuman</a>
                </div>

                {{-- Right side --}}
                <div class="hidden md:flex items-center gap-4">
                    @auth
                        <a href="{{ auth()->user()->isAdmin() ? route('admin.dashboard') : route('member.dashboard') }}" class="btn-primary text-sm !py-2 !px-5">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="btn-primary text-sm !py-2 !px-5">
                            Masuk
                        </a>
                    @endauth
                </div>

                {{-- Mobile menu button --}}
                <button @click="mobileMenu = !mobileMenu" class="md:hidden text-[#1a4d2e]">
                    <svg x-show="!mobileMenu" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                    <svg x-show="mobileMenu" x-cloak class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
        </div>

        {{-- Mobile menu --}}
        <div x-show="mobileMenu" x-cloak x-transition class="md:hidden border-t border-[#eae8e3]">
            <div class="px-4 py-4 space-y-3 bg-[#fbf9f4]">
                <a href="{{ route('home') }}" class="block text-sm font-medium text-[#414942]">Beranda</a>
                <a href="{{ route('catalog.index') }}" class="block text-sm font-medium text-[#414942]">Katalog</a>
                <a href="{{ route('announcement.index') }}" class="block text-sm font-medium text-[#414942]">Pengumuman</a>
                <hr class="border-[#eae8e3]">
                @auth
                    <a href="{{ auth()->user()->isAdmin() ? route('admin.dashboard') : route('member.dashboard') }}" class="block btn-primary text-center text-sm !py-2">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="block btn-primary text-center text-sm !py-2">Masuk</a>
                @endauth
            </div>
        </div>

        {{-- Bottom ledge --}}
        <div class="h-[2px] bg-[#eae8e3]"></div>
    </nav>

    {{-- Toast Notifications --}}
    @if(session('success') || session('error') || session('warning'))
    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)" x-transition class="fixed top-20 right-6 z-[60]">
        @if(session('success'))
            <div class="toast-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="toast-error">{{ session('error') }}</div>
        @endif
        @if(session('warning'))
            <div class="toast-warning">{{ session('warning') }}</div>
        @endif
    </div>
    @endif

    {{-- Main Content --}}
    <main class="pt-16">
        {{ $slot }}
    </main>

    {{-- Footer --}}
    <footer class="bg-[#00361a] text-white mt-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div>
                    <h3 class="font-headline text-xl font-bold mb-4">Perpustakaan Digital</h3>
                    <p class="text-sm text-gray-300 leading-relaxed">SMKN 5 Tangerang — Menyediakan akses mudah ke koleksi buku dan layanan perpustakaan.</p>
                </div>
                <div>
                    <h4 class="font-headline text-base font-semibold mb-4">Tautan</h4>
                    <div class="space-y-2">
                        <a href="{{ route('catalog.index') }}" class="block text-sm text-gray-300 hover:text-white transition-colors">Katalog Buku</a>
                        <a href="{{ route('announcement.index') }}" class="block text-sm text-gray-300 hover:text-white transition-colors">Pengumuman</a>
                        <a href="{{ route('login') }}" class="block text-sm text-gray-300 hover:text-white transition-colors">Masuk</a>
                    </div>
                </div>
                <div>
                    <h4 class="font-headline text-base font-semibold mb-4">Kontak</h4>
                    <div class="space-y-2 text-sm text-gray-300">
                        <p>Jl. Poris Plawad, Cipondoh, Tangerang</p>
                        <p>Telp: (021) 5584-0781</p>
                        <p>Email: perpustakaan@smkn5tng.sch.id</p>
                    </div>
                </div>
            </div>
            <div class="mt-8 pt-8 border-t border-white/10 text-center text-xs text-gray-400">
                &copy; {{ date('Y') }} Perpustakaan SMKN 5 Tangerang. Hak cipta dilindungi.
            </div>
        </div>
    </footer>

</body>
</html>
