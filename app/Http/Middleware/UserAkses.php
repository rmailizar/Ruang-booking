<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserAkses
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        if (!auth()->check()) {
            return redirect('/')->withErrors('Silakan login terlebih dahulu.');
        }
        
        if(auth()->user()->role == $role){
            return $next($request);
        }
        
        return abort(403, 'Anda tidak memiliki akses ke halaman ini.');
    }
}
