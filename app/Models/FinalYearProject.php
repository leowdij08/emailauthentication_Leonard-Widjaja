<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinalYearProject extends Model
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
        'title', // Judul proyek akhir tahun
        'author', // Penulis proyek
        'publisher', // Penerbit proyek
        'description', // Deskripsi proyek
        'stock', // Jumlah stok
        'datePublished', // Tanggal diterbitkan
        'onlineLink', // Link untuk mengakses proyek secara online
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
