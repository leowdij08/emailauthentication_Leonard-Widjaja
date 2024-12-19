<?php

namespace App\Http\Requests\Auth;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool  // Menentukan apakah pengguna diizinkan untuk membuat permintaan ini
     */
    public function authorize(): bool
    {
        return true;  // Selalu mengizinkan permintaan ini, jika perlu bisa ditambahkan logika tambahan
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     *  // Menentukan aturan validasi untuk permintaan login
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'string', 'email'],  // Email harus diisi dan valid
            'password' => ['required', 'string'],  // Password harus diisi
        ];
    }

    /**
     * Attempt to authenticate the request's credentials.
     *
     * @throws \Illuminate\Validation\ValidationException
     *  // Mencoba untuk autentikasi kredensial yang diberikan
     */
    public function authenticate(): void
    {
        // Pastikan permintaan login tidak dibatasi berdasarkan batas percobaan login
        $this->ensureIsNotRateLimited();

        // Jika autentikasi gagal, hitung jumlah percobaan dan lemparkan pengecualian
        if (! Auth::attempt($this->only('email', 'password'), $this->boolean('remember'))) {
            // Meningkatkan jumlah percobaan login
            RateLimiter::hit($this->throttleKey());

            // Lemparkan pengecualian dengan pesan error
            throw ValidationException::withMessages([
                'email' => trans('auth.failed'),  // Pesan gagal login
            ]);
        }

        // Jika login berhasil, hapus penghitungan percobaan
        RateLimiter::clear($this->throttleKey());
    }

    /**
     * Ensure the login request is not rate limited.
     *
     * @throws \Illuminate\Validation\ValidationException
     *  // Memastikan permintaan login tidak dibatasi oleh rate limiter
     */
    public function ensureIsNotRateLimited(): void
    {
        // Memeriksa apakah terlalu banyak percobaan login
        if (RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            // Menyebabkan event Lockout jika terlalu banyak percobaan login
            event(new Lockout($this));

            // Menghitung waktu tunggu sebelum mencoba lagi
            $seconds = RateLimiter::availableIn($this->throttleKey());

            // Lemparkan pengecualian dengan pesan throttle
            throw ValidationException::withMessages([
                'email' => trans('auth.throttle', [
                    'seconds' => $seconds,  // Menampilkan detik
                    'minutes' => ceil($seconds / 60),  // Menampilkan menit
                ]),
            ]);
        }
    }

    /**
     * Get the rate limiting throttle key for the request.
     *
     * @return string  // Mengambil kunci throttle untuk pembatasan percakapan login
     */
    public function throttleKey(): string
    {
        // Membuat kunci throttle berdasarkan email pengguna dan alamat IP mereka
        return Str::transliterate(Str::lower($this->string('email')).'|'.$this->ip());
    }
}
