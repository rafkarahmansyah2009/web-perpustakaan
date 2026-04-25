<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Fine;
use Carbon\Carbon;

class FineController extends Controller
{
    public function index()
    {
        $fines = Fine::with(['loan.user', 'loan.book'])
            ->latest()
            ->paginate(15);

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
