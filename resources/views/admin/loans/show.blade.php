<x-layouts.admin :header="'Detail Peminjaman'">
    <a href="{{ route('admin.loans.index') }}" class="text-sm text-[#1a4d2e] hover:underline mb-6 inline-block">← Kembali</a>

    <div class="bg-white rounded-card p-8 max-w-2xl" style="box-shadow: 0 2px 12px rgba(26,77,46,0.04);">
        <div class="grid grid-cols-2 gap-6">
            <div>
                <p class="text-xs font-bold uppercase tracking-wider text-[#1a4d2e] mb-1">Peminjam</p>
                <p class="font-medium">{{ $loan->user->name }}</p>
            </div>
            <div>
                <p class="text-xs font-bold uppercase tracking-wider text-[#1a4d2e] mb-1">Buku</p>
                <p class="font-medium font-headline">{{ $loan->book->judul }}</p>
            </div>
            <div>
                <p class="text-xs font-bold uppercase tracking-wider text-[#1a4d2e] mb-1">Tgl Pinjam</p>
                <p>{{ $loan->tgl_pinjam->format('d F Y') }}</p>
            </div>
            <div>
                <p class="text-xs font-bold uppercase tracking-wider text-[#1a4d2e] mb-1">Tgl Kembali (Rencana)</p>
                <p>{{ $loan->tgl_kembali_rencana->format('d F Y') }}</p>
            </div>
            @if($loan->tgl_kembali_aktual)
            <div>
                <p class="text-xs font-bold uppercase tracking-wider text-[#1a4d2e] mb-1">Tgl Kembali (Aktual)</p>
                <p>{{ $loan->tgl_kembali_aktual->format('d F Y') }}</p>
            </div>
            @endif
            <div>
                <p class="text-xs font-bold uppercase tracking-wider text-[#1a4d2e] mb-1">Status</p>
                <p class="font-bold text-sm">{{ ucfirst($loan->status) }}</p>
            </div>
        </div>

        @if($loan->fine)
        <div class="mt-6 p-4 rounded-card" style="background: rgba(200,64,26,0.06);">
            <p class="text-xs font-bold uppercase tracking-wider text-[#c8401a] mb-2">Denda</p>
            <p class="text-sm">{{ $loan->fine->jumlah_hari }} hari × Rp 1.000 = <span class="font-bold">Rp {{ number_format($loan->fine->nominal_denda, 0, ',', '.') }}</span></p>
            <p class="text-xs mt-1">Status: <span class="font-bold">{{ ucfirst($loan->fine->status_bayar) }}</span></p>
        </div>
        @endif
    </div>
</x-layouts.admin>
