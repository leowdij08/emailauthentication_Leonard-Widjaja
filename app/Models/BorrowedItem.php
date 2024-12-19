<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BorrowedItem extends Model
{
    use HasFactory;

    /**
     * fillable
     * 
     * Daftar atribut yang dapat diisi melalui mass assignment
     *
     * @var array
     */
    protected $fillable = [
        'id', // ID dari item yang dipinjam
        'borrower_id', // ID peminjam
        'borrowable_id', // ID item yang dipinjam
        'borrowable_type', // Tipe item (mungkin buku, CD, dll.)
        'borrowed_at', // Waktu item dipinjam
        'due_date' // Tanggal pengembalian
    ];

    /**
     * Relasi polymorphic dengan model lain (misalnya Books, CD, Journal, dsb)
     */
    public function borrowable()
    {
        return $this->morphTo(); // Menentukan relasi polymorphic
    }
}
