<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
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
        'user_id', // ID pengguna yang menerima notifikasi
        'message', // Pesan notifikasi
        'is_read', // Status apakah notifikasi sudah dibaca
    ];

    /**
     * Relasi ke User
     */
    public function user()
    {
        return $this->belongsTo(User::class); // Relasi ke model User (pengguna yang menerima notifikasi)
    }
}
