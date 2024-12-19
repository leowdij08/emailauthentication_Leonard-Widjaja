<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Newspaper extends Model
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
        'title', // Judul surat kabar
        'author', // Penulis atau redaksi surat kabar
        'publisher', // Penerbit surat kabar
        'description', // Deskripsi surat kabar
        'price', // Harga surat kabar
        'stock', // Jumlah stok surat kabar
        'datePublished', // Tanggal terbit surat kabar
        'onlineLink', // Link untuk mengakses surat kabar secara online
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
