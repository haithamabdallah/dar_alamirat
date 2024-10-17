<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckPermissions
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next , $role ): Response
    {
        
        if (  !in_array( $role , auth('admin')->user()?->role?->permissions?->pluck('name')->toArray() ) ) {
            return redirect(route('dashboard.authorized'));
            // abort(403 , 'You do not have permission to access this page');
        }

        return $next($request);
    }
}
