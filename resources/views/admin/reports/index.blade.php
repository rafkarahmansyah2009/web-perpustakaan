<x-layouts.admin :header="'Laporan'">
    {{-- Date Filter --}}
    <form method="GET" action="{{ route('admin.reports.index') }}" class="mb-6 flex flex-wrap items-end gap-4">
        <div>
            <label class="block text-xs font-bold uppercase tracking-wider text-[#1a4d2e] mb-2">Dari Tanggal</label>
            <input type="date" name="start_date" value="{{ $startDate }}" class="input-field">
        </div>
        <div>
            <label class="block text-xs font-bold uppercase tracking-wider text-[#1a4d2e] mb-2">Sampai Tanggal</label>
            <input type="date" name="end_date" value="{{ $endDate }}" class="input-field">
        </div>
        <button type="submit" class="btn-primary !py-3">Filter</button>
    </form>

    {{-- Stats --}}
    <div class="grid grid-cols-2 sm:grid-cols-5 gap-4 mb-6">
        <div class="stat-card text-center">
            <p class="font-headline text-2xl font-bold">{{ $stats['total'] }}</p>
            <p class="text-xs text-[#717971] uppercase tracking-wider">Total</p>
        </div>
        <div class="stat-card text-center">
            <p class="font-headline text-2xl font-bold text-[#1a4d2e]">{{ $stats['dipinjam'] }}</p>
            <p class="text-xs text-[#717971] uppercase tracking-wider">Dipinjam</p>
        </div>
        <div class="stat-card text-center">
            <p class="font-headline text-2xl font-bold">{{ $stats['dikembalikan'] }}</p>
            <p class="text-xs text-[#717971] uppercase tracking-wider">Dikembalikan</p>
        </div>
        <div class="stat-card text-center">
            <p class="font-headline text-2xl font-bold text-[#c8401a]">{{ $stats['terlambat'] }}</p>
            <p class="text-xs text-[#717971] uppercase tracking-wider">Terlambat</p>
        </div>
        <div class="stat-card text-center">
            <p class="font-headline text-2xl font-bold text-[#d4a017]">Rp {{ number_format($stats['total_denda'], 0, ',', '.') }}</p>
            <p class="text-xs text-[#717971] uppercase tracking-wider">Denda</p>
        </div>
    </div>

    {{-- Table --}}
    <div class="bg-white rounded-card overflow-hidden" style="box-shadow: 0 2px 12px rgba(26,77,46,0.04);">
        <table class="w-full table-scholarly">
            <thead><tr class="bg-[#f5f3ee]"><th>Peminjam</th><th>Buku</th><th>Tgl Pinjam</th><th>Tgl Kembali</th><th>Status</th><th>Denda</th></tr></thead>
            <tbody>
                @forelse($loans as $loan)
                <tr>
                    <td class="font-medium">{{ $loan->user->name }}</td>
                    <td>{{ Str::limit($loan->book->judul, 30) }}</td>
                    <td>{{ $loan->tgl_pinjam->format('d/m/Y') }}</td>
                    <td>{{ $loan->tgl_kembali_aktual ? $loan->tgl_kembali_aktual->format('d/m/Y') : '-' }}</td>
                    <td>{{ ucfirst($loan->status) }}</td>
                    <td>{{ $loan->fine ? 'Rp ' . number_format($loan->fine->nominal_denda, 0, ',', '.') : '-' }}</td>
                </tr>
                @empty
                <tr><td colspan="6" class="text-center text-[#717971] py-8">Tidak ada data pada periode ini.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-layouts.admin>
