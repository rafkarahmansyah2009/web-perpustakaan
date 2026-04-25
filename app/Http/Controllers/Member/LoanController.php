<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoanRequest;
use App\Models\Book;
use App\Models\Loan;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LoanController extends Controller
{
    public function index()
    {
        $loans = Loan::with(['book', 'fine'])
            ->where('user_id', auth()->id())
            ->latest()
            ->paginate(10);

        return view('member.loans.index', compact('loans'));
    }

    public function create(Request $request)
    {
        $book = null;
        if ($request->filled('book_id')) {
            $book = Book::findOrFail($request->book_id);
        }

        return view('member.loans.create', compact('book'));
    }

    public function store(LoanRequest $request)
    {
        $book = Book::findOrFail($request->book_id);

        if (!$book->isAvailable()) {
            return back()->with('error', 'Maaf, buku tidak tersedia saat ini.');
        }

        // Check if user already has an active loan for this book
        $existing = Loan::where('user_id', auth()->id())
            ->where('book_id', $book->id)
            ->whereIn('status', ['pending', 'dipinjam'])
            ->exists();

        if ($existing) {
            return back()->with('error', 'Anda sudah memiliki peminjaman aktif untuk buku ini.');
        }

        Loan::create([
            'user_id' => auth()->id(),
            'book_id' => $book->id,
            'tgl_pinjam' => Carbon::now(),
            'tgl_kembali_rencana' => Carbon::now()->addDays(7),
            'status' => 'pending',
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('member.loans.index')
            ->with('success', 'Pengajuan peminjaman berhasil! Menunggu konfirmasi admin.');
    }

    public function extend(Loan $loan)
    {
        if ($loan->user_id !== auth()->id()) {
            abort(403);
        }

        if ($loan->status !== 'dipinjam') {
            return back()->with('error', 'Peminjaman tidak dapat diperpanjang.');
        }

        if ($loan->sudah_diperpanjang) {
            return back()->with('error', 'Peminjaman sudah pernah diperpanjang.');
        }

        $loan->update([
            'tgl_kembali_rencana' => $loan->tgl_kembali_rencana->addDays(7),
            'sudah_diperpanjang' => true,
        ]);

        return back()->with('success', 'Peminjaman berhasil diperpanjang 7 hari.');
    }
}
