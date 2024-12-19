<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Books extends Model
{
    use HasFactory; // Menggunakan trait HasFactory untuk mendukung pembuatan instance model menggunakan factory

    /**
     * fillable
     *
     * @var array
     *  // Kolom-kolom yang dapat diisi secara massal
     */
    protected $fillable = [
        'title',        // Judul buku
        'author',       // Penulis buku
        'publisher',    // Penerbit buku
        'description',  // Deskripsi buku
        'price',        // Harga buku
        'stock',        // Stok buku
        'datePublished',// Tanggal terbit buku
        'genre',        // Genre buku
        'onlineLink',   // Link online buku
        'catalogue_type'// Tipe katalog buku
    ];

    public $timestamps = false; // Menonaktifkan kolom timestamp (created_at dan updated_at)
    public $updated_at = false; // Menonaktifkan pembaruan otomatis kolom updated_at

    /**
     * Definisikan hubungan polimorfik banyak dengan BorrowedItem.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function borrowedItems()
    {
        return $this->morphMany(BorrowedItem::class, 'borrowable'); // Mendefinisikan hubungan polimorfik many-to-many
    }
}
