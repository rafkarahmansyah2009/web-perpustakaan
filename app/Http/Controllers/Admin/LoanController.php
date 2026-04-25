<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Loan;
use App\Models\Fine;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LoanController extends Controller
{
    public function index(Request $request)
    {
        $query = Loan::with(['user', 'book', 'fine']);

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('user', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%");
            })->orWhereHas('book', function ($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%");
            });
        }

        $loans = $query->latest()->paginate(15)->withQueryString();

        return view('admin.loans.index', compact('loans'));
    }

    public function show(Loan $loan)
    {
        $loan->load(['user', 'book', 'fine']);
        return view('admin.loans.show', compact('loan'));
    }

    public function confirm(Loan $loan)
    {
        if ($loan->status !== 'pending') {
            return back()->with('error', 'Peminjaman ini tidak dalam status pending.');
        }

        $loan->update([
            'status' => 'dipinjam',
            'tgl_pinjam' => Carbon::now(),
        ]);

        return back()->with('success', 'Peminjaman berhasil dikonfirmasi.');
    }

    public function returnBook(Loan $loan)
    {
        if (!in_array($loan->status, ['dipinjam', 'terlambat'])) {
            return back()->with('error', 'Buku ini tidak sedang dipinjam.');
        }

        $now = Carbon::now();
        $loan->update([
            'status' => 'dikembalikan',
            'tgl_kembali_aktual' => $now,
        ]);

        // Calculate fine if overdue
        if ($now->greaterThan($loan->tgl_kembali_rencana)) {
            $daysLate = (int) $loan->tgl_kembali_rencana->diffInDays($now);
            Fine::create([
                'loan_id' => $loan->id,
                'jumlah_hari' => $daysLate,
                'nominal_denda' => $daysLate * 1000,
                'status_bayar' => 'belum',
            ]);

            return back()->with('warning', "Buku dikembalikan terlambat {$daysLate} hari. Denda: Rp " . number_format($daysLate * 1000, 0, ',', '.'));
        }

        return back()->with('success', 'Buku berhasil dikembalikan.');
    }
}
