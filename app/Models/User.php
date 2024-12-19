<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Casts\Attribute;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name', // Nama pengguna
        'email', // Email pengguna
        'password', // Kata sandi pengguna
        'role' // Peran pengguna (misal: admin, pustakawan, anggota)
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password', // Sembunyikan password pengguna
        'remember_token', // Sembunyikan token untuk "remember me"
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime', // Memastikan tanggal verifikasi email dikembalikan dalam format datetime
            'password' => 'hashed', // Meng-hash password secara otomatis
        ];
    }

    /**
     * Interact with the user's role.
     *
     * @param  string  $value
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function role(): Attribute
    {
        return new Attribute(
            get: fn ($value) => $value, // Mengembalikan nilai peran pengguna seperti semula (misal string)
        );
    }

    /**
     * Relasi ke CollectionUpdateRequest yang dimiliki oleh pustakawan
     */
    public function collectionUpdateRequests()
    {
        return $this->hasMany(CollectionUpdateRequest::class, 'librarian_id'); // Menghubungkan pengguna dengan permintaan pembaruan koleksi
    }
}
