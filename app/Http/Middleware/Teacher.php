<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Teacher
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::user() &&  Auth::user()->role == 'teacher') {
            return $next($request);
        }else {
            return error_out(['middleware' => 'Sizda bu ishni bajarish uchun ruxsat mavjud emas.']);
        }
    }
}
