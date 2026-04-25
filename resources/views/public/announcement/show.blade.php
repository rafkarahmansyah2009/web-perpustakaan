<x-layouts.app :title="$announcement->judul . ' — Perpustakaan SMKN 5'">
    <article class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <nav class="mb-8">
            <a href="{{ route('announcement.index') }}" class="text-sm text-[#1a4d2e] hover:underline">← Kembali ke Pengumuman</a>
        </nav>
        <p class="text-xs text-[#d4a017] font-bold uppercase tracking-wider mb-3">{{ $announcement->tgl_publish->translatedFormat('d F Y') }}</p>
        <h1 class="font-headline text-4xl font-bold text-[#1b1c19] leading-tight mb-8">{{ $announcement->judul }}</h1>
        <div class="prose prose-lg max-w-none text-[#414942] leading-relaxed">
            {!! $announcement->konten !!}
        </div>
    </article>
</x-layouts.app>
