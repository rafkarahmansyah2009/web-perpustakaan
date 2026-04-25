<x-layouts.app :title="'Pengumuman — Perpustakaan SMKN 5'">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <p class="text-xs text-[#d4a017] font-bold uppercase tracking-[0.2em] mb-2">Informasi</p>
        <h1 class="font-headline text-4xl font-bold text-[#1b1c19] mb-10">Pengumuman</h1>

        <div class="space-y-6">
            @forelse($announcements as $item)
            <a href="{{ route('announcement.show', $item) }}" class="card-elevate p-6 block group">
                <div class="flex items-start justify-between gap-4">
                    <div>
                        <p class="text-xs text-[#717971] font-bold uppercase tracking-wider mb-2">
                            {{ $item->tgl_publish->translatedFormat('d F Y') }}
                        </p>
                        <h3 class="font-headline text-xl font-bold text-[#1b1c19] group-hover:text-[#1a4d2e] transition-colors mb-2">
                            {{ $item->judul }}
                        </h3>
                        <p class="text-sm text-[#414942] line-clamp-2">{{ Str::limit(strip_tags($item->konten), 200) }}</p>
                    </div>
                    <svg class="w-5 h-5 text-[#c1c9bf] group-hover:text-[#1a4d2e] transition-colors shrink-0 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </div>
            </a>
            @empty
            <p class="text-center text-[#414942] py-12 font-headline text-lg">Belum ada pengumuman.</p>
            @endforelse
        </div>

        <div class="mt-10">{{ $announcements->links() }}</div>
    </div>
</x-layouts.app>
