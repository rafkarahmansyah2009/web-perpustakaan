<x-layouts.admin :header="'Kelola Peminjaman'">
    {{-- Filters --}}
    <div class="flex flex-wrap gap-3 mb-6">
        <a href="{{ route('admin.loans.index') }}" class="px-4 py-2 rounded-btn text-sm font-medium transition-colors {{ !request('status') ? 'bg-[#1a4d2e] text-white' : 'bg-white text-[#414942] hover:bg-[#eae8e3]' }}">Semua</a>
        <a href="{{ route('admin.loans.index', ['status' => 'pending']) }}" class="px-4 py-2 rounded-btn text-sm font-medium transition-colors {{ request('status') == 'pending' ? 'bg-[#d4a017] text-white' : 'bg-white text-[#414942] hover:bg-[#eae8e3]' }}">Pending</a>
        <a href="{{ route('admin.loans.index', ['status' => 'dipinjam']) }}" class="px-4 py-2 rounded-btn text-sm font-medium transition-colors {{ request('status') == 'dipinjam' ? 'bg-[#1a4d2e] text-white' : 'bg-white text-[#414942] hover:bg-[#eae8e3]' }}">Dipinjam</a>
        <a href="{{ route('admin.loans.index', ['status' => 'dikembalikan']) }}" class="px-4 py-2 rounded-btn text-sm font-medium transition-colors {{ request('status') == 'dikembalikan' ? 'bg-[#1a4d2e] text-white' : 'bg-white text-[#414942] hover:bg-[#eae8e3]' }}">Dikembalikan</a>
        <a href="{{ route('admin.loans.index', ['status' => 'terlambat']) }}" class="px-4 py-2 rounded-btn text-sm font-medium transition-colors {{ request('status') == 'terlambat' ? 'bg-[#c8401a] text-white' : 'bg-white text-[#414942] hover:bg-[#eae8e3]' }}">Terlambat</a>
    </div>

    <div class="bg-white rounded-card overflow-hidden" style="box-shadow: 0 2px 12px rgba(26,77,46,0.04);">
        <table class="w-full table-scholarly">
            <thead><tr class="bg-[#f5f3ee]"><th>Peminjam</th><th>Buku</th><th>Tgl Pinjam</th><th>Tgl Kembali</th><th>Status</th><th>Aksi</th></tr></thead>
            <tbody>
                @forelse($loans as $loan)
                <tr>
                    <td class="font-medium">{{ $loan->user->name }}</td>
                    <td>{{ Str::limit($loan->book->judul, 30) }}</td>
                    <td>{{ $loan->tgl_pinjam->format('d/m/Y') }}</td>
                    <td>{{ $loan->tgl_kembali_rencana->format('d/m/Y') }}</td>
                    <td>
                        @if($loan->status === 'pending')
                            <span class="badge-pending">Pending</span>
                        @elseif($loan->status === 'dipinjam')
                            <span class="badge-available">Dipinjam</span>
                        @elseif($loan->status === 'dikembalikan')
                            <span class="badge" style="background: rgba(26,77,46,0.1); color: #1a4d2e;">Dikembalikan</span>
                        @else
                            <span class="badge-borrowed">Terlambat</span>
                        @endif
                    </td>
                    <td class="flex items-center gap-2">
                        @if($loan->status === 'pending')
                            <form method="POST" action="{{ route('admin.loans.confirm', $loan) }}" class="inline-block m-0 p-0">
                                @csrf
                                <button type="submit" class="px-3 py-1.5 bg-[#1a4d2e]/10 text-[#1a4d2e] text-xs font-medium rounded-md hover:bg-[#1a4d2e] hover:text-white transition-colors duration-200">Konfirmasi</button>
                            </form>
                        @endif
                        @if(in_array($loan->status, ['dipinjam', 'terlambat']))
                            <form method="POST" action="{{ route('admin.loans.return', $loan) }}" class="inline-block m-0 p-0">
                                @csrf
                                <button type="submit" class="px-3 py-1.5 bg-[#c8401a]/10 text-[#c8401a] text-xs font-medium rounded-md hover:bg-[#c8401a] hover:text-white transition-colors duration-200">Kembalikan</button>
                            </form>
                        @endif
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" class="text-center text-[#717971] py-8">Tidak ada data peminjaman.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-6">{{ $loans->links() }}</div>
</x-layouts.admin>
