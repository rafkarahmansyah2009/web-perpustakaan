<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'isbn', 'judul', 'pengarang', 'penerbit', 'tahun_terbit',
        'kategori_id', 'deskripsi', 'cover', 'stok', 'lokasi_rak',
    ];

    public function kategori()
    {
        return $this->belongsTo(Category::class, 'kategori_id');
    }

    public function loans()
    {
        return $this->hasMany(Loan::class);
    }

    public function activeLoanCount(): int
    {
        return $this->loans()->whereIn('status', ['dipinjam', 'terlambat'])->count();
    }

    public function isAvailable(): bool
    {
        return $this->stok > $this->activeLoanCount();
    }

    public function availableStock(): int
    {
        return max(0, $this->stok - $this->activeLoanCount());
    }
}
