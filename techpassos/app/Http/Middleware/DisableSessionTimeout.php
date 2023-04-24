<?php

namespace App\Http\Middleware;

use Closure;

class DisableSessionTimeout
{
    public function handle($request, Closure $next)
    {
        // Desabilita o tempo limite de sessão
        config(['session.lifetime' => null]);

        return $next($request);
    }
}
