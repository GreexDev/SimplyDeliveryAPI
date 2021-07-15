<?php

namespace App\Http\Middleware;

use Closure;

class ApiKeyAuthMiddleware
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
        // Verify API Key
        if ($request->input('api_key') != 'ApiKeyExample') {
            return response()->json("Wrong API Key",403);
        }

        return $next($request);
    }
}
