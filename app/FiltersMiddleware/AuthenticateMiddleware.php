<?php

namespace App\FiltersMiddleware;

use Closure;
use App\Core\Request;

class AuthenticateMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Lógica de autenticação
        if (!$this->authenticate($request)) {
            return new \App\Core\Response('Unauthorized', 401);
        }

        return $next($request);
    }

    protected function authenticate(Request $request)
    {
        // Implementar lógica de autenticação
        return true;
    }
}
