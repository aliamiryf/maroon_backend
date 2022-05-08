<?php

namespace App\Http\Middleware;

use App\Exceptions\v1\platformException;
use App\Models\v1\Platform;
use Closure;
use Illuminate\Http\Request;

class platformChecker
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (Platform::where('url', $request->getHost())->exists()) {
            return $next($request);
        }
        return throw new platformException($request->getHost());
    }
}
