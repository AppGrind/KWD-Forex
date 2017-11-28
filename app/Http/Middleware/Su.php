<?php

namespace App\Http\Middleware;

use Closure;

class Su
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

        if (!$request->user()->hasRole('admin')) {
            flash('Unauthorized access attempt!', 'error');
            return redirect('/dashboard');
        }

        return $next($request);
    }
}
