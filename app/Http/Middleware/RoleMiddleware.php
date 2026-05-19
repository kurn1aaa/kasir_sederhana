<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
   public function handle($request, \Closure $next, $role)
{
    
    if (!auth()->check() || auth()->user()->role->nama_role !== $role) {
        
        abort(403, 'Maaf, Anda tidak memiliki hak akses ke halaman ini.');
    }

    return $next($request);
}
}
