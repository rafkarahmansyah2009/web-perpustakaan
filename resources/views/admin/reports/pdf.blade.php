<!DOCTYPE html>
<html>
<head>
    <title>Laporan Perpustakaan</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        h2 { text-align: center; }
        .text-center { text-align: center; }
        .mb-2 { margin-bottom: 8px; }
    </style>
</head>
<body>
    <h2>Laporan Peminjaman Buku</h2>
    <p class="text-center mb-2">Periode: {{ \Carbon\Carbon::parse($startDate)->format('d/m/Y') }} - {{ \Carbon\Carbon::parse($endDate)->format('d/m/Y') }}</p>
    
    <table>
        <thead>
            <tr>
                <th>Peminjam</th>
                <th>Buku</th>
                <th>Tgl Pinjam</th>
                <th>Tgl Kembali</th>
                <th>Status</th>
                <th>Denda</th>
            </tr>
        </thead>
        <tbody>
            @forelse($loans as $loan)
            <tr>
                <td>{{ $loan->user->name }}</td>
                <td>{{ $loan->book->judul }}</td>
                <td>{{ $loan->tgl_pinjam->format('d/m/Y') }}</td>
                <td>{{ $loan->tgl_kembali_aktual ? $loan->tgl_kembali_aktual->format('d/m/Y') : '-' }}</td>
                <td>{{ ucfirst($loan->status) }}</td>
                <td>{{ $loan->fine ? 'Rp ' . number_format($loan->fine->nominal_denda, 0, ',', '.') : '-' }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center">Tidak ada data peminjaman pada periode ini.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
