<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckAdmin
{
    public function handle($request, Closure $next)
    {
        if (!Auth::user() || Auth::user()->role != 1) {
            return abort(403);
        }

        return $next($request);
    }
}
