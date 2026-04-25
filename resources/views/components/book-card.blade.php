@props(['book'])

<a href="{{ route('catalog.show', $book) }}" class="card-elevate block group overflow-hidden">
    {{-- Cover --}}
    <div class="aspect-[3/4] bg-[#f0eee9] overflow-hidden rounded-t-card">
        @if($book->cover)
            <img src="{{ Storage::url($book->cover) }}" alt="{{ $book->judul }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
        @else
            <div class="w-full h-full flex flex-col items-center justify-center p-6 text-center" style="background: linear-gradient(135deg, #1a4d2e, #366847);">
                <svg class="w-12 h-12 text-white/30 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                </svg>
                <span class="font-headline text-sm text-white/60 italic">{{ Str::limit($book->judul, 40) }}</span>
            </div>
        @endif
    </div>

    {{-- Content --}}
    <div class="p-5">
        <div class="flex items-center gap-2 mb-3">
            @if($book->kategori)
                <span class="badge-available !text-[10px]">{{ $book->kategori->nama }}</span>
            @endif
            <x-badge-status :available="$book->isAvailable()" />
        </div>
        <h3 class="font-headline text-base font-bold text-[#1b1c19] group-hover:text-[#1a4d2e] transition-colors leading-snug mb-1.5 line-clamp-2">
            {{ $book->judul }}
        </h3>
        <p class="text-sm text-[#414942]">{{ $book->pengarang }}</p>
    </div>
</a>
