<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\User;
use App\Models\Loan;
use App\Models\Fine;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $totalBooks = Book::sum('stok');
        $activeMembers = User::where('role', '!=', 'admin')->where('status_aktif', true)->count();
        $currentlyBorrowed = Loan::whereIn('status', ['dipinjam', 'terlambat'])->count();
        $unpaidFines = Fine::where('status_bayar', 'belum')->sum('nominal_denda');

        // Monthly loan stats for chart (last 6 months)
        $monthlyLoans = [];
        for ($i = 5; $i >= 0; $i--) {
            $month = Carbon::now()->subMonths($i);
            $count = Loan::whereYear('tgl_pinjam', $month->year)
                ->whereMonth('tgl_pinjam', $month->month)
                ->count();
            $monthlyLoans[] = [
                'month' => $month->translatedFormat('M Y'),
                'count' => $count,
            ];
        }

        $recentTransactions = Loan::with(['user', 'book'])
            ->latest()
            ->take(5)
            ->get();

        $nearDueLoans = Loan::with(['user', 'book'])
            ->where('status', 'dipinjam')
            ->where('tgl_kembali_rencana', '<=', Carbon::now()->addDays(3))
            ->where('tgl_kembali_rencana', '>=', Carbon::now())
            ->get();

        return view('admin.dashboard.index', compact(
            'totalBooks', 'activeMembers', 'currentlyBorrowed', 'unpaidFines',
            'monthlyLoans', 'recentTransactions', 'nearDueLoans'
        ));
    }
}
