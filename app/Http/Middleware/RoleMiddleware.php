<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role)
    {
        // Jika belum login
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        // Cek role
        if (auth()->user()->role !== $role) {
            abort(403, 'Anda tidak memiliki akses.');
        }

        return $next($request);
    }
}
