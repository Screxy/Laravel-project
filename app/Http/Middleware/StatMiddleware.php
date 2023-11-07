<?php

namespace App\Http\Middleware;

use App\Models\Path;
use Closure;
use Illuminate\Http\Request;

class StatMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $path = new Path;
        $path->url = $request->path();
        $path->save();
        return $next($request);
    }
}
