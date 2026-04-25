<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    public function index(Request $request)
    {
        $query = Book::with('kategori');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                  ->orWhere('pengarang', 'like', "%{$search}%")
                  ->orWhere('isbn', 'like', "%{$search}%");
            });
        }

        if ($request->filled('kategori')) {
            $query->where('kategori_id', $request->kategori);
        }

        if ($request->filled('status')) {
            if ($request->status === 'tersedia') {
                $query->where('stok', '>', 0);
            }
        }

        $books = $query->latest()->paginate(12)->withQueryString();
        $categories = Category::withCount('books')->get();

        return view('public.catalog.index', compact('books', 'categories'));
    }

    public function show(Book $book)
    {
        $book->load('kategori', 'loans.user');
        $relatedBooks = Book::where('kategori_id', $book->kategori_id)
            ->where('id', '!=', $book->id)
            ->take(4)
            ->get();

        return view('public.catalog.show', compact('book', 'relatedBooks'));
    }
}
