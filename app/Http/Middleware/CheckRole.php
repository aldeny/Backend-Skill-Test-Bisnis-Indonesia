<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;


class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {

        if (!auth()->check()) {
            return redirect()->route('login');
        }

        if (!Auth::check() || !Auth::user()->hasAnyRole($roles)) {
            return redirect()->route('login');
        }

        return $next($request);

    }
}
