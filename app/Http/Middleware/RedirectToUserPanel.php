<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RedirectToUserPanel
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the user does not have the 'app.panel' permission
        if (auth()->check() && !auth()->user()->can('app.panel')) {
            // Redirect to the user dashboard route
            return redirect()->route('panel.dashboard');
        }

        return $next($request);
    }
}
