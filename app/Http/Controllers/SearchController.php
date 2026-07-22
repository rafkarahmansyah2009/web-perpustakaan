<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Loan;
use App\Models\Fine;
use App\Models\User;

class SearchController extends Controller
{
    public function liveSearch(Request $request)
    {
        $type = $request->get('type', 'catalog');
        $query = $request->get('query', '');

        if ($type !== 'catalog') {
            if (!auth()->check() || !auth()->user()->isAdmin()) {
                return response()->json([], 403);
            }
        }

        if (strlen($query) < 1) {
            return response()->json([]);
        }

        $results = [];

        if ($type === 'catalog') {
            $books = Book::where('judul', 'like', "%{$query}%")
                ->orWhere('pengarang', 'like', "%{$query}%")
                ->orWhere('isbn', 'like', "%{$query}%")
                ->take(5)
                ->get();
                
            foreach ($books as $book) {
                $results[] = [
                    'id' => $book->id,
                    'title' => $book->judul,
                    'subtitle' => $book->pengarang . ($book->isbn ? ' - ' . $book->isbn : ''),
                    'url' => route('catalog.show', $book->id)
                ];
            }
        } elseif ($type === 'loans') {
            $loans = Loan::with(['user', 'book'])
                ->whereHas('user', function ($q) use ($query) {
                    $q->where('name', 'like', "%{$query}%");
                })->orWhereHas('book', function ($q) use ($query) {
                    $q->where('judul', 'like', "%{$query}%");
                })
                ->take(5)
                ->get();
                
            foreach ($loans as $loan) {
                $datePinjam = $loan->tgl_pinjam ? $loan->tgl_pinjam->format('d/m/Y') : 'Pending';
                $results[] = [
                    'id' => $loan->id,
                    'title' => $loan->user->name . ' - ' . $loan->book->judul,
                    'subtitle' => 'Status: ' . ucfirst($loan->status) . ' | Tgl Pinjam: ' . $datePinjam,
                    'url' => route('admin.loans.index', ['search' => $loan->user->name])
                ];
            }
        } elseif ($type === 'fines') {
            $fines = Fine::with(['loan.user', 'loan.book'])
                ->whereHas('loan.user', function ($q) use ($query) {
                    $q->where('name', 'like', "%{$query}%");
                })->orWhereHas('loan.book', function ($q) use ($query) {
                    $q->where('judul', 'like', "%{$query}%");
                })
                ->take(5)
                ->get();
                
            foreach ($fines as $fine) {
                $results[] = [
                    'id' => $fine->id,
                    'title' => $fine->loan->user->name . ' - ' . $fine->loan->book->judul,
                    'subtitle' => 'Denda: Rp ' . number_format($fine->nominal_denda, 0, ',', '.') . ' | Status: ' . ucfirst($fine->status_bayar),
                    'url' => route('admin.fines.index', ['search' => $fine->loan->user->name])
                ];
            }
        } elseif ($type === 'reports') {
            $loans = Loan::with(['user', 'book'])
                ->whereHas('user', function ($q) use ($query) {
                    $q->where('name', 'like', "%{$query}%");
                })->orWhereHas('book', function ($q) use ($query) {
                    $q->where('judul', 'like', "%{$query}%");
                })
                ->take(5)
                ->get();
                
            foreach ($loans as $loan) {
                $results[] = [
                    'id' => $loan->id,
                    'title' => $loan->user->name . ' - ' . $loan->book->judul,
                    'subtitle' => 'Status: ' . ucfirst($loan->status),
                    'url' => route('admin.reports.index', ['search' => $loan->user->name])
                ];
            }
        } elseif ($type === 'admin_books') {
            $books = Book::where('judul', 'like', "%{$query}%")
                ->orWhere('pengarang', 'like', "%{$query}%")
                ->orWhere('isbn', 'like', "%{$query}%")
                ->take(5)
                ->get();
                
            foreach ($books as $book) {
                $results[] = [
                    'id' => $book->id,
                    'title' => $book->judul,
                    'subtitle' => 'Stok: ' . $book->stok . ' | ' . $book->pengarang,
                    'url' => route('admin.books.index', ['search' => $book->judul])
                ];
            }
        } elseif ($type === 'admin_members') {
            $members = User::where('name', 'like', "%{$query}%")
                ->orWhere('email', 'like', "%{$query}%")
                ->orWhere('identifier', 'like', "%{$query}%")
                ->take(5)
                ->get();
                
            foreach ($members as $member) {
                $results[] = [
                    'id' => $member->id,
                    'title' => $member->name,
                    'subtitle' => ucfirst($member->role) . ' | ' . $member->identifier,
                    'url' => route('admin.members.index', ['search' => $member->name])
                ];
            }
        }

        return response()->json($results);
    }
}
