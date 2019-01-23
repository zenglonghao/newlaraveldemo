<?php
namespace App\Http\Middleware;

use Closure;

class AuserLogin{
    public function handle($request, Closure $next)
    {
        if (empty($request->session()->get('admin_id'))) {
            return redirect('/login');
        }
        return $next($request);
    }
}

