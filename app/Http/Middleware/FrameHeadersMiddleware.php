<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class FrameHeadersMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);
        //$response->header('X-Frame-Options', 'ALLOW FROM https://connect.facebook.net/uk_UA/sdk.js#xfbml=1&version=v12.0');
        //$response->header('X-Frame-Options', 'ALLOW FROM http://127.0.0.1:8000');
        $response->header('X-Frame-Options', 'SAMEORIGIN');
        return $response;
    }
}
