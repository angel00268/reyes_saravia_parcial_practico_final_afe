<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CanViewMiddleware
{
    public function handle(Request $request, Closure $next, string $permission)
    {
        if (canView($permission)) {
            return $next($request);
        }
        abort(403, 'Usted no tiene permisos para estar aqui.');
    }
}
