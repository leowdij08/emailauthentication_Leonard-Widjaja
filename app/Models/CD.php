<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CD extends Model
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
        'title', // Judul CD
        'author', // Penulis atau artis CD
        'publisher', // Penerbit CD
        'description', // Deskripsi CD
        'price', // Harga CD
        'stock', // Jumlah stok CD
        'datePublished', // Tanggal terbit CD
        'genre', // Genre CD
        'onlineLink', // Link untuk mengakses CD secara online
        'catalogue_type' // Tipe katalog
    ];

    public $timestamps = false; // Tidak menggunakan timestamp otomatis
    public $updated_at = false; // Tidak menggunakan updated_at otomatis

    /**
     * Relasi polymorphic dengan model BorrowedItem
     */
    public function borrowedItems()
    {
        return $this->morphMany(BorrowedItem::class, 'borrowable'); // Menentukan relasi polymorphic
    }
}
