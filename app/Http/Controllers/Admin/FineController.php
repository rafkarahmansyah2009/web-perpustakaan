<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Fine;
use Carbon\Carbon;

class FineController extends Controller
{
    public function index(\Illuminate\Http\Request $request)
    {
        $query = Fine::with(['loan.user', 'loan.book']);

        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('loan.user', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%");
            })->orWhereHas('loan.book', function ($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%");
            });
        }

        $fines = $query->latest()->paginate(15)->withQueryString();

        $totalUnpaid = Fine::where('status_bayar', 'belum')->sum('nominal_denda');

        return view('admin.fines.index', compact('fines', 'totalUnpaid'));
    }

    public function confirmPayment(Fine $fine)
    {
        $fine->update([
            'status_bayar' => 'lunas',
            'tgl_bayar' => Carbon::now(),
        ]);

        return back()->with('success', 'Pembayaran denda berhasil dikonfirmasi.');
    }
}
