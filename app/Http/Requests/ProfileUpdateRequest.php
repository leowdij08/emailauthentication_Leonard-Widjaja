<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],  // Nama wajib diisi, bertipe string, dan maksimal 255 karakter
            'email' => [
                'required',  // Email wajib diisi
                'string',    // Email harus berupa string
                'lowercase', // Email harus dalam huruf kecil
                'email',     // Harus sesuai format email
                'max:255',   // Maksimal panjang email adalah 255 karakter
                Rule::unique(User::class)->ignore($this->user()->id), // Email harus unik, kecuali untuk pengguna yang sedang mengirimkan permintaan ini
            ],
        ];
    }
}
