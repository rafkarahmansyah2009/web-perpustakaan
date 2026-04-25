<x-layouts.member :title="'Ajukan Pinjam — Perpustakaan SMKN 5'">
    <div class="max-w-xl mx-auto">
        <a href="{{ route('catalog.index') }}" class="text-sm text-[#1a4d2e] hover:underline mb-6 inline-block">← Kembali ke Katalog</a>

        <h1 class="font-headline text-3xl font-bold text-[#1b1c19] mb-8">Ajukan Peminjaman</h1>

        <div class="bg-white rounded-card p-8" style="box-shadow: 0 2px 12px rgba(26,77,46,0.04);">
            @if($book)
            <div class="flex items-center gap-4 mb-6 pb-6 border-b border-[#f0eee9]">
                <div class="w-16 h-20 bg-[#f0eee9] rounded flex items-center justify-center shrink-0">
                    @if($book->cover)
                        <img src="{{ Storage::url($book->cover) }}" class="w-full h-full object-cover rounded">
                    @else
                        <svg class="w-8 h-8 text-[#c1c9bf]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                    @endif
                </div>
                <div>
                    <h3 class="font-headline text-lg font-bold text-[#1b1c19]">{{ $book->judul }}</h3>
                    <p class="text-sm text-[#414942]">{{ $book->pengarang }}</p>
                    <x-badge-status :available="$book->isAvailable()" />
                </div>
            </div>
            @endif

            <form method="POST" action="{{ route('member.loans.store') }}" class="space-y-5">
                @csrf
                <input type="hidden" name="book_id" value="{{ $book?->id }}">

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-[#1a4d2e] mb-2">Durasi Peminjaman</label>
                    <p class="text-sm text-[#414942]">7 hari (dapat diperpanjang 1x untuk 7 hari tambahan)</p>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-[#1a4d2e] mb-2">Keterangan (Opsional)</label>
                    <textarea name="keterangan" rows="3" class="input-field" placeholder="Tambahkan keterangan jika perlu...">{{ old('keterangan') }}</textarea>
                </div>

                <button type="submit" class="btn-cta w-full !py-3.5 text-base">Ajukan Peminjaman</button>
            </form>
        </div>
    </div>
</x-layouts.member>
