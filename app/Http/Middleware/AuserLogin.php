<?php
namespace App\Http\Middleware;

use Closure;

class AuserLogin{
    public function handle($request, Closure $next)
    {
        if ($request->age <= 200) {
            return redirect('home');
        }

        return $next($request);
    }
}

