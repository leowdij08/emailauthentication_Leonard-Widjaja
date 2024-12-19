<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  string  $role  // Menambahkan parameter $role untuk memeriksa role pengguna
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next, string $role)
    {
        // Memeriksa apakah pengguna yang sedang login memiliki role yang sesuai
        if(Auth::user()->role == $role){
            return $next($request); // Jika role cocok, melanjutkan permintaan ke route berikutnya
        }

        // Jika role tidak sesuai, abort dengan error 403 (Unauthorized)
        abort(403, 'Unauthorized');
    }
}
