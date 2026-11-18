<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * damos acceso solo al usuario con rol de admin
 */
class EnsureIsAdmin
{
    /**
     * verifica el rol del usuario antes de ejecutar la accion,
     * si no es un admin responde con error 403
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!$request->user()?->isAdmin()){
            abort(403);
        }
        return $next($request);
    }
}
