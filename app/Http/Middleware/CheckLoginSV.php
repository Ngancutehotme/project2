<?php

namespace App\Http\Middleware;

use Closure;

class CheckLoginSV
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
        if($request->session()->has('ma_sv')) {
            return $next($request);
        }
        return redirect()->route('sinh_vien_view_login');
    }
}
