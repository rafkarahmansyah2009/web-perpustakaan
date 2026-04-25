@props(['available' => true])

@if($available)
    <span class="inline-flex items-center px-2.5 py-0.5 text-[10px] font-bold uppercase tracking-wider rounded-full" style="background: rgba(26, 77, 46, 0.1); color: #1a4d2e;">
        Tersedia
    </span>
@else
    <span class="inline-flex items-center px-2.5 py-0.5 text-[10px] font-bold uppercase tracking-wider rounded-full" style="background: rgba(200, 64, 26, 0.1); color: #c8401a;">
        Dipinjam
    </span>
@endif
