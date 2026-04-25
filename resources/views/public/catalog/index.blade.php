<x-layouts.app :title="'Katalog Buku — Perpustakaan SMKN 5'">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        {{-- Header --}}
        <div class="mb-10">
            <p class="text-xs text-[#d4a017] font-bold uppercase tracking-[0.2em] mb-2">Katalog</p>
            <h1 class="font-headline text-4xl font-bold text-[#1b1c19]">Jelajahi Koleksi Kami</h1>
        </div>

        {{-- Search --}}
        <form method="GET" action="{{ route('catalog.index') }}" class="mb-10">
            <div class="flex gap-3">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari judul, pengarang, atau ISBN..."
                    class="input-field flex-1 !py-4 text-base">
                <button type="submit" class="btn-primary !px-8">Cari</button>
            </div>
        </form>

        <div class="flex flex-col lg:flex-row gap-8">
            {{-- Sidebar Filters --}}
            <aside class="lg:w-64 shrink-0">
                <div class="bg-white rounded-card p-6 sticky top-24" style="box-shadow: 0 2px 12px rgba(26,77,46,0.04);">
                    <h3 class="text-xs font-bold uppercase tracking-wider text-[#1a4d2e] mb-4">Kategori</h3>
                    <div class="space-y-2">
                        <a href="{{ route('catalog.index', request()->except('kategori')) }}" class="block text-sm {{ !request('kategori') ? 'text-[#1a4d2e] font-semibold' : 'text-[#414942]' }} hover:text-[#1a4d2e] transition-colors">
                            Semua Kategori
                        </a>
                        @foreach($categories as $cat)
                        <a href="{{ route('catalog.index', array_merge(request()->except('page'), ['kategori' => $cat->id])) }}" class="block text-sm {{ request('kategori') == $cat->id ? 'text-[#1a4d2e] font-semibold' : 'text-[#414942]' }} hover:text-[#1a4d2e] transition-colors">
                            {{ $cat->nama }} <span class="text-xs text-[#717971]">({{ $cat->books_count }})</span>
                        </a>
                        @endforeach
                    </div>

                    <hr class="my-5 border-[#eae8e3]">

                    <h3 class="text-xs font-bold uppercase tracking-wider text-[#1a4d2e] mb-4">Ketersediaan</h3>
                    <div class="space-y-2">
                        <a href="{{ route('catalog.index', array_merge(request()->except(['status', 'page']), [])) }}" class="block text-sm {{ !request('status') ? 'text-[#1a4d2e] font-semibold' : 'text-[#414942]' }} hover:text-[#1a4d2e] transition-colors">Semua</a>
                        <a href="{{ route('catalog.index', array_merge(request()->except('page'), ['status' => 'tersedia'])) }}" class="block text-sm {{ request('status') == 'tersedia' ? 'text-[#1a4d2e] font-semibold' : 'text-[#414942]' }} hover:text-[#1a4d2e] transition-colors">Tersedia</a>
                    </div>
                </div>
            </aside>

            {{-- Books Grid --}}
            <div class="flex-1">
                @if($books->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-6">
                    @foreach($books as $book)
                        <x-book-card :book="$book" />
                    @endforeach
                </div>
                <div class="mt-10">{{ $books->links() }}</div>
                @else
                <div class="text-center py-20">
                    <svg class="w-16 h-16 mx-auto text-[#c1c9bf] mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                    <h3 class="font-headline text-xl text-[#414942]">Tidak ada buku ditemukan</h3>
                    <p class="text-sm text-[#717971] mt-2">Coba ubah kata kunci atau filter pencarian.</p>
                </div>
                @endif
            </div>
        </div>
    </div>
</x-layouts.app>
