<x-layouts.app :title="'Beranda — Perpustakaan SMKN 5 Tangerang'">

    {{-- Hero Section --}}
    <section class="relative overflow-hidden" style="background: linear-gradient(160deg, #00361a 0%, #1a4d2e 60%, #366847 100%);">
        <div class="absolute -top-40 -right-40 w-[500px] h-[500px] rounded-full" style="background: rgba(212,160,23,0.06);"></div>
        <div class="absolute bottom-0 left-0 w-[400px] h-[400px] rounded-full" style="background: rgba(255,255,255,0.03);"></div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 md:py-32">
            <div class="max-w-2xl">
                <p class="text-[#d4a017] text-xs tracking-[0.3em] uppercase font-body font-bold mb-4">SMKN 5 Tangerang</p>
                <h1 class="font-headline text-4xl md:text-6xl font-bold text-white leading-tight tracking-tight mb-6">
                    Jelajahi Dunia<br>Melalui <span class="italic" style="color: #d4a017;">Buku</span>
                </h1>
                <p class="text-lg text-white/70 font-body leading-relaxed mb-10 max-w-lg">
                    Akses ribuan koleksi buku, ajukan peminjaman online, dan kelola aktivitas perpustakaan dengan mudah.
                </p>
                <div class="flex flex-wrap gap-4">
                    <a href="{{ route('catalog.index') }}" class="btn-cta !py-3.5 !px-8 text-base">
                        Jelajahi Katalog
                    </a>
                    <a href="{{ route('login') }}" class="inline-flex items-center gap-2 px-8 py-3.5 rounded-btn text-white border border-white/20 hover:bg-white/10 transition-all text-base font-medium">
                        Masuk
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- Statistics --}}
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-12 relative z-10">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="stat-card flex items-center gap-4">
                <div class="w-14 h-14 rounded-card flex items-center justify-center" style="background: rgba(26, 77, 46, 0.08);">
                    <svg class="w-7 h-7 text-[#1a4d2e]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                </div>
                <div>
                    <p class="font-headline text-3xl font-bold text-[#1b1c19]">{{ number_format($totalBooks) }}</p>
                    <p class="text-xs text-[#717971] font-bold uppercase tracking-wider">Total Buku</p>
                </div>
            </div>
            <div class="stat-card flex items-center gap-4">
                <div class="w-14 h-14 rounded-card flex items-center justify-center" style="background: rgba(212, 160, 23, 0.1);">
                    <svg class="w-7 h-7 text-[#d4a017]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197"/></svg>
                </div>
                <div>
                    <p class="font-headline text-3xl font-bold text-[#1b1c19]">{{ number_format($totalMembers) }}</p>
                    <p class="text-xs text-[#717971] font-bold uppercase tracking-wider">Anggota Aktif</p>
                </div>
            </div>
            <div class="stat-card flex items-center gap-4">
                <div class="w-14 h-14 rounded-card flex items-center justify-center" style="background: rgba(200, 64, 26, 0.08);">
                    <svg class="w-7 h-7 text-[#c8401a]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <div>
                    <p class="font-headline text-3xl font-bold text-[#1b1c19]">{{ number_format($availableBooks) }}</p>
                    <p class="text-xs text-[#717971] font-bold uppercase tracking-wider">Buku Tersedia</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Latest Books --}}
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-20">
        <div class="flex items-end justify-between mb-10">
            <div>
                <p class="text-xs text-[#d4a017] font-bold uppercase tracking-[0.2em] mb-2">Koleksi Terbaru</p>
                <h2 class="font-headline text-3xl font-bold text-[#1b1c19]">Buku Terbaru</h2>
            </div>
            <a href="{{ route('catalog.index') }}" class="text-sm text-[#1a4d2e] font-medium hover:underline hidden md:block">
                Lihat Semua →
            </a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($latestBooks as $book)
                <x-book-card :book="$book" />
            @endforeach
        </div>
    </section>

    {{-- Announcements --}}
    @if($announcements->count() > 0)
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-20">
        <div class="flex items-end justify-between mb-10">
            <div>
                <p class="text-xs text-[#d4a017] font-bold uppercase tracking-[0.2em] mb-2">Informasi</p>
                <h2 class="font-headline text-3xl font-bold text-[#1b1c19]">Pengumuman Terbaru</h2>
            </div>
            <a href="{{ route('announcement.index') }}" class="text-sm text-[#1a4d2e] font-medium hover:underline hidden md:block">
                Lihat Semua →
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($announcements as $announcement)
            <a href="{{ route('announcement.show', $announcement) }}" class="card-elevate p-6 block group">
                <p class="text-xs text-[#717971] font-bold uppercase tracking-wider mb-3">
                    {{ $announcement->tgl_publish->translatedFormat('d M Y') }}
                </p>
                <h3 class="font-headline text-lg font-bold text-[#1b1c19] group-hover:text-[#1a4d2e] transition-colors mb-3 leading-snug">
                    {{ $announcement->judul }}
                </h3>
                <p class="text-sm text-[#414942] line-clamp-2">{{ Str::limit(strip_tags($announcement->konten), 120) }}</p>
            </a>
            @endforeach
        </div>
    </section>
    @endif

</x-layouts.app>
