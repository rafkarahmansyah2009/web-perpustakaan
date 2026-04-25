<x-layouts.member :title="'Riwayat Pinjaman — Perpustakaan SMKN 5'">
    <div class="flex items-center justify-between mb-8">
        <div>
            <p class="text-xs text-[#d4a017] font-bold uppercase tracking-[0.2em] mb-2">Pinjaman Saya</p>
            <h1 class="font-headline text-3xl font-bold text-[#1b1c19]">Riwayat Peminjaman</h1>
        </div>
        <a href="{{ route('catalog.index') }}" class="btn-primary text-sm !py-2">Pinjam Buku Baru</a>
    </div>

    <div class="space-y-4">
        @forelse($loans as $loan)
        <div class="bg-white rounded-card p-6 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4" style="box-shadow: 0 2px 12px rgba(26,77,46,0.04);">
            <div class="flex items-center gap-4">
                <div class="w-12 h-16 bg-[#f0eee9] rounded flex items-center justify-center shrink-0">
                    <svg class="w-6 h-6 text-[#c1c9bf]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                </div>
                <div>
                    <p class="font-headline text-base font-bold text-[#1b1c19]">{{ $loan->book->judul }}</p>
                    <p class="text-xs text-[#414942]">{{ $loan->tgl_pinjam->format('d M Y') }} — {{ $loan->tgl_kembali_rencana->format('d M Y') }}</p>
                    @if($loan->fine)
                        <p class="text-xs text-[#c8401a] font-bold mt-1">Denda: Rp {{ number_format($loan->fine->nominal_denda, 0, ',', '.') }} ({{ ucfirst($loan->fine->status_bayar) }})</p>
                    @endif
                </div>
            </div>
            <div class="flex items-center gap-3">
                @if($loan->status === 'pending')
                    <span class="badge-pending">Pending</span>
                @elseif($loan->status === 'dipinjam')
                    <span class="badge-available">Dipinjam</span>
                    @if(!$loan->sudah_diperpanjang && !$loan->isOverdue())
                    <form method="POST" action="{{ route('member.loans.extend', $loan) }}">
                        @csrf
                        <button class="text-xs text-[#1a4d2e] font-bold hover:underline">Perpanjang</button>
                    </form>
                    @endif
                @elseif($loan->status === 'dikembalikan')
                    <span class="badge" style="background: rgba(26,77,46,0.1); color: #1a4d2e;">Dikembalikan</span>
                @else
                    <span class="badge-borrowed">Terlambat</span>
                @endif
            </div>
        </div>
        @empty
        <div class="text-center py-16 bg-white rounded-card" style="box-shadow: 0 2px 12px rgba(26,77,46,0.04);">
            <h3 class="font-headline text-xl text-[#414942] mb-2">Belum Ada Pinjaman</h3>
            <p class="text-sm text-[#717971] mb-4">Mulai jelajahi katalog dan ajukan peminjaman.</p>
            <a href="{{ route('catalog.index') }}" class="btn-primary text-sm">Jelajahi Katalog</a>
        </div>
        @endforelse
    </div>
    <div class="mt-8">{{ $loans->links() }}</div>
</x-layouts.member>
