<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle incoming request and verify
     * user role before allowing route access.
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        /**
         * Redirect unauthenticated users
         * to login page.
         */
        if (!$request->user()) {
            return redirect('/login');
        }

        /**
         * Block users trying to access
         * unauthorized role routes.
         */
        if ($request->user()->role !== $role) {
            abort(403, 'Unauthorized Access');
        }

        return $next($request);
    }
}