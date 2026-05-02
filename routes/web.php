<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Public\HomeController;
use App\Http\Controllers\Public\CatalogController;
use App\Http\Controllers\Public\AnnouncementController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\Admin\MemberController;
use App\Http\Controllers\Admin\LoanController as AdminLoanController;
use App\Http\Controllers\Admin\FineController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Member\DashboardController as MemberDashboardController;
use App\Http\Controllers\Member\LoanController as MemberLoanController;
use App\Http\Controllers\Member\ProfileController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/katalog', [CatalogController::class, 'index'])->name('catalog.index');
Route::get('/katalog/{book}', [CatalogController::class, 'show'])->name('catalog.show');
Route::get('/pengumuman', [AnnouncementController::class, 'index'])->name('announcement.index');
Route::get('/pengumuman/{announcement}', [AnnouncementController::class, 'show'])->name('announcement.show');

/*
|--------------------------------------------------------------------------
| Authenticated redirect
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', function () {
    $user = auth()->user();
    if ($user->isAdmin()) {
        return redirect()->route('admin.dashboard');
    }
    return redirect()->route('member.dashboard');
})->middleware(['auth'])->name('dashboard');

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    // Books CRUD
    Route::resource('books', BookController::class);

    // Members CRUD
    Route::resource('members', MemberController::class);

    // Loans Management
    Route::get('/loans', [AdminLoanController::class, 'index'])->name('loans.index');
    Route::get('/loans/{loan}', [AdminLoanController::class, 'show'])->name('loans.show');
    Route::post('/loans/{loan}/confirm', [AdminLoanController::class, 'confirm'])->name('loans.confirm');
    Route::post('/loans/{loan}/return', [AdminLoanController::class, 'returnBook'])->name('loans.return');

    // Fines
    Route::get('/fines', [FineController::class, 'index'])->name('fines.index');
    Route::post('/fines/{fine}/pay', [FineController::class, 'confirmPayment'])->name('fines.pay');

    // Reports
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
    Route::get('/reports/export/pdf', [ReportController::class, 'exportPdf'])->name('reports.export.pdf');
    Route::get('/reports/export/excel', [ReportController::class, 'exportExcel'])->name('reports.export.excel');
});

/*
|--------------------------------------------------------------------------
| Member Routes (Siswa & Guru)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:siswa,guru'])->prefix('member')->name('member.')->group(function () {
    Route::get('/dashboard', [MemberDashboardController::class, 'index'])->name('dashboard');

    // Loans
    Route::get('/loans', [MemberLoanController::class, 'index'])->name('loans.index');
    Route::get('/loans/create', [MemberLoanController::class, 'create'])->name('loans.create');
    Route::post('/loans', [MemberLoanController::class, 'store'])->name('loans.store');
    Route::post('/loans/{loan}/extend', [MemberLoanController::class, 'extend'])->name('loans.extend');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

require __DIR__.'/auth.php';
