<x-layouts.admin :header="'Kelola Denda'">
    <div class="mb-6">
        <div class="stat-card inline-block">
            <p class="text-xs text-[#717971] font-bold uppercase tracking-wider">Total Denda Belum Lunas</p>
            <p class="font-headline text-2xl font-bold text-[#c8401a]">Rp {{ number_format($totalUnpaid, 0, ',', '.') }}</p>
        </div>
    </div>

    <div class="bg-white rounded-card overflow-hidden" style="box-shadow: 0 2px 12px rgba(26,77,46,0.04);">
        <table class="w-full table-scholarly">
            <thead>
                <tr class="bg-[#f5f3ee]">
                    <th>Peminjam</th>
                    <th>Buku</th>
                    <th>Hari</th>
                    <th>Nominal</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($fines as $fine)
                <tr>
                    <td class="font-medium">{{ $fine->loan->user->name }}</td>
                    <td>{{ Str::limit($fine->loan->book->judul, 30) }}</td>
                    <td>{{ $fine->jumlah_hari }} hari</td>
                    <td class="font-bold">Rp {{ number_format($fine->nominal_denda, 0, ',', '.') }}</td>
                    <td>
                        @if($fine->isPaid())
                        <span class="badge-available">Lunas</span>
                        @else
                        <span class="badge-borrowed">Belum</span>
                        @endif
                    </td>
                    <td>
                        @unless($fine->isPaid())
                        <form method="POST" action="{{ route('admin.fines.pay', $fine) }}" class="inline-block m-0 p-0">
                            @csrf
                            <button type="submit" class="px-3 py-1.5 bg-[#1a4d2e]/10 text-[#1a4d2e] text-xs font-medium rounded-md hover:bg-[#1a4d2e] hover:text-white transition-colors duration-200">Konfirmasi Bayar</button>
                        </form>
                        @endunless
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center text-[#717971] py-8">Tidak ada data denda.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-6">{{ $fines->links() }}</div>
</x-layouts.admin>