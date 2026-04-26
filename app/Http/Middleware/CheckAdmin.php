<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        // Cek apakah user sudah login DAN apakah rolenya admin
        if (auth()->check() && auth()->user()->role == 'admin') {
            return $next($request);
        }

        // Jika bukan admin, kasih pesan error 403 (Forbidden)
        return response()->json(['message' => 'Akses ditolak! Hanya Admin yang boleh menghapus data.'], 403);
    }
}