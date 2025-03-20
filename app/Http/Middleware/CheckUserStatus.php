<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckUserStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Use === false para comparação estrita com booleano
        if (Auth::check() && Auth::user()->status === false) {
            Auth::logout();
            return redirect()->route('login')
                ->with('error', 'Sua conta não está ativa. Por favor, entre em contato com o administrador.');
        }
    
        return $next($request);
    }
}