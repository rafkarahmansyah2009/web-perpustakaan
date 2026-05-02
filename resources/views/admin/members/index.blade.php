<x-layouts.admin :header="'Kelola Anggota'">
    <div class="flex items-center justify-between mb-6">
        <p class="text-sm text-[#414942]">Total: {{ $members->total() }} anggota</p>
        <a href="{{ route('admin.members.create') }}" class="btn-primary text-sm !py-2">+ Tambah Anggota</a>
    </div>

    <div class="bg-white rounded-card overflow-hidden" style="box-shadow: 0 2px 12px rgba(26,77,46,0.04);">
        <table class="w-full table-scholarly">
            <thead><tr class="bg-[#f5f3ee]"><th>Nama</th><th>Email</th><th>Role</th><th>NIS/NIP</th><th>Status</th><th>Aksi</th></tr></thead>
            <tbody>
                @forelse($members as $member)
                <tr>
                    <td class="font-medium">{{ $member->name }}</td>
                    <td class="text-xs">{{ $member->email }}</td>
                    <td><span class="badge-pending !text-[10px]">{{ ucfirst($member->role) }}</span></td>
                    <td>{{ $member->identifier }}</td>
                    <td>
                        @if($member->status_aktif)
                            <span class="badge-available !text-[10px]">Aktif</span>
                        @else
                            <span class="badge-borrowed !text-[10px]">Nonaktif</span>
                        @endif
                    </td>
                    <td class="flex items-center gap-2">
                        <a href="{{ route('admin.members.edit', $member) }}" class="px-3 py-1.5 bg-[#1a4d2e]/10 text-[#1a4d2e] text-xs font-medium rounded-md hover:bg-[#1a4d2e] hover:text-white transition-colors duration-200">Edit</a>
                        <form method="POST" action="{{ route('admin.members.destroy', $member) }}" onsubmit="return confirm('Hapus anggota ini?')" class="inline-block m-0 p-0">
                            @csrf @method('DELETE')
                            <button type="submit" class="px-3 py-1.5 bg-[#c8401a]/10 text-[#c8401a] text-xs font-medium rounded-md hover:bg-[#c8401a] hover:text-white transition-colors duration-200">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" class="text-center text-[#717971] py-8">Belum ada anggota.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-6">{{ $members->links() }}</div>
</x-layouts.admin>
