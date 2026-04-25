<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Perpustakaan SMKN 5 Tangerang' }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-[#fbf9f4] text-[#1b1c19]" x-data="{ mobileMenu: false }">

    {{-- Member Navigation --}}
    <nav class="glass-nav fixed top-0 left-0 right-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                {{-- Logo --}}
                <a href="{{ route('member.dashboard') }}" class="flex items-center gap-3">
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
                    <a href="{{ route('home') }}" class="text-sm font-medium text-[#414942] hover:text-[#1a4d2e] transition-colors">Beranda</a>
                    <a href="{{ route('catalog.index') }}" class="text-sm font-medium {{ request()->routeIs('catalog.*') ? 'text-[#1a4d2e]' : 'text-[#414942] hover:text-[#1a4d2e]' }} transition-colors">Katalog</a>
                    <a href="{{ route('member.loans.index') }}" class="text-sm font-medium {{ request()->routeIs('member.loans.*') ? 'text-[#1a4d2e]' : 'text-[#414942] hover:text-[#1a4d2e]' }} transition-colors">Pinjaman Saya</a>
                    <a href="{{ route('member.profile.edit') }}" class="text-sm font-medium {{ request()->routeIs('member.profile.*') ? 'text-[#1a4d2e]' : 'text-[#414942] hover:text-[#1a4d2e]' }} transition-colors">Profil</a>
                </div>

                {{-- User info --}}
                <div class="hidden md:flex items-center gap-3">
                    <div class="flex items-center gap-2">
                        @if(auth()->user()->foto)
                            <img src="{{ Storage::url(auth()->user()->foto) }}" class="w-8 h-8 rounded-full object-cover" alt="">
                        @else
                            <div class="w-8 h-8 rounded-full bg-[#1a4d2e] flex items-center justify-center text-white text-xs font-bold">
                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                            </div>
                        @endif
                        <span class="text-sm font-medium text-[#1b1c19]">{{ auth()->user()->name }}</span>
                    </div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-[#414942] hover:text-[#c8401a] transition-colors text-sm">Keluar</button>
                    </form>
                </div>

                {{-- Mobile --}}
                <button @click="mobileMenu = !mobileMenu" class="md:hidden text-[#1a4d2e]">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                </button>
            </div>
        </div>
        <div class="h-[2px] bg-[#eae8e3]"></div>
    </nav>

    {{-- Toast --}}
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

    <main class="pt-20 pb-12 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{ $slot }}
    </main>

</body>
</html>
