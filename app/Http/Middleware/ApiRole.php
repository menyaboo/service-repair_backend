<?php

namespace App\Http\Middleware;

use App\Exceptions\ApiException;
use Closure;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;

class ApiRole
{
    public function handle(Request $request, Closure $next, $role)
    {
        if (!$request->user()->hasRole(explode('|', $role)))
            throw new AuthorizationException('You do not have permission to access this page.');
        return $next($request);
    }
}
