<x-layouts.member :title="'Dashboard — Perpustakaan SMKN 5'">

    {{-- Greeting --}}
    <div class="mb-8">
        <h1 class="font-headline text-3xl font-bold text-[#1b1c19] mb-1">
            Halo, {{ auth()->user()->name }}! 👋
        </h1>
        <p class="text-[#414942]">Selamat datang kembali di Perpustakaan Digital SMKN 5 Tangerang.</p>
    </div>

    {{-- Alerts --}}
    @if($overdueLoans->count() > 0)
    <div class="mb-6 p-4 rounded-card flex items-start gap-3" style="background: rgba(200,64,26,0.08);">
        <svg class="w-5 h-5 text-[#c8401a] shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.07 16.5c-.77.833.192 2.5 1.732 2.5z"/></svg>
        <div>
            <p class="text-sm font-bold text-[#c8401a]">Buku Terlambat!</p>
            <p class="text-xs text-[#5b1200]">Anda memiliki {{ $overdueLoans->count() }} buku yang melewati batas pengembalian. Segera kembalikan untuk menghindari denda.</p>
        </div>
    </div>
    @endif

    @if($nearDueLoans->count() > 0)
    <div class="mb-6 p-4 rounded-card flex items-start gap-3" style="background: rgba(212,160,23,0.1);">
        <svg class="w-5 h-5 text-[#d4a017] shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        <div>
            <p class="text-sm font-bold text-[#795900]">Buku Hampir Jatuh Tempo</p>
            <p class="text-xs text-[#5c4300]">{{ $nearDueLoans->count() }} buku akan jatuh tempo dalam 3 hari ke depan.</p>
        </div>
    </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        {{-- Member Card --}}
        <div class="lg:col-span-1">
            <div class="rounded-card overflow-hidden" style="background: linear-gradient(160deg, #00361a 0%, #1a4d2e 100%);">
                <div class="p-6 text-center">
                    <div class="w-20 h-20 rounded-full mx-auto mb-4 flex items-center justify-center border-2 border-white/20 overflow-hidden">
                        @if($user->foto)
                            <img src="{{ Storage::url($user->foto) }}" class="w-full h-full object-cover">
                        @else
                            <span class="text-white text-2xl font-bold">{{ strtoupper(substr($user->name, 0, 2)) }}</span>
                        @endif
                    </div>
                    <h3 class="font-headline text-lg font-bold text-white mb-1">{{ $user->name }}</h3>
                    <p class="text-xs text-white/60 uppercase tracking-wider mb-1">{{ ucfirst($user->role) }}</p>
                    <div class="w-10 h-0.5 bg-[#d4a017] mx-auto my-3"></div>

                    <div class="space-y-2 text-left px-2">
                        @if($user->nis)
                        <div class="flex justify-between">
                            <span class="text-xs text-white/50 uppercase tracking-wider">NIS</span>
                            <span class="text-sm text-white font-medium">{{ $user->nis }}</span>
                        </div>
                        @endif
                        @if($user->nip)
                        <div class="flex justify-between">
                            <span class="text-xs text-white/50 uppercase tracking-wider">NIP</span>
                            <span class="text-sm text-white font-medium">{{ $user->nip }}</span>
                        </div>
                        @endif
                        @if($user->kelas)
                        <div class="flex justify-between">
                            <span class="text-xs text-white/50 uppercase tracking-wider">Kelas</span>
                            <span class="text-sm text-white font-medium">{{ $user->kelas }}</span>
                        </div>
                        @endif
                        <div class="flex justify-between">
                            <span class="text-xs text-white/50 uppercase tracking-wider">ID</span>
                            <span class="text-sm text-white font-medium">#{{ $user->id }}</span>
                        </div>
                    </div>
                </div>
                <div class="px-6 pb-6 text-center">
                    <div class="bg-white rounded p-3 inline-block">
                        {{-- Simple QR placeholder using user ID --}}
                        <img src="https://api.qrserver.com/v1/create-qr-code/?size=120x120&data=SMKN5-MEMBER-{{ $user->id }}" alt="QR Code" class="w-28 h-28">
                    </div>
                    <p class="text-[10px] text-white/40 mt-2">Kartu Anggota Digital</p>
                </div>
            </div>
        </div>

        {{-- Active Loans --}}
        <div class="lg:col-span-2">
            <div class="flex items-center justify-between mb-4">
                <h2 class="font-headline text-xl font-bold text-[#1b1c19]">Pinjaman Aktif</h2>
                <a href="{{ route('member.loans.index') }}" class="text-sm text-[#1a4d2e] font-medium hover:underline">Lihat Semua →</a>
            </div>

            <div class="space-y-4">
                @forelse($activeLoans as $loan)
                <div class="bg-white rounded-card p-5 flex items-center justify-between" style="box-shadow: 0 2px 12px rgba(26,77,46,0.04);">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-16 bg-[#f0eee9] rounded flex items-center justify-center shrink-0">
                            <svg class="w-6 h-6 text-[#c1c9bf]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                        </div>
                        <div>
                            <p class="font-headline text-sm font-bold text-[#1b1c19]">{{ $loan->book->judul }}</p>
                            <p class="text-xs text-[#414942]">Kembali: {{ $loan->tgl_kembali_rencana->format('d M Y') }}</p>
                            @if($loan->isOverdue())
                                <p class="text-xs text-[#c8401a] font-bold">Terlambat {{ $loan->daysOverdue() }} hari</p>
                            @elseif($loan->daysUntilDue() <= 3)
                                <p class="text-xs text-[#d4a017] font-bold">{{ $loan->daysUntilDue() }} hari lagi</p>
                            @endif
                        </div>
                    </div>
                    <div>
                        @if($loan->status === 'dipinjam' && !$loan->sudah_diperpanjang && !$loan->isOverdue())
                        <form method="POST" action="{{ route('member.loans.extend', $loan) }}">
                            @csrf
                            <button class="text-xs text-[#1a4d2e] font-bold hover:underline">Perpanjang</button>
                        </form>
                        @elseif($loan->sudah_diperpanjang)
                        <span class="text-xs text-[#717971]">Sudah diperpanjang</span>
                        @endif
                    </div>
                </div>
                @empty
                <div class="text-center py-12 bg-white rounded-card" style="box-shadow: 0 2px 12px rgba(26,77,46,0.04);">
                    <p class="font-headline text-lg text-[#414942]">Tidak ada pinjaman aktif</p>
                    <a href="{{ route('catalog.index') }}" class="text-sm text-[#1a4d2e] font-medium hover:underline mt-2 inline-block">Jelajahi Katalog →</a>
                </div>
                @endforelse
            </div>

            {{-- Pending --}}
            @if($pendingLoans->count() > 0)
            <h3 class="font-headline text-lg font-bold text-[#1b1c19] mt-8 mb-4">Menunggu Konfirmasi</h3>
            @foreach($pendingLoans as $loan)
            <div class="bg-white rounded-card p-5 flex items-center gap-4 mb-3" style="box-shadow: 0 2px 12px rgba(26,77,46,0.04);">
                <span class="badge-pending">Pending</span>
                <div>
                    <p class="font-headline text-sm font-bold">{{ $loan->book->judul }}</p>
                    <p class="text-xs text-[#414942]">Diajukan {{ $loan->created_at->diffForHumans() }}</p>
                </div>
            </div>
            @endforeach
            @endif
        </div>
    </div>

</x-layouts.member>
