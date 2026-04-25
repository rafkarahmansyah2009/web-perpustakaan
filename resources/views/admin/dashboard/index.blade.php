<x-layouts.admin :header="'Dashboard'">
    {{-- Stats Grid --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="stat-card">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-card flex items-center justify-center" style="background: rgba(26,77,46,0.08);">
                    <svg class="w-6 h-6 text-[#1a4d2e]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                </div>
                <div>
                    <p class="font-headline text-2xl font-bold text-[#1b1c19]">{{ number_format($totalBooks) }}</p>
                    <p class="text-xs text-[#717971] font-bold uppercase tracking-wider">Total Buku</p>
                </div>
            </div>
        </div>
        <div class="stat-card">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-card flex items-center justify-center" style="background: rgba(212,160,23,0.1);">
                    <svg class="w-6 h-6 text-[#d4a017]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197"/></svg>
                </div>
                <div>
                    <p class="font-headline text-2xl font-bold text-[#1b1c19]">{{ number_format($activeMembers) }}</p>
                    <p class="text-xs text-[#717971] font-bold uppercase tracking-wider">Anggota Aktif</p>
                </div>
            </div>
        </div>
        <div class="stat-card">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-card flex items-center justify-center" style="background: rgba(200,64,26,0.08);">
                    <svg class="w-6 h-6 text-[#c8401a]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/></svg>
                </div>
                <div>
                    <p class="font-headline text-2xl font-bold text-[#1b1c19]">{{ number_format($currentlyBorrowed) }}</p>
                    <p class="text-xs text-[#717971] font-bold uppercase tracking-wider">Sedang Dipinjam</p>
                </div>
            </div>
        </div>
        <div class="stat-card">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-card flex items-center justify-center" style="background: rgba(121,89,0,0.08);">
                    <svg class="w-6 h-6 text-[#795900]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <div>
                    <p class="font-headline text-2xl font-bold text-[#1b1c19]">Rp {{ number_format($unpaidFines, 0, ',', '.') }}</p>
                    <p class="text-xs text-[#717971] font-bold uppercase tracking-wider">Denda Belum Lunas</p>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        {{-- Chart --}}
        <div class="lg:col-span-2 bg-white rounded-card p-6" style="box-shadow: 0 2px 12px rgba(26,77,46,0.04);">
            <h3 class="font-headline text-lg font-bold text-[#1b1c19] mb-6">Peminjaman per Bulan</h3>
            <canvas id="loanChart" height="200"></canvas>
        </div>

        {{-- Near due --}}
        <div class="bg-white rounded-card p-6" style="box-shadow: 0 2px 12px rgba(26,77,46,0.04);">
            <h3 class="font-headline text-lg font-bold text-[#1b1c19] mb-4">Hampir Jatuh Tempo</h3>
            @forelse($nearDueLoans as $loan)
            <div class="py-3 {{ !$loop->last ? 'border-b border-[#f0eee9]' : '' }}">
                <p class="text-sm font-semibold text-[#1b1c19]">{{ Str::limit($loan->book->judul, 30) }}</p>
                <p class="text-xs text-[#414942]">{{ $loan->user->name }}</p>
                <p class="text-xs text-[#c8401a] font-bold mt-1">{{ $loan->tgl_kembali_rencana->translatedFormat('d M Y') }}</p>
            </div>
            @empty
            <p class="text-sm text-[#717971] py-4">Tidak ada peminjaman yang hampir jatuh tempo.</p>
            @endforelse
        </div>
    </div>

    {{-- Recent Transactions --}}
    <div class="mt-6 bg-white rounded-card overflow-hidden" style="box-shadow: 0 2px 12px rgba(26,77,46,0.04);">
        <div class="px-6 py-5">
            <h3 class="font-headline text-lg font-bold text-[#1b1c19]">Transaksi Terbaru</h3>
        </div>
        <table class="w-full table-scholarly">
            <thead>
                <tr class="bg-[#f5f3ee]">
                    <th>Peminjam</th>
                    <th>Buku</th>
                    <th>Tanggal Pinjam</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recentTransactions as $tx)
                <tr>
                    <td class="font-medium">{{ $tx->user->name }}</td>
                    <td>{{ Str::limit($tx->book->judul, 35) }}</td>
                    <td>{{ $tx->tgl_pinjam->translatedFormat('d M Y') }}</td>
                    <td>
                        @if($tx->status === 'pending')
                            <span class="badge-pending">Pending</span>
                        @elseif($tx->status === 'dipinjam')
                            <span class="badge-available">Dipinjam</span>
                        @elseif($tx->status === 'dikembalikan')
                            <span class="badge" style="background: rgba(26,77,46,0.1); color: #1a4d2e;">Dikembalikan</span>
                        @else
                            <span class="badge-borrowed">Terlambat</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr><td colspan="4" class="text-center text-[#717971] py-8">Belum ada transaksi.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    <script>
        const ctx = document.getElementById('loanChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: {!! json_encode(collect($monthlyLoans)->pluck('month')) !!},
                datasets: [{
                    label: 'Peminjaman',
                    data: {!! json_encode(collect($monthlyLoans)->pluck('count')) !!},
                    backgroundColor: 'rgba(26, 77, 46, 0.15)',
                    borderColor: '#1a4d2e',
                    borderWidth: 2,
                    borderRadius: 6,
                }]
            },
            options: {
                responsive: true,
                plugins: { legend: { display: false } },
                scales: {
                    y: { beginAtZero: true, ticks: { stepSize: 1 } },
                    x: { grid: { display: false } }
                }
            }
        });
    </script>
    @endpush
</x-layouts.admin>
