<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Loan;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $startDate = $request->input('start_date', now()->startOfMonth()->format('Y-m-d'));
        $endDate = $request->input('end_date', now()->format('Y-m-d'));

        $loans = Loan::with(['user', 'book', 'fine'])
            ->whereBetween('tgl_pinjam', [$startDate, $endDate])
            ->latest()
            ->get();

        $stats = [
            'total' => $loans->count(),
            'dipinjam' => $loans->where('status', 'dipinjam')->count(),
            'dikembalikan' => $loans->where('status', 'dikembalikan')->count(),
            'terlambat' => $loans->where('status', 'terlambat')->count(),
            'total_denda' => $loans->sum(fn($l) => $l->fine?->nominal_denda ?? 0),
        ];

        return view('admin.reports.index', compact('loans', 'stats', 'startDate', 'endDate'));
    }

    public function exportPdf(Request $request)
    {
        $startDate = $request->input('start_date', now()->startOfMonth()->format('Y-m-d'));
        $endDate = $request->input('end_date', now()->format('Y-m-d'));

        $loans = Loan::with(['user', 'book', 'fine'])
            ->whereBetween('tgl_pinjam', [$startDate, $endDate])
            ->latest()
            ->get();

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('admin.reports.pdf', compact('loans', 'startDate', 'endDate'));
        return $pdf->download('laporan-perpustakaan.pdf');
    }

    public function exportExcel(Request $request)
    {
        $startDate = $request->input('start_date', now()->startOfMonth()->format('Y-m-d'));
        $endDate = $request->input('end_date', now()->format('Y-m-d'));

        $loans = Loan::with(['user', 'book', 'fine'])
            ->whereBetween('tgl_pinjam', [$startDate, $endDate])
            ->latest()
            ->get();

        $fileName = 'laporan-perpustakaan-' . date('Y-m-d') . '.csv';

        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array('Peminjam', 'Buku', 'Tgl Pinjam', 'Tgl Kembali', 'Status', 'Denda');

        $callback = function() use($loans, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($loans as $loan) {
                $row['Peminjam']  = $loan->user->name;
                $row['Buku']    = $loan->book->judul;
                $row['Tgl Pinjam']  = $loan->tgl_pinjam->format('d/m/Y');
                $row['Tgl Kembali']  = $loan->tgl_kembali_aktual ? $loan->tgl_kembali_aktual->format('d/m/Y') : '-';
                $row['Status']  = ucfirst($loan->status);
                $row['Denda']  = $loan->fine ? $loan->fine->nominal_denda : '0';

                fputcsv($file, array($row['Peminjam'], $row['Buku'], $row['Tgl Pinjam'], $row['Tgl Kembali'], $row['Status'], $row['Denda']));
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
