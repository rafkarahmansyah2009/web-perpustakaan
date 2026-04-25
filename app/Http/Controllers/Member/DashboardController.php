<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Loan;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $activeLoans = Loan::with('book')
            ->where('user_id', $user->id)
            ->whereIn('status', ['dipinjam', 'terlambat'])
            ->get();

        $pendingLoans = Loan::with('book')
            ->where('user_id', $user->id)
            ->where('status', 'pending')
            ->get();

        $nearDueLoans = $activeLoans->filter(function ($loan) {
            return $loan->daysUntilDue() <= 3 && $loan->daysUntilDue() >= 0;
        });

        $overdueLoans = $activeLoans->filter(function ($loan) {
            return $loan->isOverdue();
        });

        $totalBorrowed = Loan::where('user_id', $user->id)->count();

        return view('member.dashboard.index', compact(
            'user', 'activeLoans', 'pendingLoans', 'nearDueLoans', 'overdueLoans', 'totalBorrowed'
        ));
    }
}
