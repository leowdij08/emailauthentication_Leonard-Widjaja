<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CollectionUpdateRequest extends Model
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
        'id', // ID dari permintaan pembaruan koleksi
        'catalogue_type', // Tipe koleksi yang diperbarui
        'catalogue_id', // ID koleksi yang diperbarui
        'librarian_id', // ID pustakawan yang memproses permintaan
        'update_data', // Data yang diperbarui
        'status' // Status permintaan pembaruan
    ];

    /**
     * Relasi dengan model User (pustakawan)
     */
    public function librarian()
    {
        return $this->belongsTo(User::class, 'user_id'); // Pustakawan yang menangani permintaan
    }

    /**
     * Relasi polymorphic dengan koleksi (buku, jurnal, dll)
     */
    public function catalogue()
    {
        return $this->morphTo(); // Menentukan relasi polymorphic
    }
}
