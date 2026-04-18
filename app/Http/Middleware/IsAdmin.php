<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        // Check if they are logged in AND if they have the admin badge
        if (auth()->check() && auth()->user()->isAdmin()) {
            return $next($request); // Let them pass
        }

        // If they are not an admin, kick them back to the dashboard with an error
        return redirect()->route('dashboard')->with('error', 'Access Denied. You do not have Administrator privileges.');
    }
}
