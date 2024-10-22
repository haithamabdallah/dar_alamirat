<?php

namespace App\Http\Middleware;

use App\Models\Setting;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckMaintenance
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $setting = Setting::where('type', 'maintenance')->first() ?? null;
        $status = isset($setting) ? Setting::where('type', 'maintenance')->first()['value']['maintenance_mode']  : 'disabled';
        
        if ($status == 'enabled') {
            session(['maintenance' =>  true]);
            
            if (!auth('admin')->check() && !$request->is('dashboard/*')) {
                if ($request->routeIs('maintenance-page')) {
                    return $next($request);
                } else {
                    return redirect()->route('maintenance-page');
                }
            }
        } else {
            session(['maintenance' =>  false]);
        }

        return $next($request);
    }
}
