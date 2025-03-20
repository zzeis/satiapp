<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckUserLevel
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  int  $level
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$levels)
    {
        if (Auth::check() && !in_array(Auth::user()->nivel, $levels)) {
            return redirect()->route('dashboard')
                ->with('error', 'Você não tem permissão para acessar esta página.');
        }
    
        return $next($request);
    }
}