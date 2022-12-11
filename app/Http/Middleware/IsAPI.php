<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsAPI
{
    public function handle(Request $request, Closure $next)
    {
        $request->isAPI = true;
        return $next($request);
    }
}
