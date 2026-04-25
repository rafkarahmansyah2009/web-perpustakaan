<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Loan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'book_id', 'tgl_pinjam', 'tgl_kembali_rencana',
        'tgl_kembali_aktual', 'status', 'keterangan', 'sudah_diperpanjang',
    ];

    protected function casts(): array
    {
        return [
            'tgl_pinjam' => 'date',
            'tgl_kembali_rencana' => 'date',
            'tgl_kembali_aktual' => 'date',
            'sudah_diperpanjang' => 'boolean',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function fine()
    {
        return $this->hasOne(Fine::class);
    }

    public function isOverdue(): bool
    {
        if ($this->status === 'dikembalikan') {
            return false;
        }
        return Carbon::now()->greaterThan($this->tgl_kembali_rencana);
    }

    public function daysOverdue(): int
    {
        if (!$this->isOverdue()) {
            return 0;
        }
        $endDate = $this->tgl_kembali_aktual ?? Carbon::now();
        return (int) $this->tgl_kembali_rencana->diffInDays($endDate);
    }

    public function daysUntilDue(): int
    {
        if ($this->status === 'dikembalikan') {
            return 0;
        }
        return (int) Carbon::now()->diffInDays($this->tgl_kembali_rencana, false);
    }
}
