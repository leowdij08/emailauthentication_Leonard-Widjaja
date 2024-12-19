<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Journal extends Model
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
        'title', // Judul jurnal
        'author', // Penulis jurnal
        'publisher', // Penerbit jurnal
        'description', // Deskripsi jurnal
        'price', // Harga jurnal
        'stock', // Jumlah stok
        'datePublished', // Tanggal diterbitkan
        'volume', // Volume jurnal
        'series', // Seri jurnal
        'number', // Nomor jurnal
        'onlineLink', // Link untuk mengakses jurnal secara online
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
