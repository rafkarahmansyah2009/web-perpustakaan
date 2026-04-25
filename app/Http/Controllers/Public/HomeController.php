<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\User;
use App\Models\Announcement;

class HomeController extends Controller
{
    public function index()
    {
        $totalBooks = Book::sum('stok');
        $totalMembers = User::where('role', '!=', 'admin')->where('status_aktif', true)->count();
        $availableBooks = Book::where('stok', '>', 0)->count();

        $latestBooks = Book::with('kategori')->latest()->take(6)->get();
        $announcements = Announcement::published()->latest()->take(3)->get();

        return view('public.home.index', compact(
            'totalBooks', 'totalMembers', 'availableBooks',
            'latestBooks', 'announcements'
        ));
    }
}
