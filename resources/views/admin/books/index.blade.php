<x-layouts.admin :header="'Kelola Buku'">
    <div class="flex items-center justify-between mb-6">
        <p class="text-sm text-[#414942]">Total: {{ $books->total() }} buku</p>
        <a href="{{ route('admin.books.create') }}" class="btn-primary text-sm !py-2">+ Tambah Buku</a>
    </div>

    <div class="bg-white rounded-card overflow-hidden" style="box-shadow: 0 2px 12px rgba(26,77,46,0.04);">
        <table class="w-full table-scholarly">
            <thead>
                <tr class="bg-[#f5f3ee]">
                    <th>Judul</th>
                    <th>Pengarang</th>
                    <th>Kategori</th>
                    <th>Stok</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($books as $book)
                <tr>
                    <td class="font-medium font-headline">{{ Str::limit($book->judul, 40) }}</td>
                    <td>{{ $book->pengarang }}</td>
                    <td><span class="badge-available !text-[10px]">{{ $book->kategori->nama ?? '-' }}</span></td>
                    <td>{{ $book->stok }}</td>
                    <td class="flex items-center gap-2">
                        <a href="{{ route('admin.books.edit', $book) }}" class="px-3 py-1.5 bg-[#1a4d2e]/10 text-[#1a4d2e] text-xs font-medium rounded-md hover:bg-[#1a4d2e] hover:text-white transition-colors duration-200">Edit</a>
                        <form method="POST" action="{{ route('admin.books.destroy', $book) }}" onsubmit="return confirm('Hapus buku ini?')" class="inline-block m-0 p-0">
                            @csrf @method('DELETE')
                            <button type="submit" class="px-3 py-1.5 bg-[#c8401a]/10 text-[#c8401a] text-xs font-medium rounded-md hover:bg-[#c8401a] hover:text-white transition-colors duration-200">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center text-[#717971] py-8">Belum ada buku.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-6">{{ $books->links() }}</div>
</x-layouts.admin>