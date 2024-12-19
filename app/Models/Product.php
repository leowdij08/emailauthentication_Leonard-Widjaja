<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
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
        'image', // Gambar produk
        'title', // Judul produk
        'description', // Deskripsi produk
        'price', // Harga produk
        'stock', // Jumlah stok produk
    ];
}
