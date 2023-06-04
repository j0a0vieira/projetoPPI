<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class IsUserBlockedOrDeleted
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)

    {
        if ($request->user()->deleted_at == null && $request->user()->bloqueado == 0)
            return $next($request);
        else {
            Auth::logout();
            Session::flush();
            Session::regenerate();
            return redirect()->route('login')->withErrors(['suspended' => 'Your account is deactivated']);
        }
    }
}
