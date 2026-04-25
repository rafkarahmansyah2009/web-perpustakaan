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
}
