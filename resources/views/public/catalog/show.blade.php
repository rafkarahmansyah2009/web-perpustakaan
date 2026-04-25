<x-layouts.app :title="$book->judul . ' — Perpustakaan SMKN 5'">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        {{-- Breadcrumb --}}
        <nav class="mb-8">
            <ol class="flex items-center gap-2 text-sm text-[#717971]">
                <li><a href="{{ route('catalog.index') }}" class="hover:text-[#1a4d2e] transition-colors">Katalog</a></li>
                <li>/</li>
                <li class="text-[#1b1c19] font-medium">{{ Str::limit($book->judul, 50) }}</li>
            </ol>
        </nav>

        <div class="flex flex-col lg:flex-row gap-12">
            {{-- Left — Cover --}}
            <div class="lg:w-1/3">
                <div class="aspect-[3/4] bg-[#f0eee9] rounded-card overflow-hidden sticky top-24">
                    @if($book->cover)
                        <img src="{{ Storage::url($book->cover) }}" alt="{{ $book->judul }}" class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full flex flex-col items-center justify-center p-8 text-center" style="background: linear-gradient(135deg, #1a4d2e, #366847);">
                            <svg class="w-20 h-20 text-white/20 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                            <span class="font-headline text-lg text-white/50 italic">{{ $book->judul }}</span>
                        </div>
                    @endif
                </div>
            </div>

            {{-- Right — Info --}}
            <div class="lg:w-2/3">
                <div class="flex items-center gap-3 mb-4">
                    @if($book->kategori)
                        <span class="badge-available">{{ $book->kategori->nama }}</span>
                    @endif
                    <x-badge-status :available="$book->isAvailable()" />
                </div>

                <h1 class="font-headline text-4xl font-bold text-[#1b1c19] leading-tight mb-3">{{ $book->judul }}</h1>
                <p class="text-lg text-[#414942] mb-8">oleh <span class="font-semibold text-[#1b1c19]">{{ $book->pengarang }}</span></p>

                {{-- Details --}}
                <div class="bg-white rounded-card p-6 mb-8" style="box-shadow: 0 2px 12px rgba(26,77,46,0.04);">
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-6">
                        <div>
                            <p class="text-xs font-bold uppercase tracking-wider text-[#1a4d2e] mb-1">ISBN</p>
                            <p class="text-sm text-[#1b1c19]">{{ $book->isbn ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-xs font-bold uppercase tracking-wider text-[#1a4d2e] mb-1">Penerbit</p>
                            <p class="text-sm text-[#1b1c19]">{{ $book->penerbit ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-xs font-bold uppercase tracking-wider text-[#1a4d2e] mb-1">Tahun</p>
                            <p class="text-sm text-[#1b1c19]">{{ $book->tahun_terbit ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-xs font-bold uppercase tracking-wider text-[#1a4d2e] mb-1">Stok</p>
                            <p class="text-sm text-[#1b1c19]">{{ $book->availableStock() }} / {{ $book->stok }}</p>
                        </div>
                        <div>
                            <p class="text-xs font-bold uppercase tracking-wider text-[#1a4d2e] mb-1">Lokasi Rak</p>
                            <p class="text-sm text-[#1b1c19]">{{ $book->lokasi_rak ?? '-' }}</p>
                        </div>
                    </div>
                </div>

                {{-- Description --}}
                @if($book->deskripsi)
                <div class="mb-8">
                    <h3 class="font-headline text-lg font-bold text-[#1b1c19] mb-3">Deskripsi</h3>
                    <p class="text-[#414942] leading-relaxed">{{ $book->deskripsi }}</p>
                </div>
                @endif

                {{-- Action Button --}}
                @auth
                    @if(auth()->user()->isMember() && $book->isAvailable())
                        <a href="{{ route('member.loans.create', ['book_id' => $book->id]) }}" class="btn-cta !py-3.5 !px-10 text-base">
                            Ajukan Pinjam
                        </a>
                    @endif
                @else
                    <a href="{{ route('login') }}" class="btn-primary !py-3.5 !px-10 text-base">
                        Masuk untuk Meminjam
                    </a>
                @endauth
            </div>
        </div>

        {{-- Related Books --}}
        @if($relatedBooks->count() > 0)
        <section class="mt-20">
            <h2 class="font-headline text-2xl font-bold text-[#1b1c19] mb-8">Buku Terkait</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($relatedBooks as $related)
                    <x-book-card :book="$related" />
                @endforeach
            </div>
        </section>
        @endif
    </div>
</x-layouts.app>
