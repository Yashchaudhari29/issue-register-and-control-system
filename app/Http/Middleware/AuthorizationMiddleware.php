<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AuthorizationMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!$user->hasPermission('access_protected_resource')) {
            return redirect()->route('login');
        }

        return $next($request);
    }
}
